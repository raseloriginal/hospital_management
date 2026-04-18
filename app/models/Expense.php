<?php
  class Expense {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    // Get all expenses
    public function getExpenses(){
      $this->db->query('SELECT * FROM expenses ORDER BY expense_date DESC');
      return $this->db->resultSet();
    }

    // Add Expense
    public function addExpense($data){
      $this->db->query('INSERT INTO expenses (category, description, amount, expense_date) VALUES(:category, :description, :amount, :expense_date)');
      // Bind values
      $this->db->bind(':category', $data['category']);
      $this->db->bind(':description', $data['description']);
      $this->db->bind(':amount', $data['amount']);
      $this->db->bind(':expense_date', $data['expense_date']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Get Total Expenses for a period
    public function getTotalExpenses($startDate = null, $endDate = null){
        $sql = "SELECT SUM(amount) as total FROM expenses";
        if($startDate && $endDate){
            $sql .= " WHERE expense_date BETWEEN :start AND :end";
        }
        $this->db->query($sql);
        if($startDate && $endDate){
            $this->db->bind(':start', $startDate);
            $this->db->bind(':end', $endDate);
        }
        $row = $this->db->single();
        return $row->total ?? 0;
    }

    // Delete Expense
    public function deleteExpense($id){
      $this->db->query('DELETE FROM expenses WHERE id = :id');
      $this->db->bind(':id', $id);
      return $this->db->execute();
    }
  }
