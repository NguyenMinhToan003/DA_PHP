<?php

$lstProduct = new Product();
$lstProduct = $lstProduct->random4();
include './views/nav.php';
session_start();
$carts = $_SESSION['cart'] ?? [];
$tongtien = 0;

?>
<div class='w-[1200px] mx-auto mt-20 shadow-lg rounded-lg  border border-gray-200 overflow-x-auto'>
  <table class='table-auto w-full'>
    <thead class='bg-gray-800 text-white '>
      <tr>
        <th class='px-5 py-4 text-left'>Hình ảnh</th>
        <th class='px-5 py-4 text-left'>Tên sản phẩm</th>
        <th class='px-5 py-4 text-left'>Giá sản phẩm</th>
        <th class='px-5 py-4 text-left'>Số lượng</th>
        <th class='px-5 py-4 text-left'>Thành tiền</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($carts as $product) {
        $tongtien += $product['total'];
      ?>
        <tr class='border-b hover:bg-gray-100'>
          <td class='px-5 py-5 text-center'>
            <a href='../index.php?page=sanpham&id=<?php echo $product['product_id'] ?>'>
              <img src='<?php echo $product['url_image'] ?>' class='w-24 h-24 object-scale-down rounded-md border border-gray-300' />
            </a>
          </td>
          <td class='px-5 py-5'>
            <p class='text-[16px] font-bold text-gray-700'><?php echo $product['name'] ?></p>
          </td>
          <td class='px-5 py-5'>
            <p class='text-red-600 font-semibold'><?php echo number_format($product['price']) ?>đ</p>
          </td>
          <td class='px-5 py-5'>
            <input type='number' class='w-20 h-10 p-3 border border-gray-300 rounded-md' value='<?php echo $product['quatity'] ?>' />
          </td>
          <td class='px-5 py-5'>
            <p class='text-red-600 font-semibold'><?php echo number_format($product['total']) ?>đ</p>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

  <div class='flex justify-end items-center gap-5 p-5'>
    <p class='text-[16px] font-bold'>Tổng tiền: <?php echo number_format($tongtien) ?> đ</p>
    <button class='btn bg-red-600 text-white p-3 rounded-md'>Thanh toán</button>
  </div>
</div>