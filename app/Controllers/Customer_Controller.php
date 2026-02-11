<?php
namespace App\Controllers;

use App\Core\Database;
use App\Models\Customer;

class Customer_Controller extends BaseController
{
    private $customerModel;

    public function __construct()
    {
        $db = new Database();
        $connect = $db->getConnection();
        $this->customerModel = new Customer($connect);
    }

    public function index()
    {
        $customers = $this->customerModel->getAll();
        $this->renderView('Customer_list', ['customers' => $customers]);
    }

    public function delete()
    {
        $id = $_GET['id'];
        $this->customerModel->deleteCustomer($id);
        header('Location: /');
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $gender = $_POST['gender'];
            $status = $_POST['status'];
            $this->customerModel->addCustomer($name, $email, $phone, $address, $gender, $status);
            header('Location: /');
        } else {
            $this->renderView('add');
        }
    }

    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $gender = $_POST['gender'];
            $status = $_POST['status'];
            $this->customerModel->editCustomer(
                $id,
                $name,
                $email,
                $phone,
                $address,
                $gender,
                $status,
            );
            header('Location: /');
        }
        $id = $_GET['id'];
        $customer = $this->customerModel->getById($id);
        $this->renderView('edit', ['customer' => $customer]);
    }

    public function search()
    {
        $search = trim($_GET['search'] ?? '');
        if ($search) {
            $customers = $this->customerModel->searchCustomer($search);
            $this->renderView('Customer_list', ['customers' => $customers, 'search' => $search]);
        } else {
            $customers = $this->customerModel->getAll();
            $this->renderView('Customer_list', ['customers' => $customers, 'search' => '']);
        }
    }
}
