<?php

class CartController extends Controller
{
    private $cartModel;
    private $paymentMethods;

    public function __construct()
    {
        $this->cartModel = $this->model('Cart');
        $this->paymentMethods = $this->model('Order');
    }

    // Menampilkan semua item dalam keranjang user
    public function index()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        $userId = $_SESSION['user']['id'];
        $cartItems = $this->cartModel->getCartItems($userId);
        $paymentMethods = $this->paymentMethods->getPaymentMethods();

        $this->view('customer/cart', [
            'title' => 'Keranjang Saya',
            'cartItems' => $cartItems,
            'paymentMethods' => $paymentMethods
        ]);
    }

    // Menambahkan produk ke keranjang
    public function add($productId)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        $userId = $_SESSION['user']['id'];
        $this->cartModel->addToCart($userId, $productId);

        header('Location: ' . BASE_URL . '/cart');
        exit;
    }

    // Menghapus produk dari keranjang
    public function remove($cartId)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        $this->cartModel->removeFromCart($cartId);

        header('Location: ' . BASE_URL . '/cart');
        exit;
    }

    public function update($itemId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);

            if ($quantity !== false && $quantity > 0) {
                // Logika untuk memperbarui keranjang (sesi atau database)
                $this->cartModel->updateItem($itemId, $quantity, $_SESSION['user']['id'] ?? null); // Contoh menggunakan model

                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['error' => 'Jumlah tidak valid.']);
            }
        } else {
            // Handle jika bukan POST request
            echo json_encode(['error' => 'Metode request tidak valid.']);
        }
    }
}

?>
