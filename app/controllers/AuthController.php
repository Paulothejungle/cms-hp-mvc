<?php

class AuthController extends Controller {
    
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = $this->model('User');
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'phone' => $_POST['phone'],
                'address' => $_POST['address'],
                'role' => 'customer'
            ];
            if($userModel->register($data)) {
                echo "<script>alert('Register berhasil! Silahkan login.');
                    window.location.href = '" . BASE_URL . "/auth/login';
                    </script>";
                    exit;
            } else {
                echo "Register gagal!";
            }
        } else {
            $this->view('/auth/register');
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = $this->model('User');
            $user = $userModel->login($_POST['email']);
            if ($user && password_verify($_POST['password'], $user['password'])) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'role' => $user['role']
                ];

                if ($user['role'] == 'admin') {
                    $redirect = 'dashboard/dashboard';
                } elseif ($user['role'] == 'customer') {
                    $redirect = 'dashboardcustomer/index';
                } else {
                    $redirect = 'auth/login'; // fallback
                }
                
                echo "<script>alert('Login berhasil!');
                    window.location.href = '" . BASE_URL . "/$redirect';
                    </script>";
                    exit;                
            } else {
                echo "<script>alert('Login gagal! Periksa email dan password Anda.');
                    window.location.href = '" . BASE_URL . "/auth/login';
                    </script>";
                    exit;  
            }
        } else {
            $this->view('/auth/login');
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: ' . BASE_URL . '/auth/login');
        exit;
    }
}

?>