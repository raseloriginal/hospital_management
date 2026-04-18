<?php
  class Wards extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users/login');
      }
      $this->wardModel = $this->model('Ward');
    }

    public function index(){
      $all_beds = $this->wardModel->getAllBeds();
      $wards_summary = $this->wardModel->getWards();

      $data = [
        'beds' => $all_beds,
        'wards' => $wards_summary
      ];

      $this->view('wards/index', $data);
    }

    // API-like endpoint for live updates if needed later
    public function status(){
        $all_beds = $this->wardModel->getAllBeds();
        echo json_encode($all_beds);
    }
  }
