<?php
include './config/tailwind.php';
include './functions/function.php';
spl_autoload_register('autoLoad');
session_start();
$route = isset($_GET['page']) ? $_GET['page'] : 'home';
function checkUser()
{
  if (!isset($_SESSION['user'])) {
    header('Location: index.php?page=dangnhap');
    exit();
  } else if ($_SESSION['user']['role_id'] !== 1) {
    header('Location: index.php');
    exit();
  }
}

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
  case 'qltaikhoan':
    include './admin/qltaikhoan.php';
    break;
  case 'qlgiohang':
    include './admin/qlgiohang.php';
    break;
  case 'danhmuc':
    include './admin/danhmuc.php';
    break;
  case 'qlmau':
    include './admin/qlmau.php';
    break;
  case 'qlsize':
    include './admin/qlsize.php';
    break;
  case 'themsanpham':
    
    include './admin/themsanpham.php';
    break;
  case 'xoasanpham':
    // checkUser();
    include './functions/xoasanpham.php';
    break;
  case 'xacnhan-muahang':
    include './pages/order_confirm.php';
    break;
  case 'dathang-thanhcong':
    include './pages/order_success.php';
    break;
  case 'suasanpham':
    // checkUser();
    include './admin/suasanpham.php';
    break;
  case 'chitiet':
    include './admin/chitiet.php';
    break;
  case 'history':
    include './pages/history.php';
    break;
  default:
    include './pages/404.php';
    break;
}