<?php

class User{
    private $db;


    public function __construct() {
        $this->db = new Database;
    }

    public function register($data) {
        $query = "INSERT INTO users (name, email, password, phone, address, role) VALUES (:name, :email, :password, :phone, :address, :role)";
        $this->db->query($query);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_BCRYPT));
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':role', $data['role']);
        return $this->db->execute();
    }

    public function login($email) {
        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind(':email', $email);
        return $this->db->single();
    }

    public function countAllCustomers()
    {
        $this->db->query("SELECT COUNT(*) as total FROM users WHERE role = 'customer'");
        return $this->db->single()['total'];
    }

    // profile customer
    public function getProfile($userId) {
        $this->db->query("SELECT * FROM users WHERE id = :id");
        $this->db->bind(':id', $userId);
        return $this->db->single();
    }

    public function updateProfile($userId, $data) {
        $query = "UPDATE users SET name = :name, email = :email, phone = :phone, address = :address WHERE id = :id";
        $this->db->query($query);
        $this->db->bind(':id', $userId);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':address', $data['address']);
        return $this->db->execute();
    }

    public function updatePassword($userId, $hashedPassword) {
        $query = "UPDATE users SET password = :password WHERE id = :id";
        $this->db->query($query);
        $this->db->bind(':id', $userId);
        $this->db->bind(':password', $hashedPassword);
        return $this->db->execute();
    }

}

?>