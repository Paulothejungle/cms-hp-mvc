<?php

class Order
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllOrders()
    {
        $this->db->query("SELECT orders.*, users.name AS customer_name 
                          FROM orders 
                          JOIN users ON orders.user_id = users.id 
                          ORDER BY orders.id DESC");
        return $this->db->resultSet();
    }

    public function getOrderById($id)
    {
        $this->db->query("SELECT orders.*, users.name AS customer_name, pm.name AS payment_method_name
                                 FROM orders
                                 JOIN users ON orders.user_id = users.id
                                 LEFT JOIN payment_methods pm ON orders.payment_method_id = pm.id
                                 WHERE orders.id = :id");
                                 
        $this->db->bind(':id', $id);
        return $this->db->single();
    }


    public function getOrderItems($orderId)
    {
        $this->db->query("SELECT order_items.*, products.name AS product_name, products.price 
                          FROM order_items 
                          JOIN products ON order_items.product_id = products.id 
                          WHERE order_items.order_id = :orderId");
        $this->db->bind(':orderId', $orderId);
        return $this->db->resultSet();
    }

    public function updateOrderStatus($orderId, $status)
    {
        $this->db->query("UPDATE orders SET status = :status WHERE id = :id");
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $orderId);
        $this->db->execute();
    }


    public function createOrder($userId, $items, $totalPrice, $paymentMethodId, $alamat, $no_hp, $delivery)
    {
        try {
            $this->db->beginTransaction();

            $this->db->query("INSERT INTO orders (user_id, total, alamat, no_hp, delivery, status, payment_method_id) VALUES (:user_id, :total, :alamat, :no_hp, :delivery, 'pending', :payment_method_id)");
            $this->db->bind(':user_id', $userId);
            $this->db->bind(':total', $totalPrice);
            $this->db->bind(':alamat', $alamat);
            $this->db->bind(':no_hp', $no_hp);
            $this->db->bind(':delivery', $delivery);
            $this->db->bind(':payment_method_id', $paymentMethodId);
            $this->db->execute();

            $orderId = $this->db->lastInsertId();

            foreach ($items as $item) {
                $quantity = isset($item['quantity']) ? $item['quantity'] : 1;
            
                // Ambil stok produk
                $this->db->query("SELECT stock, name FROM products WHERE id = :id");
                $this->db->bind(':id', $item['product_id']);
                $product = $this->db->single();
            
                if (!$product) {
                    throw new Exception("Produk tidak ditemukan.");
                }
            
                if ($product['stock'] < $quantity) {
                    throw new Exception("Stok produk '{$product['name']}' tidak mencukupi.");
                }
            
                // Kurangi stok
                $newStock = $product['stock'] - $quantity;
                $this->db->query("UPDATE products SET stock = :stock WHERE id = :id");
                $this->db->bind(':stock', $newStock);
                $this->db->bind(':id', $item['product_id']);
                $this->db->execute();
            
                // Tambah ke order_items
                $this->db->query("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)");
                $this->db->bind(':order_id', $orderId);
                $this->db->bind(':product_id', $item['product_id']);
                $this->db->bind(':quantity', $quantity);
                $this->db->bind(':price', $item['price']);
                $this->db->execute();
            }            

            $this->db->commit();
            return $orderId;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function getOrdersByUserId($userId)
    {
        $this->db->query("SELECT * FROM orders WHERE user_id = :user_id ORDER BY id DESC");
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }

    public function getPaymentMethods()
    {
        $this->db->query("SELECT * FROM payment_methods");
        return $this->db->resultSet();
    }

    public function addPaymentMethod($name, $description)
    {
        $this->db->query("INSERT INTO payment_methods (name, description) VALUES (:name, :description)");
        $this->db->bind(':name', $name);
        $this->db->bind(':description', $description);
        $this->db->execute();
    }

    public function getPaymentMethodById($id)
    {
        $this->db->query("SELECT * FROM payment_methods WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function updatePaymentMethod($id, $name, $description)
    {
        $this->db->query("UPDATE payment_methods SET name = :name, description = :description WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->bind(':name', $name);
        $this->db->bind(':description', $description);
        $this->db->execute();
    }

    public function deletePaymentMethod($id)
    {
        $this->db->query("DELETE FROM payment_methods WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->execute();
    }

    public function searchOrders($keyword)
    {
        $this->db->query("SELECT orders.*, users.name AS customer_name 
                        FROM orders 
                        JOIN users ON orders.user_id = users.id 
                        WHERE users.name LIKE :keyword OR orders.status LIKE :keyword OR orders.created_at LIKE :keyword  
                        ORDER BY orders.id DESC");
        $this->db->bind(':keyword', '%' . $keyword . '%');
        return $this->db->resultSet();
    }

    public function getOrdersByDateRange($from, $to)
    {
        $this->db->query("SELECT orders.*, users.name AS customer_name 
                        FROM orders 
                        JOIN users ON orders.user_id = users.id 
                        WHERE DATE(orders.created_at) BETWEEN :from AND :to
                        ORDER BY orders.id DESC");
        $this->db->bind(':from', $from);
        $this->db->bind(':to', $to);
        return $this->db->resultSet();
    }

    public function countAllOrders()
    {
        $this->db->query("SELECT COUNT(*) as total FROM orders");
        return $this->db->single()['total'];
    }

    public function getLatestByUserId($userId) {
        $this->db->query("SELECT * FROM orders WHERE user_id = :user_id ORDER BY created_at DESC LIMIT 1");
        $this->db->bind(':user_id', $userId);
        return $this->db->single();
    }

    public function getFilteredOrders($from_id, $to_id, $status, $from_date, $to_date)
    {
        $sql = "SELECT orders.*, users.name AS customer_name 
                FROM orders 
                JOIN users ON orders.user_id = users.id 
                WHERE 1=1";
        $params = [];

        // Filter Order ID range
        if ($from_id !== null && $to_id !== null) {
            $sql .= " AND orders.id BETWEEN ? AND ?";
            $params[] = $from_id;
            $params[] = $to_id;
        } elseif ($from_id !== null) {
            $sql .= " AND orders.id >= ?";
            $params[] = $from_id;
        } elseif ($to_id !== null) {
            $sql .= " AND orders.id <= ?";
            $params[] = $to_id;
        }

        // Filter status
        if ($status !== null && $status !== '') {
            $sql .= " AND orders.status = ?";
            $params[] = $status;
        }

        // Filter tanggal
        if ($from_date !== null && $to_date !== null) {
            $sql .= " AND orders.created_at >= ? AND orders.created_at <= ?";
            $params[] = $from_date . ' 00:00:00';
            $params[] = $to_date . ' 23:59:59';
        } elseif ($from_date !== null) {
            $sql .= " AND orders.created_at >= ?";
            $params[] = $from_date . ' 00:00:00';
        } elseif ($to_date !== null) {
            $sql .= " AND orders.created_at <= ?";
            $params[] = $to_date . ' 23:59:59';
        }


        $this->db->query($sql);

        // Bind parameters
        foreach ($params as $index => $param) {
            $this->db->bind($index + 1, $param);
        }

        $this->db->execute();

        return $this->db->resultSet();
    }

    public function savePaymentProof($orderId, $filename)
    {
        $query = "UPDATE orders SET payment_proof = :payment_proof WHERE id = :id";
        
        $this->db->query($query); // Mempersiapkan query
        
        // Binding parameter
        $this->db->bind(':payment_proof', $filename);
        $this->db->bind(':id', $orderId);
        
        // Eksekusi query
        return $this->db->execute(); // Mengembalikan true/false dari eksekusi
    }




}
