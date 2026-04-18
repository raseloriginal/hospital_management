<?php
  class Settings extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users/login');
      }

      if($_SESSION['user_role'] != 'admin'){
        redirect('pages/index');
      }

      $this->settingModel = $this->model('Setting');
    }

    public function index(){
      $settings = $this->settingModel->getSettings();

      $data = [
        'settings' => $settings
      ];

      $this->view('settings/index', $data);
    }

    public function update(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $settings = $this->settingModel->getSettings();

        // Handle file uploads
        $logo_path = $settings->logo_path;
        $favicon_path = $settings->favicon_path;

        if(!empty($_FILES['logo']['name'])){
          $logo_name = time() . '_' . $_FILES['logo']['name'];
          $logo_target = PUBROOT . '/img/' . $logo_name;
          if(move_uploaded_file($_FILES['logo']['tmp_name'], $logo_target)){
            $logo_path = $logo_name;
          }
        }

        if(!empty($_FILES['favicon']['name'])){
          $favicon_name = time() . '_' . $_FILES['favicon']['name'];
          $favicon_target = PUBROOT . '/img/' . $favicon_name;
          if(move_uploaded_file($_FILES['favicon']['tmp_name'], $favicon_target)){
            $favicon_path = $favicon_name;
          }
        }

        $data = [
          'hospital_name' => trim($_POST['hospital_name']),
          'hospital_tagline' => trim($_POST['hospital_tagline']),
          'hospital_email' => trim($_POST['hospital_email']),
          'hospital_phone' => trim($_POST['hospital_phone']),
          'hospital_address' => trim($_POST['hospital_address']),
          'currency_symbol' => trim($_POST['currency_symbol']),
          'logo_path' => $logo_path,
          'favicon_path' => $favicon_path,
          'facebook_url' => trim($_POST['facebook_url']),
          'twitter_url' => trim($_POST['twitter_url']),
          'linkedin_url' => trim($_POST['linkedin_url']),
          'footer_text' => trim($_POST['footer_text']),
          'primary_color' => trim($_POST['primary_color']),
        ];

        if($this->settingModel->updateSettings($data)){
          flash('settings_message', 'Settings updated successfully');
          redirect('settings/index');
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('settings/index');
      }
    }
  }
