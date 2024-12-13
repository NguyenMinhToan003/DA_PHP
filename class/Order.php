<?php

class Order extends Db
{
    // Thêm đơn hàng mới
    function addOrder($user_id, $email, $name, $address, $tel, $note, $total)
    {
        $sql = 'INSERT INTO `order` (user_id, email, user_name, user_address, tel, note, total, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
        return $this->insertSQL($sql, [$user_id, $email, $name, $address, $tel, $note, $total, 1]);
    }

    // Thêm chi tiết đơn hàng
    function addOrderDetail($order_id, $product_detail_id, $quantity, $product_name, $total_price)
    {
        $sql = 'INSERT INTO `order_detail` (order_id, product_detail_id, quantity, product_name, total_price) 
                VALUES (?, ?, ?, ?, ?)';
        return $this->insertSQL($sql, [$order_id, $product_detail_id, $quantity, $product_name, $total_price]);
    }

    // Lấy thông tin đơn hàng theo ID
    function getOrder($id)
    {
        $sql = 'SELECT * FROM `order` WHERE order_id = ?';
        return $this->selectSQL($sql, [$id]);
    }

    // Lấy chi tiết đơn hàng theo ID
    function getOrderDetail($order_id)
    {
        $sql = 'SELECT * FROM `order_detail` WHERE order_id = ?';
        return $this->selectSQL($sql, [$order_id]);
    }
    public function updateOrderStatus($order_id, $status) {
        $sql = "UPDATE `order` SET `status` = ? WHERE `order_id` = ?";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute([$status, $order_id]);
    }

}

?>