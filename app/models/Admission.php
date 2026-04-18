<?php
  class Admission {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    // Get Active Admissions
    public function getActiveAdmissions(){
      $this->db->query("SELECT a.*, p.name as patient_name, b.bed_number, w.name as ward_name
                        FROM admissions a
                        JOIN patients p ON a.patient_id = p.id
                        JOIN beds b ON a.bed_id = b.id
                        JOIN wards w ON b.ward_id = w.id
                        WHERE a.status = 'Admitted'
                        ORDER BY a.admission_date DESC");
      return $this->db->resultSet();
    }

    // Add Admission
    public function addAdmission($data){
      // 1. Insert into admissions table
      $this->db->query('INSERT INTO admissions (patient_id, bed_id, admission_date, status) VALUES(:patient_id, :bed_id, :admission_date, :status)');
      $this->db->bind(':patient_id', $data['patient_id']);
      $this->db->bind(':bed_id', $data['bed_id']);
      $this->db->bind(':admission_date', $data['admission_date']);
      $this->db->bind(':status', 'Admitted');

      if($this->db->execute()){
        // 2. Mark bed as occupied
        $this->db->query('UPDATE beds SET is_available = 0 WHERE id = :bed_id');
        $this->db->bind(':bed_id', $data['bed_id']);
        return $this->db->execute();
      } else {
        return false;
      }
    }

    // Discharge Patient
    public function discharge($id, $bed_id){
      $this->db->query('UPDATE admissions SET status = :status, discharge_date = :date WHERE id = :id');
      $this->db->bind(':status', 'Discharged');
      $this->db->bind(':date', date('Y-m-d H:i:s'));
      $this->db->bind(':id', $id);

      if($this->db->execute()){
        // Mark bed as available
        $this->db->query('UPDATE beds SET is_available = 1 WHERE id = :bed_id');
        $this->db->bind(':bed_id', $bed_id);
        return $this->db->execute();
      } else {
        return false;
      }
    }
  }
