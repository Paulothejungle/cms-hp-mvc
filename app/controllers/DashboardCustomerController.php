<?php 

class DashboardCustomerController extends Controller
{
    
    public function index()
    {
        $categoryModel = $this->model('Category');
        $categories = $categoryModel->getAll();

        $orders = null;
        $orderItems = [];

        // Cek apakah user sudah login
        if (isset($_SESSION['user'])) {
            $user_id = $_SESSION['user']['id'];

            $orderModel = $this->model('Order');
            $orders = $orderModel->getLatestByUserId($user_id);

            if ($orders && isset($orders['id'])) {
                $orderItems = $orderModel->getOrderItems($orders['id']);
            }
        }

        $this->view('customer/dashboard', [
            'title' => 'Pesanan Terbaru',
            'categories' => $categories,
            'orders' => $orders,
            'orderItems' => $orderItems
        ]);
    }


    public function products()
    {
        $categoryModel = $this->model('Category');
        $productModel = $this->model('Product');

        $categories = $categoryModel->getAll();
        $products = $productModel->getAll(); 

        $this->view('customer/products', [
            'title' => 'Katalog Produk per Kategori',
            'categories' => $categories,
            'products' => $products
        ]);
    }
}

?>