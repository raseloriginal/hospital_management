<?php
  class Invoice {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    // Get all invoices
    public function getInvoices(){
      $this->db->query('SELECT invoices.*, patients.name as patient_name, patients.patient_id as patient_reg_id 
                        FROM invoices 
                        JOIN patients ON invoices.patient_id = patients.id 
                        ORDER BY invoices.created_at DESC');
      return $this->db->resultSet();
    }

    // Create Invoice
    public function createInvoice($data){
      $invoice_no = $this->generateInvoiceNo();
      $payable = $data['total_amount'] - $data['discount'];

      $this->db->query('INSERT INTO invoices (invoice_no, patient_id, total_amount, discount, payable_amount, status) VALUES(:invoice_no, :patient_id, :total_amount, :discount, :payable_amount, :status)');
      $this->db->bind(':invoice_no', $invoice_no);
      $this->db->bind(':patient_id', $data['patient_id']);
      $this->db->bind(':total_amount', $data['total_amount']);
      $this->db->bind(':discount', $data['discount']);
      $this->db->bind(':payable_amount', $payable);
      $this->db->bind(':status', 'Unpaid');

      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    private function generateInvoiceNo(){
        return "INV-" . time();
    }

    // Update Invoice Status
    public function updateStatus($id, $status){
      $this->db->query('UPDATE invoices SET status = :status WHERE id = :id');
      $this->db->bind(':id', $id);
      $this->db->bind(':status', $status);
      return $this->db->execute();
    }
  }
