<?php
include './config/tailwind.php';
include './functions/function.php';
spl_autoload_register('autoLoad');
session_start();
$route = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($route) {
  case 'home':
    include 'pages/home.php';
    break;
  case 'sanpham':
    include 'pages/product.php';
    break;
  case 'giohang':
    include './pages/cart.php';
    break;
  case 'timkiem':
    include './pages/SearchProduct.php';
    break;
  case 'dangky':
    include 'pages/register.php';
    break;
  case 'dangnhap':
    include 'pages/login.php';
    break;
  case 'addToCart':
    include './functions/cart.php';
    break;
  case 'qlsanpham':
    include './admin/qlsanpham.php';
    break;
  case 'qlsanpham':
    include './admin/qltaikhoan.php';
    break;
  case 'qlsanpham':
    include './admin/qlgiohang.php';
    break;
  default:
    include 'pages/404.php';
    break;
}
