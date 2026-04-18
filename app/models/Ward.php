<?php
  class Ward {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    // Get all wards with bed counts
    public function getWards(){
      $this->db->query('SELECT w.*, 
                        (SELECT COUNT(*) FROM beds WHERE ward_id = w.id) as total_beds,
                        (SELECT COUNT(*) FROM beds WHERE ward_id = w.id AND is_available = 1) as available_beds
                        FROM wards w');
      return $this->db->resultSet();
    }

    // Get beds by ward ID with occupancy details
    public function getWardBeds($ward_id){
      $this->db->query('SELECT b.*, p.name as patient_name, a.patient_id, a.admission_date, a.id as admission_id
                        FROM beds b
                        LEFT JOIN admissions a ON b.id = a.bed_id AND a.status = "Admitted"
                        LEFT JOIN patients p ON a.patient_id = p.id
                        WHERE b.ward_id = :ward_id
                        ORDER BY b.bed_number ASC');
      $this->db->bind(':ward_id', $ward_id);
      return $this->db->resultSet();
    }

    // Get all beds in hospital for a global map
    public function getAllBeds(){
        $this->db->query('SELECT b.*, w.name as ward_name, w.type as ward_type, p.name as patient_name, a.patient_id
                        FROM beds b
                        JOIN wards w ON b.ward_id = w.id
                        LEFT JOIN admissions a ON b.id = a.bed_id AND a.status = "Admitted"
                        LEFT JOIN patients p ON a.patient_id = p.id
                        ORDER BY w.name ASC, b.bed_number ASC');
        return $this->db->resultSet();
    }
  }
