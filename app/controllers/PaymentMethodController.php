<?php
require_once '../app/middleware/AuthMiddleware.php';
class PaymentMethodController extends Controller
{
    private $model;

    public function __construct()
    {
        AuthMiddleware::checkLogin();
        AuthMiddleware::checkRole('admin');
        $this->model = $this->model('Order'); // karena methodnya di Order model
    }

    public function pembayaran()
    {
        $methods = $this->model->getPaymentMethods();
        $this->view('admin/payment_method/index', [
            'title' => 'Metode Pembayaran',
            'methods' => $methods
        ]);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];

            $this->model->addPaymentMethod($name, $description);
            header('Location: ' . BASE_URL . '/paymentmethod/index');
            exit;
        }

        $this->view('admin/payment_method/add', ['title' => 'Tambah Metode Pembayaran']);
    }

    public function edit($id)
    {
        $method = $this->model->getPaymentMethodById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];

            $this->model->updatePaymentMethod($id, $name, $description);
            header('Location: ' . BASE_URL . '/paymentmethod/index');
            exit;
        }

        $this->view('admin/payment_method/edit', [
            'title' => 'Edit Metode Pembayaran',
            'method' => $method 
        ]);
    }

    public function delete($id)
    {
        $this->model->deletePaymentMethod($id);
        header('Location: ' . BASE_URL . '/paymentmethod/index');
        exit;
    }
}
