<?php
  class Billing extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users/login');
      }
      $this->invoiceModel = $this->model('Invoice');
      $this->patientModel = $this->model('Patient');
    }

    public function index(){
      $invoices = $this->invoiceModel->getInvoices();
      $data = [
        'invoices' => $invoices
      ];
      $this->view('billing/index', $data);
    }

    public function create(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'patient_id' => trim($_POST['patient_id']),
          'total_amount' => trim($_POST['total_amount']),
          'discount' => trim($_POST['discount']),
          'patients' => $this->patientModel->getPatients(),
          'patient_err' => '',
          'amount_err' => ''
        ];

        if(empty($data['patient_id'])){
          $data['patient_err'] = 'Select a patient';
        }

        if(empty($data['total_amount'])){
          $data['amount_err'] = 'Enter total amount';
        }

        if(empty($data['patient_err']) && empty($data['amount_err'])){
          if($this->invoiceModel->createInvoice($data)){
            flash('billing_message', 'Invoice Generated Successfully');
            redirect('billing/index');
          } else {
            die('Something went wrong');
          }
        } else {
          $this->view('billing/create', $data);
        }

      } else {
        $data = [
          'patients' => $this->patientModel->getPatients(),
          'patient_id' => '',
          'total_amount' => '',
          'discount' => '0',
          'patient_err' => '',
          'amount_err' => ''
        ];
        $this->view('billing/create', $data);
      }
    }

    public function pay($id){
      if($this->invoiceModel->updateStatus($id, 'Paid')){
        flash('billing_message', 'Payment Collected Successfully');
        redirect('billing/index');
      }
    }
  }
