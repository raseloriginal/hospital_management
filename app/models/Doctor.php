<?php
  class Doctor {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    // Get all doctors with user info
    public function getDoctors(){
      $this->db->query('SELECT doctors.*, users.name, users.email, users.profile_image 
                        FROM doctors 
                        JOIN users ON doctors.user_id = users.id 
                        ORDER BY users.name ASC');
      return $this->db->resultSet();
    }

    // Add Doctor
    public function addDoctor($data){
      $this->db->query('INSERT INTO doctors (user_id, department, specialization, experience, qualification, consultation_fee, schedule) VALUES(:user_id, :department, :specialization, :experience, :qualification, :consultation_fee, :schedule)');
      // Bind values
      $this->db->bind(':user_id', $data['user_id']);
      $this->db->bind(':department', $data['department']);
      $this->db->bind(':specialization', $data['specialization']);
      $this->db->bind(':experience', $data['experience']);
      $this->db->bind(':qualification', $data['qualification']);
      $this->db->bind(':consultation_fee', $data['consultation_fee']);
      $this->db->bind(':schedule', $data['schedule']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Get Doctor by ID
    public function getDoctorById($id){
      $this->db->query('SELECT doctors.*, users.name, users.email 
                        FROM doctors 
                        JOIN users ON doctors.user_id = users.id 
                        WHERE doctors.id = :id');
      $this->db->bind(':id', $id);
      return $this->db->single();
    }

    // Update Doctor
    public function updateDoctor($data){
      $this->db->query('UPDATE doctors SET department = :department, specialization = :specialization, experience = :experience, qualification = :qualification, consultation_fee = :consultation_fee, schedule = :schedule WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':department', $data['department']);
      $this->db->bind(':specialization', $data['specialization']);
      $this->db->bind(':experience', $data['experience']);
      $this->db->bind(':qualification', $data['qualification']);
      $this->db->bind(':consultation_fee', $data['consultation_fee']);
      $this->db->bind(':schedule', $data['schedule']);

      // Execute
      if($this->db->execute()){
         // Also update user name
         $this->db->query('UPDATE users SET name = :name WHERE id = :user_id');
         $this->db->bind(':name', $data['name']);
         $this->db->bind(':user_id', $data['user_id']);
         return $this->db->execute();
      } else {
        return false;
      }
    }

    // Delete Doctor
    public function deleteDoctor($id){
      // Get user_id first to delete from users table too
      $this->db->query('SELECT user_id FROM doctors WHERE id = :id');
      $this->db->bind(':id', $id);
      $row = $this->db->single();

      if($row){
        $user_id = $row->user_id;
        $this->db->query('DELETE FROM users WHERE id = :id');
        $this->db->bind(':id', $user_id);
        return $this->db->execute();
      }
      return false;
    }
  }
