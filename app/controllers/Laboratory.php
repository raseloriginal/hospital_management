<?php
  class Laboratory extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users/login');
      }
      $this->labModel = $this->model('LabTest');
      $this->patientModel = $this->model('Patient');
      $this->doctorModel = $this->model('Doctor');
    }

    public function index(){
      $requests = $this->labModel->getTestRequests();
      $data = [
        'requests' => $requests
      ];
      $this->view('laboratory/index', $data);
    }

    public function request(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'patient_id' => trim($_POST['patient_id']),
          'doctor_id' => trim($_POST['doctor_id']),
          'test_id' => trim($_POST['test_id']),
          'tests' => $this->labModel->getAvailableTests(),
          'patients' => $this->patientModel->getPatients(),
          'doctors' => $this->doctorModel->getDoctors(),
          'patient_err' => ''
        ];

        if(empty($data['patient_id'])){
          $data['patient_err'] = 'Select a patient';
        }

        if(empty($data['patient_err'])){
          if($this->labModel->addRequest($data)){
            flash('lab_message', 'Test Request Created');
            redirect('laboratory/index');
          } else {
            die('Something went wrong');
          }
        } else {
          $this->view('laboratory/request', $data);
        }

      } else {
        $data = [
          'tests' => $this->labModel->getAvailableTests(),
          'patients' => $this->patientModel->getPatients(),
          'doctors' => $this->doctorModel->getDoctors(),
          'patient_id' => '',
          'doctor_id' => '',
          'test_id' => '',
          'patient_err' => ''
        ];
        $this->view('laboratory/request', $data);
      }
    }

    public function process($id){
      if($this->labModel->updateStatus($id, 'In Progress')){
        flash('lab_message', 'Test Processing Started');
        redirect('laboratory/index');
      }
    }

    public function complete($id){
      if($this->labModel->updateStatus($id, 'Completed')){
        flash('lab_message', 'Test Completed Successfully');
        redirect('laboratory/index');
      }
    }
  }
