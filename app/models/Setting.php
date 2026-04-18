<?php
  class Setting {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    // Get settings
    public function getSettings(){
      $this->db->query('SELECT * FROM settings WHERE id = 1');
      return $this->db->single();
    }

    // Update settings
    public function updateSettings($data){
      $this->db->query('UPDATE settings SET 
                        hospital_name = :hospital_name,
                        hospital_tagline = :hospital_tagline,
                        hospital_email = :hospital_email,
                        hospital_phone = :hospital_phone,
                        hospital_address = :hospital_address,
                        currency_symbol = :currency_symbol,
                        logo_path = :logo_path,
                        favicon_path = :favicon_path,
                        facebook_url = :facebook_url,
                        twitter_url = :twitter_url,
                        linkedin_url = :linkedin_url,
                        footer_text = :footer_text,
                        primary_color = :primary_color
                        WHERE id = 1');

      // Bind values
      $this->db->bind(':hospital_name', $data['hospital_name']);
      $this->db->bind(':hospital_tagline', $data['hospital_tagline']);
      $this->db->bind(':hospital_email', $data['hospital_email']);
      $this->db->bind(':hospital_phone', $data['hospital_phone']);
      $this->db->bind(':hospital_address', $data['hospital_address']);
      $this->db->bind(':currency_symbol', $data['currency_symbol']);
      $this->db->bind(':logo_path', $data['logo_path']);
      $this->db->bind(':favicon_path', $data['favicon_path']);
      $this->db->bind(':facebook_url', $data['facebook_url']);
      $this->db->bind(':twitter_url', $data['twitter_url']);
      $this->db->bind(':linkedin_url', $data['linkedin_url']);
      $this->db->bind(':footer_text', $data['footer_text']);
      $this->db->bind(':primary_color', $data['primary_color']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
  }
