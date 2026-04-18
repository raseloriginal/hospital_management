<?php
  class Expenses extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users/login');
      }
      // Restricted to admin and accountant
      if($_SESSION['user_role'] != 'admin' && $_SESSION['user_role'] != 'accountant'){
          flash('access_denied', 'You do not have permission to access the financial module.', 'bg-red-100 text-red-700 p-3 mb-4 border border-red-400');
          redirect('pages/index');
      }

      $this->expenseModel = $this->model('Expense');
    }

    public function index(){
      $expenses = $this->expenseModel->getExpenses();
      $total = $this->expenseModel->getTotalExpenses();

      $data = [
        'expenses' => $expenses,
        'total_spent' => $total
      ];

      $this->view('expenses/index', $data);
    }

    public function add(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'category' => trim($_POST['category']),
          'description' => trim($_POST['description']),
          'amount' => trim($_POST['amount']),
          'expense_date' => trim($_POST['expense_date']),
          'category_err' => '',
          'amount_err' => '',
          'date_err' => ''
        ];

        // Validate
        if(empty($data['category'])){
          $data['category_err'] = 'Please select a category';
        }
        if(empty($data['amount'])){
          $data['amount_err'] = 'Please enter amount';
        }
        if(empty($data['expense_date'])){
          $data['date_err'] = 'Please select date';
        }

        // Make sure no errors
        if(empty($data['category_err']) && empty($data['amount_err']) && empty($data['date_err'])){
          if($this->expenseModel->addExpense($data)){
            flash('expense_message', 'Expense Added Successfully');
            redirect('expenses');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('expenses/add', $data);
        }

      } else {
        $data = [
          'category' => '',
          'description' => '',
          'amount' => '',
          'expense_date' => date('Y-m-d'),
          'category_err' => '',
          'amount_err' => '',
          'date_err' => ''
        ];

        $this->view('expenses/add', $data);
      }
    }

    public function delete($id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($this->expenseModel->deleteExpense($id)){
          flash('expense_message', 'Expense Removed');
          redirect('expenses');
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('expenses');
      }
    }
  }
