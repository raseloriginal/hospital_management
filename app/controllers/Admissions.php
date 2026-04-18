<?php
  class Admissions extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users/login');
      }
      $this->admissionModel = $this->model('Admission');
      $this->patientModel = $this->model('Patient');
      $this->wardModel = $this->model('Ward');
    }

    public function index(){
        $admissions = $this->admissionModel->getActiveAdmissions();
        $data = [
            'admissions' => $admissions
        ];
        $this->view('admissions/index', $data);
    }

    public function create(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'patient_id' => trim($_POST['patient_id']),
          'bed_id' => trim($_POST['bed_id']),
          'admission_date' => trim($_POST['admission_date']),
          'patient_id_err' => '',
          'admission_date_err' => ''
        ];

        // Validate
        if(empty($data['patient_id'])){ $data['patient_id_err'] = 'Please select a patient'; }
        if(empty($data['admission_date'])){ $data['admission_date_err'] = 'Please select admission date'; }

        if(empty($data['patient_id_err']) && empty($data['admission_date_err'])){
          if($this->admissionModel->addAdmission($data)){
            flash('admission_message', 'Patient Admitted Successfully');
            redirect('wards/index'); // Back to ward map
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $patients = $this->patientModel->getPatients();
          $data['patients'] = $patients;
          $this->view('admissions/create', $data);
        }

      } else {
        // Get bed ID from URL if available
        $bed_id = $_GET['bed'] ?? '';
        $patients = $this->patientModel->getPatients();

        $data = [
          'bed_id' => $bed_id,
          'patient_id' => '',
          'admission_date' => date('Y-m-d\TH:i'),
          'patients' => $patients,
          'patient_id_err' => '',
          'admission_date_err' => ''
        ];

        $this->view('admissions/create', $data);
      }
    }

    public function discharge_process($id, $bed_id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($this->admissionModel->discharge($id, $bed_id)){
          flash('admission_message', 'Patient Discharged');
          redirect('wards/index');
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('wards/index');
      }
    }
  }
