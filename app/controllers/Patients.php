<?php
  class Patients extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users/login');
      }
      $this->patientModel = $this->model('Patient');
    }

    public function index(){
      // Get Patients
      $patients = $this->patientModel->getPatients();

      $data = [
        'patients' => $patients
      ];

      $this->view('patients/index', $data);
    }

    public function register(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'name' => trim($_POST['name']),
          'phone' => trim($_POST['phone']),
          'dob' => trim($_POST['dob']),
          'gender' => trim($_POST['gender']),
          'blood_group' => trim($_POST['blood_group']),
          'emergency_contact' => trim($_POST['emergency_contact']),
          'address' => trim($_POST['address']),
          'name_err' => '',
          'phone_err' => '',
          'dob_err' => '',
          'gender_err' => ''
        ];

        // Validate
        if(empty($data['name'])){ $data['name_err'] = 'Please enter name'; }
        if(empty($data['phone'])){ $data['phone_err'] = 'Please enter phone'; }
        if(empty($data['dob'])){ $data['dob_err'] = 'Please enter date of birth'; }

        // Make sure no errors
        if(empty($data['name_err']) && empty($data['phone_err']) && empty($data['dob_err'])){
          // Validated
          if($this->patientModel->addPatient($data)){
            flash('patient_message', 'Patient Registered Successfully');
            redirect('patients/index');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('patients/register', $data);
        }

      } else {
        $data = [
          'name' => '',
          'phone' => '',
          'dob' => '',
          'gender' => 'Male',
          'blood_group' => '',
          'emergency_contact' => '',
          'address' => '',
          'name_err' => '',
          'phone_err' => '',
          'dob_err' => '',
          'gender_err' => ''
        ];

        $this->view('patients/register', $data);
      }
    }

    public function edit($id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'id' => $id,
          'name' => trim($_POST['name']),
          'phone' => trim($_POST['phone']),
          'dob' => trim($_POST['dob']),
          'gender' => trim($_POST['gender']),
          'blood_group' => trim($_POST['blood_group']),
          'emergency_contact' => trim($_POST['emergency_contact']),
          'address' => trim($_POST['address']),
          'name_err' => '',
          'phone_err' => '',
          'dob_err' => ''
        ];

        // Validate
        if(empty($data['name'])){ $data['name_err'] = 'Please enter name'; }
        if(empty($data['phone'])){ $data['phone_err'] = 'Please enter phone'; }

        // Make sure no errors
        if(empty($data['name_err']) && empty($data['phone_err'])){
          if($this->patientModel->updatePatient($data)){
            flash('patient_message', 'Patient Updated');
            redirect('patients/index');
          } else {
            die('Something went wrong');
          }
        } else {
          $this->view('patients/edit', $data);
        }

      } else {
        // Get existing patient
        $patient = $this->patientModel->getPatientById($id);

        $data = [
          'id' => $id,
          'name' => $patient->name,
          'phone' => $patient->phone,
          'dob' => $patient->dob,
          'gender' => $patient->gender,
          'blood_group' => $patient->blood_group,
          'emergency_contact' => $patient->emergency_contact,
          'address' => $patient->address,
          'name_err' => '',
          'phone_err' => '',
          'dob_err' => ''
        ];

        $this->view('patients/edit', $data);
      }
    }

    public function delete($id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($this->patientModel->deletePatient($id)){
          flash('patient_message', 'Patient Removed');
          redirect('patients/index');
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('patients/index');
      }
    }

    public function show($id){
      $patient = $this->patientModel->getPatientById($id);
      
      $this->db = new Database;
      
      // 1. Get Appointments
      $this->db->query("SELECT appointments.*, users.name as doctor_name 
                        FROM appointments 
                        JOIN doctors ON appointments.doctor_id = doctors.id 
                        JOIN users ON doctors.user_id = users.id 
                        WHERE appointments.patient_id = :id 
                        ORDER BY appointment_date DESC");
      $this->db->bind(':id', $id);
      $history = $this->db->resultSet();

      // 2. Get Admissions
      $this->db->query("SELECT a.*, b.bed_number, w.name as ward_name 
                        FROM admissions a
                        JOIN beds b ON a.bed_id = b.id
                        JOIN wards w ON b.ward_id = w.id
                        WHERE a.patient_id = :id 
                        ORDER BY admission_date DESC");
      $this->db->bind(':id', $id);
      $admissions = $this->db->resultSet();

      // 3. Get Lab Requests
      $this->db->query("SELECT lr.*, lt.test_name, d_u.name as doctor_name
                        FROM lab_requests lr
                        JOIN lab_tests lt ON lr.test_id = lt.id
                        JOIN doctors d ON lr.doctor_id = d.id
                        JOIN users d_u ON d.user_id = d_u.id
                        WHERE lr.patient_id = :id 
                        ORDER BY lr.created_at DESC");
      $this->db->bind(':id', $id);
      $labs = $this->db->resultSet();

      $data = [
        'patient' => $patient,
        'history' => $history,
        'admissions' => $admissions,
        'labs' => $labs
      ];
      $this->view('patients/view', $data);
    }
  }
