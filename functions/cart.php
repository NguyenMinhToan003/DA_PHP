<?php

if (isset($_POST['add_to_cart'])) {
  $product_id = $_POST['product_id'];
  $color = $_POST['color'];
  $size = $_POST['size'];
  $quatity = $_POST['add_to_cart'];
  $cart = array(
    'product_id' => $product_id,
    'color' => $color,
    'name' => $name,
    'quatity' => $quatity,
    'size' => $size,
  );
  session_start();
  if (isset($_SESSION['cart'])) {
    $carts = $_SESSION['cart'];
    $flag = false;
    foreach ($carts as $key => $value) {
      if ($value['product_id'] == $product_id && $value['color'] == $color && $value['size'] == $size) {
        $carts[$key]['quatity'] += $quatity;
        $carts[$key]['total'] += $total;
        $flag = true;
        break;
      }
    }
    if (!$flag) {
      array_push($carts, $cart);
    }
    $_SESSION['cart'] = $carts;
  } else {
    $cart = array($cart);
    $_SESSION['cart'] = $cart;
  }


  header('location:/index.php?page=giohang');
} else if (isset($_POST['removeCart'])) {
  $product_id = $_POST['product_id'];
  $size = $_POST['size'];
  $color = $_POST['color'];
  session_start();
  $carts = $_SESSION['cart'];

  foreach ($carts as $key => $value) {
    if ($value['product_id'] == $product_id && $value['color'] == $color && $value['size'] == $size) {
      unset($carts[$key]);
      break;
    }
  }
  $_SESSION['cart'] = $carts ? array_values($carts) : [];
  header('location:/index.php?page=giohang');
} else if (isset($_POST['updateCart'])) {
  $product_id = $_POST['product_id'];
  $quatity = $_POST['quatity'];
  $size = $_POST['size'];
  $color = $_POST['color'];
  session_start();
  $carts = $_SESSION['cart'];
  foreach ($carts as $key => $value) {
    if ($value['product_id'] == $product_id && $value['color'] == $color && $value['size'] == $size) {
      $carts[$key]['quatity'] = $quatity;
      $carts[$key]['total'] = $quatity * $carts[$key]['price'];
      break;
    }
  }
  $_SESSION['cart'] = $carts;
  header('location:/index.php?page=giohang');
} else {
  header('location:/index.php');
}
