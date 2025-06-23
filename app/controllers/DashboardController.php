
<?php
require_once '../app/middleware/AuthMiddleware.php';
class DashboardController extends Controller
{
    protected $productModel;
    protected $orderModel;
    protected $userModel;

    public function __construct()
    {
        
        AuthMiddleware::checkLogin();
        AuthMiddleware::checkRole('admin');

        $this->productModel = $this->model('Product');
        $this->orderModel = $this->model('Order');
        $this->userModel = $this->model('User');
    }

    public function dashboard()
    {
        $productModel = $this->model('Product');
        $orderModel = $this->model('Order');
        $userModel = $this->model('User');

        // Fetch fresh data directly from models
        $totalProduk = $productModel->countAllProducts();
        $totalPesanan = $orderModel->countAllOrders();
        $totalPelanggan = $userModel->countAllCustomers();

        // Pass the data to the view
        $this->view('admin/dashboard', [
            'totalProduk' => $totalProduk,
            'totalPesanan' => $totalPesanan,
            'totalPelanggan' => $totalPelanggan
        ]);
        
    }
}