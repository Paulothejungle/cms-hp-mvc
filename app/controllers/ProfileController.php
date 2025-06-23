<?php

class ProfileController extends Controller
{
    
    public function index() 
    {   
        if (!isset($_SESSION['user']['id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        $userId = $_SESSION['user']['id'];

        $userModel = $this->model('User');
        $profile = $userModel->getProfile($userId); 

        // --- Bagian untuk Mengambil Data Pesanan dan Statistik ---
        $orderModel = $this->model('Order');
        $allUserOrders = $orderModel->getOrdersByUserId($userId);

        $totalOrdersCount = 0;
        $inProcessOrdersCount = 0;
        $latestOrder = null;
        $orderItems = [];

        if (!empty($allUserOrders)) {
            $totalOrdersCount = count($allUserOrders);

            foreach ($allUserOrders as $order) {
                $status = strtolower($order['status']);
                if (in_array($status, ['pending', 'verified', 'shipped'])) { 
                    $inProcessOrdersCount++;
                }
            }

            // Ambil pesanan terbaru (pertama dalam array karena diurutkan DESC)
            $latestOrder = $allUserOrders[0];

            // Ambil item dari pesanan terbaru
            if ($latestOrder && isset($latestOrder['id'])) {
                $orderItems = $orderModel->getOrderItems($latestOrder['id']);
            }
        }

        // --- Kirim Semua Data ke View ---
        $this->view('customer/profile', [
            'title' => 'Profil Saya',
            'profile' => $profile, // Data profil
            'latestOrder' => $latestOrder,
            'orderItems' => $orderItems,
            'totalOrdersCount' => $totalOrdersCount, // Total pesanan
            'inProcessOrdersCount' => $inProcessOrdersCount // Pesanan dalam proses
        ]);
    }

    // Update profil
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = $this->model('User');
            $userId = $_SESSION['user']['id'];

            // Ambil data dari form
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $phone = trim($_POST['phone']);
            $address = trim($_POST['address']);

            // Validasi form kosong
            if (empty($name) || empty($email) || empty($phone) || empty($address)) {
                $this->view('customer/profile', [
                    'title' => 'Profil Saya',
                    'error' => 'Semua field harus diisi',
                    'profile' => $_POST
                ]);
                return;
            }

            // Update profil
            if ($userModel->updateProfile($userId, [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'address' => $address
            ])) {
                $_SESSION['user']['name'] = $name; 
                $_SESSION['user']['email'] = $email; 
                $_SESSION['user']['phone'] = $phone;
                $_SESSION['user']['address'] = $address; 
                $_SESSION['success'] = 'Profil berhasil diperbarui';
                header('Location:' . BASE_URL . '/profile/index');
                exit;
            } else {
                $_SESSION['error'] = 'Gagal memperbarui profil';
                header('Location:' . BASE_URL . '/profile/index');
                exit;
            }
        }
    }

    public function changePassword(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user']['id'];
            $oldPassword = trim($_POST['old_password']);
            $newPassword = trim($_POST['new_password']);
            $confirmPassword = trim($_POST['confirm_password']);

            $userModel = $this->model('User');
            $user = $userModel->getProfile($userId);

            if (!password_verify($oldPassword, $user['password'])) {
                $_SESSION['error'] = 'Password lama tidak sesuai';
                header('Location: ' . BASE_URL . '/profile/index');
                exit;
            }

            if ($newPassword !== $confirmPassword) {
                $_SESSION['error'] = 'Konfirmasi password tidak cocok';
                header('Location: ' . BASE_URL . '/profile/index');
                exit;
            }

            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            $userModel->updatePassword($userId, $hashedPassword);
            $_SESSION['success'] = 'Password berhasil diubah';
            header('Location: ' . BASE_URL . '/profile/index');
            exit;
        }
    }
   
    public function changePasswordForm()
    {
        $this->view('customer/change_password', [
            'title' => 'Ganti Password'
        ]);
    }
}
?>