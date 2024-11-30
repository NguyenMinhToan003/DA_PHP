<?php

if (isset($_GET['add_to_cart'])) {
  $product_id = $_GET['product_id'];
  $color = $_GET['color'];
  $size = $_GET['size'];
  $quatity = $_GET['add_to_cart'];
  $price = $_GET['price'];
  $name = $_GET['name'];
  $url_image = $_GET['url_image'];



  $total = $price * $quatity;
  $cart = array(
    'product_id' => $product_id,
    'color' => $color,
    'name' => $name,
    'url_image' => $url_image,
    'size' => $size,
    'quatity' => $quatity,
    'price' => $price,
    'total' => $total
  );
  session_start();
  if (isset($_SESSION['cart'])) {
    // neu ma co gio hang thi quatity cua san pham se tang len
    $cart = $_SESSION['cart'];
    foreach ($cart as $key => $value) {
      if ($value['product_id'] == $product_id && $value['color'] == $color && $value['size'] == $size) {
        $cart[$key]['quatity'] += $quatity;
        $cart[$key]['total'] += $total;
        break;
      }
    }
    $cart = array_values($cart);
    $_SESSION['cart'] = $cart;
  } else {
    $cart = array($cart);
    $_SESSION['cart'] = $cart;
  }

  header('location:/index.php?page=giohang');
}
