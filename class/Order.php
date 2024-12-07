
<?php

class Order extends Db
{
  function addOrder($data)
  {
    $sql = 'INSERT INTO orders (username, street_address, phone_number, email_address, total, payment_method) VALUES (?, ?, ?, ?, ?, ?)';

    return $this->updateSQL($sql, $data);;
  }

  function addOrderDetail($data)
  {
    $sql = 'INSERT INTO order_detail (order_id, product_id, size_id, color_id, quatity, price) VALUES (?, ?, ?, ?, ?, ?)';
    $this->updateSQL($sql, $data);
  }

  function getOrder($id)
  {
    $sql = 'SELECT * FROM orders WHERE order_id = ?';
    return $this->selectSQL($sql, [$id]);
  }

  function getOrderDetail($id)
  {
    $sql = 'SELECT * FROM order_detail WHERE order_id = ?';
    return $this->selectSQL($sql, [$id]);
  }
}

?>
