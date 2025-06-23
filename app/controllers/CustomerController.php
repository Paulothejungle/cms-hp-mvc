<?php
require_once '../app/middleware/AuthMiddleware.php';
class CustomerController extends Controller
{
    public function index()
    {
        AuthMiddleware::checkLogin();
        AuthMiddleware::checkRole('admin');
        $userModel = $this->model('Customer');
        $customers = $userModel->getAllCustomers();

        $this->view('admin/user/customers', [
            'title' => 'Daftar Pelanggan',
            'customers' => $customers
        ]);
    }
}

?>