<?php

require_once '../class/Db.php';
require_once '../class/Product.php';

if (isset($_GET['id'])) {
  $product_id = $_GET['id'];
  $product = new Product();
  $product->deleteProduct($product_id);
  header('location: index.php?1');
}
