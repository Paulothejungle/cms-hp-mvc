<?php

class Cart
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Tambahkan produk ke keranjang
    public function addToCart($userId, $productId, $quantity = 1)
    {
        // Cek apakah produk sudah ada di keranjang user ini
        $this->db->query("SELECT * FROM carts WHERE user_id = :user_id AND product_id = :product_id");
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':product_id', $productId);
        $cartItem = $this->db->single();

        if ($cartItem) {
            // Produk sudah ada, update quantity
            $newQuantity = $cartItem['quantity'] + $quantity;
            $this->db->query("UPDATE carts SET quantity = :quantity WHERE id = :id");
            $this->db->bind(':quantity', $newQuantity);
            $this->db->bind(':id', $cartItem['id']);
            return $this->db->execute();
        } else {
            // Produk belum ada, insert baru
            $this->db->query("INSERT INTO carts (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)");
            $this->db->bind(':user_id', $userId);
            $this->db->bind(':product_id', $productId);
            $this->db->bind(':quantity', $quantity);
            return $this->db->execute();
        }
    }

    // Ambil semua item keranjang berdasarkan user
    public function getCartItems($userId)
    {
        $this->db->query("SELECT carts.*, products.name AS product_name, products.price, products.image 
                          FROM carts 
                          JOIN products ON carts.product_id = products.id 
                          WHERE carts.user_id = :user_id");
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }

    // Hapus item keranjang berdasarkan id cart
    public function removeFromCart($cartId)
    {
        $this->db->query("DELETE FROM carts WHERE id = :id");
        $this->db->bind(':id', $cartId);
        return $this->db->execute();
    }

    // Bersihkan keranjang setelah checkout
    public function clearCart($userId)
    {
        $this->db->query("DELETE FROM carts WHERE user_id = :user_id");
        $this->db->bind(':user_id', $userId);
        return $this->db->execute();
    }
}

?>
