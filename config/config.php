<?php

// Konfigurasi dasar
define('BASE_URL', 'http://localhost/cms-hp/public');

// Konfigurasi Database
define('DB_HOST', 'localhost');
define('DB_USER', 'root');         
define('DB_PASS', '');             
define('DB_NAME', 'project1');     

// Fungsi koneksi PDO
function getDBConnection() {
    try {
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch(PDOException $e) {
        die("Koneksi database gagal: " . $e->getMessage());
    }
}
