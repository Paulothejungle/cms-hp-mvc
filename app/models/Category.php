<?php 

class Category {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getAll() {
        $this->db->query("SELECT * FROM categories ORDER BY name ASC");
        return $this->db->resultSet();
    }

    public function findById($id) {
        $this->db->query("SELECT * FROM categories WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function create($data) {
        $this->db->query("INSERT INTO categories (name, image) VALUES (:name, :image)");
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':image', $data['image']);
        return $this->db->execute();
    }

    public function update($id, $data) {
        $this->db->query("UPDATE categories SET name = :name, image = :image WHERE id = :id");
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query("DELETE FROM categories WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function search($keyword) {
        $this->db->query("SELECT * FROM categories WHERE name LIKE :keyword ORDER BY id DESC");
        $this->db->bind(':keyword', '%' . $keyword . '%');
        return $this->db->resultSet();
    }
    
}
?>