<?php

class Product{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getAll() {
        $this->db->query("SELECT products.*, categories.name AS category_name FROM products 
                          JOIN categories ON products.category_id = categories.id 
                          ORDER BY products.id DESC");
        return $this->db->resultSet();
    }
    

    public function findById($id) {
        $this->db->query("SELECT * FROM products WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getProductByCategory($id){
        $this->db->query("SELECT products.*, categories.name AS category_name 
                          FROM products 
                          JOIN categories ON products.category_id = categories.id 
                          WHERE products.category_id = :id");
        $this->db->bind(':id', $id);
        return $this->db->resultSet();                  
    }

    public function create($data) {
        $this->db->query("INSERT INTO products (category_id, name, price, stock, image, description) VALUES (:category_id, :name, :price, :stock, :image, :description)");
        $this->db->bind(':category_id', $data['category_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':stock', $data['stock']);
        $this->db->bind(':image', $data['image']); 
        $this->db->bind(':description', $data['description']);
        return $this->db->execute();
    }
    

    public function update($id, $data) {
        $this->db->query("UPDATE products SET category_id = :category_id, name = :name, price = :price, stock = :stock, image = :image, description = :description WHERE id = :id");
        $this->db->bind(':category_id', $data['category_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':stock', $data['stock']);
        $this->db->bind(':image', $data['image']); 
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
    

    public function delete($id) {
        $this->db->query("DELETE FROM products WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function search($keyword) {
    $this->db->query("SELECT products.*, categories.name AS category_name 
                      FROM products 
                      JOIN categories ON products.category_id = categories.id 
                      WHERE products.name LIKE :keyword 
                      ORDER BY products.id DESC");
    $this->db->bind(':keyword', '%' . $keyword . '%');
    return $this->db->resultSet();
    }


    public function getProductById($id)
    {
        $this->db->query("SELECT * FROM products WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function countAllProducts()
    {
        $this->db->query("SELECT COUNT(*) as total FROM products");
        return $this->db->single()['total'];
    }

}

?>