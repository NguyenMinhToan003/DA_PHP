<?php
require_once '../class/Db.php';
require_once '../class/Product.php';

if (isset($_POST['add_to_cart'])) {
  $product_id = $_POST['product_id'];
  $color = $_POST['color'];
  $size = $_POST['size'];
  $quatity = $_POST['add_to_cart'];
  $product = new Product();
  $product = $product->getProductDetailByIdColorIdSizeId($product_id, $color, $size);
  session_start();
  $cart = $_SESSION['cart'] ?? [];

  foreach ($cart as $key => $value) {
    if ($product['product_detail_id'] == $value['product_detail_id']) {
      $cart[$key]['quatity'] += $quatity;
      $_SESSION['cart'] = $cart;
      header('location:/index.php?page=giohang');
      exit;
    }
  }

  $cart[] = [
    'product_detail_id' => $product['product_detail_id'],
    'product_id' => $product_id,
    'name' => $product['name'],
    'price' => $product['price'],
    'color_name' => $product['color_name'],
    'size_name' => $product['size_name'],
    'url_image' => $product['images'][0]['url_image'],
    'quatity' => $quatity,
  ];
  $_SESSION['cart'] = $cart;

  header('location:/index.php?page=giohang');
} else if (isset($_POST['removeCart'])) {
  $product_detail_id = $_POST['product_detail_id'];
  session_start();
  $carts = $_SESSION['cart'];
  foreach ($carts as $key => $value) {
    if ($value['product_detail_id'] == $product_detail_id) {
      unset($carts[$key]);
      break;
    }
  }
  $_SESSION['cart'] = $carts ? array_values($carts) : [];
  header('location:/index.php?page=giohang');
} else if (isset($_POST['updateCart'])) {
  $product_detail_id = $_POST['product_detail_id'];
  $quatity = $_POST['quatity'];
  if ($quatity >= 1) {
    session_start();
    $carts = $_SESSION['cart'];
    foreach ($carts as $key => $value) {
      if ($value['product_detail_id'] == $product_detail_id) {
        $carts[$key]['quatity'] = $quatity;
        break;
      }
    }
    $_SESSION['cart'] = $carts;
  }
  header('location:/index.php?page=giohang');
} else {
  header('location:/index.php');
}
