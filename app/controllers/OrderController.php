<?php
require_once '../app/middleware/AuthMiddleware.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class OrderController extends Controller{
    private $orderModel;
    private $cartModel;

    public function __construct(){
        $this->orderModel = $this->model('Order');
        $this->cartModel = $this->model('Cart');
        $this->productModel = $this->model('Product');
        date_default_timezone_set('Asia/Jakarta');
    }
    
    public function index(){
        AuthMiddleware::checkLogin();
        AuthMiddleware::checkRole('admin');
        $orderModel = $this->model('Order');

        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $keyword = $_GET['search'];
            $orders = $orderModel->searchOrders($keyword);
        } else {
            $orders = $orderModel->getAllOrders();
        }

        $this->view('admin/order/index', [
            'title' => 'Daftar Pesanan',
            'orders' => $orders
        ]);
    }


    public function detail($id){
        AuthMiddleware::checkLogin();
        AuthMiddleware::checkRole('admin');
        $orderModel = $this->model('Order');
        $order = $orderModel->getOrderById($id);
        $orderItems = $orderModel->getOrderItems($id);
        $this->view('admin/order/detail', [
            'title' => 'Detail Pesanan',
            'order' => $order,
            'items' => $orderItems
        ]);
    }

    public function edit($id) {
        AuthMiddleware::checkLogin();
        AuthMiddleware::checkRole('admin');
        $orderModel = $this->model('Order');
        $order = $orderModel->getOrderById($id);
    
        if (!$order) {
            header('Location: ' . BASE_URL . '/order/index');
            exit;
        }
    
        $this->view('admin/order/edit', [
            'title' => 'Edit Status Pesanan',
            'order' => $order
        ]);
    }

    public function update($id){
        AuthMiddleware::checkLogin();
        AuthMiddleware::checkRole('admin');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = $_POST['status'];
    
            // Validasi status agar hanya sesuai pilihan yang kamu izinkan
            $allowedStatus = ['pending', 'verified', 'shipped', 'completed'];
            if (!in_array($status, $allowedStatus)) {
                die('Status tidak valid');
            }
    
            $this->orderModel->updateOrderStatus($id, $status);
            header('Location: ' . BASE_URL . '/order/index'); // Redirect ke halaman admin orders
            exit;
        }
    }

    public function checkoutCart()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        AuthMiddleware::checkLogin();
        AuthMiddleware::checkRole('customer');

        $userId = $_SESSION['user']['id'];
        $cartItems = $this->cartModel->getCartItems($userId);
        $paymentMethods = $this->orderModel->getPaymentMethods();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $paymentMethodId = $_POST['payment_method_id'];
            $alamat = $_POST['alamat'];
            $no_hp = $_POST['no_hp'];
            $delivery = $_POST['delivery'];
            $productIds = $_POST['product_id'];
            $quantities = $_POST['quantity'];
            $items = [];
            $totalPrice = 0;

            foreach ($productIds as $index => $productId) {
                $product = $this->productModel->getProductById($productId);
                if (!$product) continue;

                $qty = max((int)$quantities[$index], 1);
                $items[] = [
                    'product_id' => $productId,
                    'quantity' => $qty,
                    'price' => $product['price']
                ];
                $totalPrice += $product['price'] * $qty;
            }

            try {
                $orderId = $this->orderModel->createOrder($userId, $items, $totalPrice, $paymentMethodId, $alamat, $no_hp, $delivery);
                $this->cartModel->clearCart($userId);

                header('Location: ' . BASE_URL . '/order/checkout_success/' . $orderId);
                exit;
            } catch (Exception $e) {
                $_SESSION['error'] = $e->getMessage(); // Simpan pesan error
                header('Location: ' . BASE_URL . '/cart');
                exit;
            }
        }

        $this->view('customer/order/checkout_form', [
            'title' => 'Checkout Keranjang',
            'cartItems' => $cartItems,
            'paymentMethods' => $paymentMethods
        ]);
    }

    public function checkoutSingle($productId)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        AuthMiddleware::checkLogin();
        AuthMiddleware::checkRole('customer');

        $userId = $_SESSION['user']['id'];
        $product = $this->productModel->getProductById($productId);

        if (!$product) {
            echo "Produk tidak ditemukan.";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $quantity = isset($_POST['quantity'][0]) ? (int)$_POST['quantity'][0] : 1;

            if ($product['stock'] < $quantity) {
                $errorMessage = "Stok untuk produk '" . htmlspecialchars($product['name']) . "' tidak mencukupi. Sisa stok: " . $product['stock'] . ".";
                $_SESSION['error_message'] = $errorMessage;
             
                header('Location: ' . BASE_URL . '/order/checkoutSingle/' . $productId);
                exit;
            }

            $paymentMethodId = $_POST['payment_method_id'];
            $alamat = $_POST['alamat'];
            $no_hp = $_POST['no_hp'];
            $delivery = $_POST['delivery'];

            $itemTotal = $product['price'] * $quantity;

            $singleItem = [[
                'product_id' => $product['id'],
                'quantity' => $quantity,
                'price' => $product['price']
            ]];

            try {
                $orderId = $this->orderModel->createOrder($userId, $singleItem, $itemTotal, $paymentMethodId, $alamat, $no_hp, $delivery);
                header('Location: ' . BASE_URL . '/order/checkout_success/' . $orderId);
                exit;
            } catch (Exception $e) {
                $_SESSION['error_message'] = "Terjadi kesalahan: " . $e->getMessage();
                header('Location: ' . BASE_URL . '/order/checkoutSingle/' . $productId);
                exit;
            }
        }

        $singleItem = [[
            'product_id' => $product['id'],
            'product_name' => $product['name'],
            'quantity' => 1,
            'price' => $product['price'],
            'stock' => $product['stock'] 
        ]];

        $paymentMethods = $this->orderModel->getPaymentMethods();

        $this->view('customer/order/checkout_form', [
            'title' => 'Checkout Produk',
            'cartItems' => $singleItem,
            'paymentMethods' => $paymentMethods
        ]);
    }

    public function checkout_success($orderId)
    {
        $orderModel = $this->model('Order');
        $order = $orderModel->getOrderById($orderId);
        $orderItems = $orderModel->getOrderItems($orderId);

        $this->view('customer/order/checkout_success', [
            'title' => 'Checkout Berhasil',
            'order' => $order,
            'items' => $orderItems,
        ]);
    }

    public function myOrders()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        $userId = $_SESSION['user']['id'];
        $orders = $this->orderModel->getOrdersByUserId($userId); 

        $this->view('customer/orders', [
            'title' => 'Pesanan Saya',
            'orders' => $orders
        ]);
    }

    public function myOrderDetail($id)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        $order = $this->orderModel->getOrderById($id);
        $orderItems = $this->orderModel->getOrderItems($id);

        $this->view('customer/order/order_detail', [
            'title' => 'Detail Pesanan',
            'order' => $order,
            'items' => $orderItems
        ]);
    }

    public function export_excel()
    {
        // Pastikan method POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/order/index');
            exit;
        }

        // Ambil dan validasi filter input
        $from_id = !empty($_POST['from_id']) && is_numeric($_POST['from_id']) ? (int)$_POST['from_id'] : null;
        $to_id = !empty($_POST['to_id']) && is_numeric($_POST['to_id']) ? (int)$_POST['to_id'] : null;
        $status_allowed = ['pending', 'shipped', 'verified', 'completed'];
        $status = in_array($_POST['status'] ?? '', $status_allowed) ? $_POST['status'] : null;

        $from_date = !empty($_POST['from_date']) && $this->validateDate($_POST['from_date']) ? $_POST['from_date'] : null;
        $to_date = !empty($_POST['to_date']) && $this->validateDate($_POST['to_date']) ? $_POST['to_date'] : null;

        // Ambil data order sesuai filter
        $orders = $this->orderModel->getFilteredOrders($from_id, $to_id, $status, $from_date, $to_date);

        if (empty($orders)) {
            // Kalau data kosong, redirect atau tampil pesan error
            $_SESSION['error'] = "Data pesanan tidak ditemukan dengan filter tersebut.";
            header('Location: ' . BASE_URL . '/order/index');
            exit;
        }

        // Setup PhpSpreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data Pesanan');

        // Judul laporan
        $sheet->mergeCells('A1:E1');
        $sheet->setCellValue('A1', 'LAPORAN DATA PESANAN');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

        // Info filter
        $filterText = '';
        if ($from_id !== null && $to_id !== null) {
            $filterText .= "Order ID $from_id - $to_id; ";
        }
        if ($status) {
            $filterText .= "Status " . ucfirst($status) . "; ";
        }
        if ($from_date !== null && $to_date !== null) {
            $filterText .= "Tanggal " . date('d/m/Y', strtotime($from_date)) . " - " . date('d/m/Y', strtotime($to_date));
        }
        $sheet->mergeCells('A2:E2');
        $sheet->setCellValue('A2', 'Filter: ' . trim($filterText));
        $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');

        // Header tabel
        $headers = ['Order ID', 'Customer', 'Total Bayar', 'Status', 'Tanggal'];
        $sheet->fromArray($headers, null, 'A4');
        $sheet->getStyle('A4:E4')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '4CAF50']],
            'alignment' => ['horizontal' => 'center'],
            'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]
        ]);

        // Isi data
        $row = 5;
        foreach ($orders as $order) {
            $sheet->setCellValue('A' . $row, $order['id']);
            $sheet->setCellValue('B' . $row, $order['customer_name']);
            $sheet->setCellValue('C' . $row, 'Rp ' . number_format($order['total'], 0, ',', '.'));
            $sheet->setCellValue('D' . $row, strtoupper($order['status']));
            $sheet->setCellValue('E' . $row, date('d/m/Y', strtotime($order['created_at'])));
            $sheet->getStyle('C' . $row)->getAlignment()->setHorizontal('right');
            $row++;
        }

        // Total pembayaran dan jumlah pesanan
        $totalBayar = array_sum(array_column($orders, 'total'));
        $sheet->setCellValue("B$row", 'TOTAL PEMBAYARAN');
        $sheet->setCellValue("C$row", 'Rp ' . number_format($totalBayar, 0, ',', '.'));
        $sheet->getStyle("B$row:C$row")->getFont()->setBold(true);

        $row++;
        $sheet->setCellValue("B$row", 'TOTAL PESANAN');
        $sheet->setCellValue("C$row", count($orders) . ' pesanan');
        $sheet->getStyle("B$row:C$row")->getFont()->setBold(true);

        // Border & auto width kolom
        $sheet->getStyle('A4:E' . $row)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        foreach (range('A', 'E') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Output file Excel
        $filename = "data_pesanan_" . date('Ymd_His') . ".xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        ob_clean();
        flush();

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    // Fungsi validasi format tanggal yyyy-mm-dd
    private function validateDate($date, $format = 'Y-m-d'): bool
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }   

    public function uploadPaymentProof($orderId)
    {
        AuthMiddleware::checkLogin();
        AuthMiddleware::checkRole('customer');

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['payment_proof'])) {
            $file = $_FILES['payment_proof'];

            // Validasi ukuran file (maks. 2MB)
            if ($file['size'] > 2 * 1024 * 1024) {
                $_SESSION['error'] = 'Ukuran file maksimal 2MB.';
                header('Location: ' . BASE_URL . '/order/myOrders/' . $orderId);
                exit;
            }

            // Validasi ekstensi file
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if (!in_array($extension, $allowedExtensions)) {
                $_SESSION['error'] = 'Format file tidak didukung. Hanya jpg, jpeg, png, gif.';
                header('Location: ' . BASE_URL . '/order/myOrders/' . $orderId);
                exit;
            }

            // Simpan file
            $uploadDir = '../public/image/';
            $filename = uniqid() . '-' . basename($file['name']);
            $uploadPath = $uploadDir . $filename;

            if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                $this->orderModel->savePaymentProof($orderId, $filename);
                $_SESSION['success'] = 'Bukti pembayaran berhasil diunggah.';
                header('Location: ' . BASE_URL . '/order/myOrders/' . $orderId);
                exit;
            } else {
                $_SESSION['error'] = 'Gagal mengunggah file.';
                header('Location: ' . BASE_URL . '/order/myOrders/' . $orderId);
                exit;
            }
        }
    }
    
}

?>