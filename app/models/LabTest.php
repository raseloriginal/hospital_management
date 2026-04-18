<?php
  class LabTest {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    // Get all available tests
    public function getAvailableTests(){
      $this->db->query('SELECT * FROM lab_tests ORDER BY test_name ASC');
      return $this->db->resultSet();
    }

    // Get all test requests
    public function getTestRequests(){
      $this->db->query('SELECT lab_requests.*, patients.name as patient_name, patients.patient_id as patient_reg_id, lab_tests.test_name, users.name as doctor_name 
                        FROM lab_requests 
                        JOIN patients ON lab_requests.patient_id = patients.id 
                        JOIN lab_tests ON lab_requests.test_id = lab_tests.id 
                        JOIN doctors ON lab_requests.doctor_id = doctors.id 
                        JOIN users ON doctors.user_id = users.id 
                        ORDER BY lab_requests.created_at DESC');
      return $this->db->resultSet();
    }

    // Add Test Request
    public function addRequest($data){
      $this->db->query('INSERT INTO lab_requests (patient_id, doctor_id, test_id, status) VALUES(:patient_id, :doctor_id, :test_id, :status)');
      $this->db->bind(':patient_id', $data['patient_id']);
      $this->db->bind(':doctor_id', $data['doctor_id']);
      $this->db->bind(':test_id', $data['test_id']);
      $this->db->bind(':status', 'Pending');

      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Update Lab Request Status
    public function updateStatus($id, $status){
      $this->db->query('UPDATE lab_requests SET status = :status WHERE id = :id');
      $this->db->bind(':id', $id);
      $this->db->bind(':status', $status);
      return $this->db->execute();
    }
  }
