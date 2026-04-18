<?php
  // Check if system is installed
  if (!file_exists('../app/config/installed.txt')) {
      $url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
      $urlArray = explode('/', $url);
      
      // If we are not already on the install route, redirect to it
      if (strtolower($urlArray[0]) !== 'install') {
          $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
          $host = $_SERVER['HTTP_HOST'];
          // Determine base path, stripping out index.php if present
          $path = str_replace(['/public/index.php', '/index.php'], '', $_SERVER['SCRIPT_NAME']);
          
          header("Location: " . $protocol . $host . $path . "/install");
          exit();
      }
  }

  require_once '../app/require.php';

  // Init Core Library
  $init = new Core;
