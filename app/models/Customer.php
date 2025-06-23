<?php

class Customer
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllCustomers()
    {
        $this->db->query("SELECT * FROM users WHERE role = 'customer' ORDER BY id DESC");
        return $this->db->resultSet();
    }
}
?>
