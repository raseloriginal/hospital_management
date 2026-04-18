<?php
  class Appointments extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users/login');
      }
      $this->appointmentModel = $this->model('Appointment');
      $this->patientModel = $this->model('Patient');
      $this->doctorModel = $this->model('Doctor');
    }

    public function index(){
      $appointments = $this->appointmentModel->getAppointments();
      $data = [
        'appointments' => $appointments
      ];
      $this->view('appointments/index', $data);
    }

    public function book(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'patient_id' => trim($_POST['patient_id']),
          'doctor_id' => trim($_POST['doctor_id']),
          'appointment_date' => trim($_POST['appointment_date']),
          'appointment_time' => trim($_POST['appointment_time']),
          'reason' => trim($_POST['reason']),
          'patients' => $this->patientModel->getPatients(),
          'doctors' => $this->doctorModel->getDoctors(),
          'patient_err' => '',
          'doctor_err' => '',
          'date_err' => '',
          'time_err' => ''
        ];

        // Validate
        if(empty($data['patient_id'])){ $data['patient_err'] = 'Select a patient'; }
        if(empty($data['doctor_id'])){ $data['doctor_err'] = 'Select a doctor'; }
        if(empty($data['appointment_date'])){ $data['date_err'] = 'Select date'; }
        if(empty($data['appointment_time'])){ $data['time_err'] = 'Select time'; }

        // Make sure no errors
        if(empty($data['patient_err']) && empty($data['doctor_err']) && empty($data['date_err']) && empty($data['time_err'])){
          if($this->appointmentModel->addAppointment($data)){
            flash('appointment_message', 'Appointment Booked Successfully');
            redirect('appointments/index');
          } else {
            die('Something went wrong');
          }
        } else {
          $this->view('appointments/book', $data);
        }

      } else {
        $data = [
          'patients' => $this->patientModel->getPatients(),
          'doctors' => $this->doctorModel->getDoctors(),
          'patient_id' => '',
          'doctor_id' => '',
          'appointment_date' => '',
          'appointment_time' => '',
          'reason' => '',
          'patient_err' => '',
          'doctor_err' => '',
          'date_err' => '',
          'time_err' => ''
        ];
        $this->view('appointments/book', $data);
      }
    }

    public function confirm($id){
      if($this->appointmentModel->updateStatus($id, 'Confirmed')){
        flash('appointment_message', 'Appointment Confirmed');
        redirect('appointments/index');
      }
    }

    public function cancel($id){
      if($this->appointmentModel->updateStatus($id, 'Cancelled')){
        flash('appointment_message', 'Appointment Cancelled');
        redirect('appointments/index');
      }
    }
  }
