<?php
  class Pharmacy extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users/login');
      }
      $this->pharmacyModel = $this->model('PharmacyItem');
    }

    public function index(){
      $items = $this->pharmacyModel->getItems();
      $data = [
        'items' => $items
      ];
      $this->view('pharmacy/index', $data);
    }

    public function add(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'name' => trim($_POST['name']),
          'generic_name' => trim($_POST['generic_name']),
          'category' => trim($_POST['category']),
          'purchase_price' => trim($_POST['purchase_price']),
          'sale_price' => trim($_POST['sale_price']),
          'stock_quantity' => trim($_POST['stock_quantity']),
          'expiry_date' => trim($_POST['expiry_date']),
          'name_err' => ''
        ];

        if(empty($data['name'])){
          $data['name_err'] = 'Please enter medicine name';
        }

        if(empty($data['name_err'])){
          if($this->pharmacyModel->addItem($data)){
            flash('pharmacy_message', 'Medicine Added Successfully');
            redirect('pharmacy/index');
          } else {
            die('Something went wrong');
          }
        } else {
          $this->view('pharmacy/add', $data);
        }

      } else {
        $data = [
          'name' => '',
          'generic_name' => '',
          'category' => '',
          'purchase_price' => '',
          'sale_price' => '',
          'stock_quantity' => '',
          'expiry_date' => '',
          'name_err' => ''
        ];
        $this->view('pharmacy/add', $data);
      }
    }

    public function edit($id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'id' => $id,
          'name' => trim($_POST['name']),
          'generic_name' => trim($_POST['generic_name']),
          'category' => trim($_POST['category']),
          'purchase_price' => trim($_POST['purchase_price']),
          'sale_price' => trim($_POST['sale_price']),
          'stock_quantity' => trim($_POST['stock_quantity']),
          'expiry_date' => trim($_POST['expiry_date']),
          'name_err' => ''
        ];

        if(empty($data['name'])){ $data['name_err'] = 'Please enter medicine name'; }

        if(empty($data['name_err'])){
          if($this->pharmacyModel->updateItem($data)){
            flash('pharmacy_message', 'Medicine Updated');
            redirect('pharmacy/index');
          } else {
            die('Something went wrong');
          }
        } else {
          $this->view('pharmacy/edit', $data);
        }

      } else {
        $item = $this->pharmacyModel->getItemById($id);
        $data = [
          'id' => $id,
          'name' => $item->name,
          'generic_name' => $item->generic_name,
          'category' => $item->category,
          'purchase_price' => $item->purchase_price,
          'sale_price' => $item->sale_price,
          'stock_quantity' => $item->stock_quantity,
          'expiry_date' => $item->expiry_date,
          'name_err' => ''
        ];
        $this->view('pharmacy/edit', $data);
      }
    }

    public function delete($id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($this->pharmacyModel->deleteItem($id)){
          flash('pharmacy_message', 'Medicine Removed');
          redirect('pharmacy/index');
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('pharmacy/index');
      }
    }
  }
