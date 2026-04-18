<?php
  class PharmacyItem {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    // Get all items
    public function getItems(){
      $this->db->query('SELECT * FROM pharmacy_items ORDER BY name ASC');
      return $this->db->resultSet();
    }

    // Add Item
    public function addItem($data){
      $this->db->query('INSERT INTO pharmacy_items (name, generic_name, category, purchase_price, sale_price, stock_quantity, expiry_date) VALUES(:name, :generic_name, :category, :purchase_price, :sale_price, :stock_quantity, :expiry_date)');
      // Bind values
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':generic_name', $data['generic_name']);
      $this->db->bind(':category', $data['category']);
      $this->db->bind(':purchase_price', $data['purchase_price']);
      $this->db->bind(':sale_price', $data['sale_price']);
      $this->db->bind(':stock_quantity', $data['stock_quantity']);
      $this->db->bind(':expiry_date', $data['expiry_date']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Get Item by ID
    public function getItemById($id){
      $this->db->query('SELECT * FROM pharmacy_items WHERE id = :id');
      $this->db->bind(':id', $id);
      return $this->db->single();
    }

    // Update Item
    public function updateItem($data){
      $this->db->query('UPDATE pharmacy_items SET name = :name, generic_name = :generic_name, category = :category, purchase_price = :purchase_price, sale_price = :sale_price, stock_quantity = :stock_quantity, expiry_date = :expiry_date WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':generic_name', $data['generic_name']);
      $this->db->bind(':category', $data['category']);
      $this->db->bind(':purchase_price', $data['purchase_price']);
      $this->db->bind(':sale_price', $data['sale_price']);
      $this->db->bind(':stock_quantity', $data['stock_quantity']);
      $this->db->bind(':expiry_date', $data['expiry_date']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Delete Item
    public function deleteItem($id){
      $this->db->query('DELETE FROM pharmacy_items WHERE id = :id');
      $this->db->bind(':id', $id);
      return $this->db->execute();
    }
  }
