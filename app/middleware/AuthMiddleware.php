<?php


class AuthMiddleware {
    public static function checkLogin() {
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        if (!isset($_SESSION['user'])) {
            header('Location: /cms-hp/public/auth/login');
            exit;
        }
    }

    public static function checkRole($role) {
        if ($_SESSION['user']['role'] !== $role) {
            echo "Akses ditolak. Halaman ini hanya untuk $role.";
            exit;
        }
    }
}
