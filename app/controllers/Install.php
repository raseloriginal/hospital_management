<?php
  class Install extends Controller {
    public function __construct() {
      // If already installed, don't allow access
      if(file_exists('../app/config/installed.txt')) {
        header('Location: ' . URLROOT);
        exit();
      }
    }

    public function index() {
      // Guess the App URL
      $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
      $host = $_SERVER['HTTP_HOST'];
      $path = str_replace(['/public/index.php', '/index.php'], '', $_SERVER['SCRIPT_NAME']);
      $app_url = $protocol . $host . $path;

      $data = [
        'app_url' => $app_url,
        'db_host' => 'localhost',
        'db_user' => 'root',
        'db_pass' => '',
        'db_name' => 'hospital_management',
        'error' => ''
      ];

      $this->view('install/index', $data);
    }

    public function process() {
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $app_url = trim($_POST['app_url']);
        $db_host = trim($_POST['db_host']);
        $db_user = trim($_POST['db_user']);
        $db_pass = trim($_POST['db_pass']);
        $db_name = trim($_POST['db_name']);

        try {
          // 1. Connect without Database Name to create the DB if it doesn't exist
          $pdo = new PDO("mysql:host=" . $db_host, $db_user, $db_pass);
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          
          // Create database
          $pdo->exec("CREATE DATABASE IF NOT EXISTS `$db_name` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;");

          // 2. Connect directly to the database
          $pdo = new PDO("mysql:host=" . $db_host . ";dbname=" . $db_name, $db_user, $db_pass);
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          // 3. Execute SQL Files
          $sql_files = [
            '../database/schema.sql',
            '../database/expenses_update.sql',
            '../database/settings_migration.sql'
          ];

          foreach($sql_files as $file) {
            if(file_exists($file)) {
              $sql = file_get_contents($file);
              if(!empty(trim($sql))) {
                 $pdo->exec($sql);
              }
            }
          }

          // 4. Update config.php
          $config_path = '../app/config/config.php';
          $config_str = file_get_contents($config_path);

          $config_str = preg_replace("/define\('DB_HOST',\s*'.*?'\);/", "define('DB_HOST', '$db_host');", $config_str);
          $config_str = preg_replace("/define\('DB_USER',\s*'.*?'\);/", "define('DB_USER', '$db_user');", $config_str);
          $config_str = preg_replace("/define\('DB_PASS',\s*'.*?'\);/", "define('DB_PASS', '$db_pass');", $config_str);
          $config_str = preg_replace("/define\('DB_NAME',\s*'.*?'\);/", "define('DB_NAME', '$db_name');", $config_str);
          
          // Sanitize app_url (remove trailing slash)
          $app_url = rtrim($app_url, '/');
          $config_str = preg_replace("/define\('URLROOT',\s*'.*?'\);/", "define('URLROOT', '$app_url');", $config_str);

          file_put_contents($config_path, $config_str);

          // 5. Create lock file
          file_put_contents('../app/config/installed.txt', 'Installed on ' . date('Y-m-d H:i:s'));

          // Redirect to login or success page
          header('Location: ' . $app_url . '/users/login?installed=1');
          exit();

        } catch(PDOException $e) {
          $data = [
            'app_url' => $app_url,
            'db_host' => $db_host,
            'db_user' => $db_user,
            'db_pass' => $db_pass,
            'db_name' => $db_name,
            'error' => 'Database Error: ' . $e->getMessage()
          ];
          $this->view('install/index', $data);
        } catch(Exception $e) {
          $data = [
            'app_url' => $app_url,
            'db_host' => $db_host,
            'db_user' => $db_user,
            'db_pass' => $db_pass,
            'db_name' => $db_name,
            'error' => 'Error: ' . $e->getMessage()
          ];
          $this->view('install/index', $data);
        }
      } else {
        header('Location: ' . URLROOT . '/install');
      }
    }
  }
