<?php
  class Doctors extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users/login');
      }
      $this->doctorModel = $this->model('Doctor');
      $this->userModel = $this->model('User');
    }

    public function index(){
      $doctors = $this->doctorModel->getDoctors();
      $data = [
        'doctors' => $doctors
      ];
      $this->view('doctors/index', $data);
    }

    public function add(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'name' => trim($_POST['name']),
          'email' => trim($_POST['email']),
          'password' => password_hash('doctor123', PASSWORD_DEFAULT),
          'role' => 'doctor',
          'department' => trim($_POST['department']),
          'specialization' => trim($_POST['specialization']),
          'consultation_fee' => trim($_POST['consultation_fee']),
          'experience' => trim($_POST['experience']),
          'qualification' => trim($_POST['qualification']),
          'schedule' => trim($_POST['schedule']),
          'name_err' => '',
          'email_err' => '',
          'department_err' => ''
        ];

        // Validate
        if(empty($data['name'])){ $data['name_err'] = 'Please enter name'; }
        if(empty($data['email'])){ 
            $data['email_err'] = 'Please enter email'; 
        } else {
            if($this->userModel->findUserByEmail($data['email'])){
                $data['email_err'] = 'Email is already taken';
            }
        }

        // Make sure no errors
        if(empty($data['name_err']) && empty($data['email_err'])){
          // 1. Create User first
          $user_data = [
              'name' => $data['name'],
              'email' => $data['email'],
              'password' => $data['password'],
              'role' => 'doctor'
          ];
          
          if($this->userModel->register($user_data)){
              // Get the ID of the new user
              $this->db = new Database; // Temp fix to get last insert id if model doesn't have it
              $this->db->query("SELECT id FROM users WHERE email = :email");
              $this->db->bind(':email', $data['email']);
              $user = $this->db->single();
              
              $data['user_id'] = $user->id;
              
              if($this->doctorModel->addDoctor($data)){
                flash('doctor_message', 'Doctor Added Successfully');
                redirect('doctors/index');
              } else {
                die('Something went wrong');
              }
          }
        } else {
          $this->view('doctors/add', $data);
        }

      } else {
        $data = [
          'name' => '',
          'email' => '',
          'department' => '',
          'specialization' => '',
          'consultation_fee' => '',
          'experience' => '',
          'qualification' => '',
          'schedule' => '',
          'name_err' => '',
          'email_err' => '',
          'department_err' => ''
        ];
        $this->view('doctors/add', $data);
      }
    }

    public function edit($id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'id' => $id,
          'name' => trim($_POST['name']),
          'department' => trim($_POST['department']),
          'specialization' => trim($_POST['specialization']),
          'consultation_fee' => trim($_POST['consultation_fee']),
          'experience' => trim($_POST['experience']),
          'qualification' => trim($_POST['qualification']),
          'schedule' => trim($_POST['schedule']),
          'user_id' => trim($_POST['user_id']),
          'name_err' => ''
        ];

        if(empty($data['name'])){ $data['name_err'] = 'Please enter name'; }

        if(empty($data['name_err'])){
          if($this->doctorModel->updateDoctor($data)){
            flash('doctor_message', 'Doctor updated');
            redirect('doctors/index');
          } else {
            die('Something went wrong');
          }
        } else {
          $this->view('doctors/edit', $data);
        }

      } else {
        $doctor = $this->doctorModel->getDoctorById($id);
        $data = [
          'id' => $id,
          'user_id' => $doctor->user_id,
          'name' => $doctor->name,
          'email' => $doctor->email,
          'department' => $doctor->department,
          'specialization' => $doctor->specialization,
          'consultation_fee' => $doctor->consultation_fee,
          'experience' => $doctor->experience,
          'qualification' => $doctor->qualification,
          'schedule' => $doctor->schedule,
          'name_err' => ''
        ];
        $this->view('doctors/edit', $data);
      }
    }

    public function delete($id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($this->doctorModel->deleteDoctor($id)){
          flash('doctor_message', 'Doctor Removed');
          redirect('doctors/index');
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('doctors/index');
      }
    }

    public function show($id){
      $doctor = $this->doctorModel->getDoctorById($id);
      
      // Get Appointments count
      $this->db = new Database;
      $this->db->query("SELECT appointments.*, patients.name as patient_name 
                        FROM appointments 
                        JOIN patients ON appointments.patient_id = patients.id 
                        WHERE appointments.doctor_id = :id 
                        ORDER BY appointment_date DESC LIMIT 10");
      $this->db->bind(':id', $id);
      $history = $this->db->resultSet();

      $data = [
        'doctor' => $doctor,
        'appointments' => $history
      ];
      $this->view('doctors/view', $data);
    }
  }
