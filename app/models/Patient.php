<?php
  class Patient {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    // Get all patients
    public function getPatients(){
      $this->db->query('SELECT * FROM patients ORDER BY created_at DESC');
      return $this->db->resultSet();
    }

    // Add Patient
    public function addPatient($data){
      // Generate Unique Patient ID (P-YYYY-XXXX)
      $patient_id = $this->generatePatientId();

      $this->db->query('INSERT INTO patients (patient_id, name, phone, dob, gender, blood_group, address, emergency_contact) VALUES(:patient_id, :name, :phone, :dob, :gender, :blood_group, :address, :emergency_contact)');
      // Bind values
      $this->db->bind(':patient_id', $patient_id);
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':phone', $data['phone']);
      $this->db->bind(':dob', $data['dob']);
      $this->db->bind(':gender', $data['gender']);
      $this->db->bind(':blood_group', $data['blood_group']);
      $this->db->bind(':address', $data['address']);
      $this->db->bind(':emergency_contact', $data['emergency_contact']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    private function generatePatientId(){
        $year = date('Y');
        $this->db->query("SELECT patient_id FROM patients WHERE patient_id LIKE 'P-$year-%' ORDER BY id DESC LIMIT 1");
        $row = $this->db->single();
        
        if($row){
            $last_id = explode('-', $row->patient_id);
            $num = intval($last_id[2]) + 1;
            $new_num = str_pad($num, 4, '0', STR_PAD_LEFT);
        } else {
            $new_num = '0001';
        }
        
        return "P-$year-$new_num";
    }

    // Get Patient by ID
    public function getPatientById($id){
      $this->db->query('SELECT * FROM patients WHERE id = :id');
      $this->db->bind(':id', $id);
      return $this->db->single();
    }

    // Update Patient
    public function updatePatient($data){
      $this->db->query('UPDATE patients SET name = :name, phone = :phone, dob = :dob, gender = :gender, blood_group = :blood_group, address = :address, emergency_contact = :emergency_contact WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':phone', $data['phone']);
      $this->db->bind(':dob', $data['dob']);
      $this->db->bind(':gender', $data['gender']);
      $this->db->bind(':blood_group', $data['blood_group']);
      $this->db->bind(':address', $data['address']);
      $this->db->bind(':emergency_contact', $data['emergency_contact']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Delete Patient
    public function deletePatient($id){
      $this->db->query('DELETE FROM patients WHERE id = :id');
      $this->db->bind(':id', $id);

      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
  }
