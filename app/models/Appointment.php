<?php
  class Appointment {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    // Get all appointments with patient and doctor details
    public function getAppointments(){
      $this->db->query('SELECT appointments.*, patients.name as patient_name, patients.patient_id as patient_reg_id, users.name as doctor_name, doctors.department 
                        FROM appointments 
                        JOIN patients ON appointments.patient_id = patients.id 
                        JOIN doctors ON appointments.doctor_id = doctors.id 
                        JOIN users ON doctors.user_id = users.id 
                        ORDER BY appointments.appointment_date DESC, appointments.appointment_time ASC');
      return $this->db->resultSet();
    }

    // Add Appointment
    public function addAppointment($data){
      // Generate Appointment NO
      $appointment_no = $this->generateAppointmentNo();
      // Generate Serial NO for the day
      $serial_no = $this->generateSerialNo($data['doctor_id'], $data['appointment_date']);

      $this->db->query('INSERT INTO appointments (appointment_no, patient_id, doctor_id, appointment_date, appointment_time, serial_no, reason, status) VALUES(:appointment_no, :patient_id, :doctor_id, :appointment_date, :appointment_time, :serial_no, :reason, :status)');
      // Bind values
      $this->db->bind(':appointment_no', $appointment_no);
      $this->db->bind(':patient_id', $data['patient_id']);
      $this->db->bind(':doctor_id', $data['doctor_id']);
      $this->db->bind(':appointment_date', $data['appointment_date']);
      $this->db->bind(':appointment_time', $data['appointment_time']);
      $this->db->bind(':serial_no', $serial_no);
      $this->db->bind(':reason', $data['reason']);
      $this->db->bind(':status', 'Pending');

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    private function generateAppointmentNo(){
        $date = date('md');
        $random = rand(100, 999);
        return "APT-$date$random";
    }

    private function generateSerialNo($doctor_id, $date){
        $this->db->query("SELECT COUNT(*) as count FROM appointments WHERE doctor_id = :doctor_id AND appointment_date = :date");
        $this->db->bind(':doctor_id', $doctor_id);
        $this->db->bind(':date', $date);
        $row = $this->db->single();
        return $row->count + 1;
    }

    // Update Appointment Status
    public function updateStatus($id, $status){
      $this->db->query('UPDATE appointments SET status = :status WHERE id = :id');
      $this->db->bind(':id', $id);
      $this->db->bind(':status', $status);
      return $this->db->execute();
    }
  }
