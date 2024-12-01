<?php

$lstProduct = new Product();
$lstProduct = $lstProduct->random4();
include './views/nav.php';
$carts = $_SESSION['cart'] ?? [];
$tongtien = 0;


if (count($carts) > 0) {
?>
  <form method='POST' action='../functions/cart.php' class='w-[1200px] mx-auto mt-20 shadow-lg rounded-lg  border border-gray-200 overflow-x-auto'>
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
          <tr class='border-b hover:bg-gray-100 relative'>
            <td class='px-5 py-5 text-center '>
              <a href='../index.php?page=sanpham&id=<?php echo $product['product_id'] ?>'>
                <img src='<?php echo $product['url_image'] ?>' class='w-24 h-24 object-scale-down rounded-md border border-gray-300' />
              </a>
            </td>
            <td class='px-5 py-5'>
              <p class='text-[16px] font-bold text-gray-700'><?php echo $product['name'] ?></p>
              <p class='text-[14px] text-gray-400'>Màu: <?php echo $product['color'] ?></p>
              <p class='text-[14px] text-gray-400'>Size: <?php echo $product['size'] ?></p>
            </td>
            <td class='px-5 py-5'>
              <p class='text-red-600 font-semibold'><?php echo number_format($product['price']) ?>đ</p>
            </td>
            <td class='px-5 py-5'>
              <input type='number' class='w-20 h-10 p-3 border border-gray-300 rounded-md' value='<?php echo $product['quatity'] ?>' />
            </td>
            <td class='px-5 py-5'>
              <div class='text-red-600 font-semibold'><?php echo number_format($product['total']) ?>đ</div>

              <input type='hidden' name='product_id' value='<?php echo $product['product_id'] ?>' />
              <input type='hidden' name='removeCart' value='1' />
              <button type='submit' class='absolute top-0 right-0 p-3 bg-slate-400'>
                <img src='./images/trash.png' class='w-5 h-5' />
              </button>
            </td>

          </tr>

        <?php } ?>
      </tbody>
    </table>

    <div class='flex justify-end items-center gap-5 p-5'>
      <?php
      if (count($carts) > 0) {
      ?>
        <p class='text-[16px] font-bold'>Tổng tiền: <?php echo number_format($tongtien) ?> đ</p>
        <a href='../index.php' class=' btn bg-red-600 text-white p-3 rounded-md'>Thanh toán</a>
      <?php }
      ?>
    </div>
  </form>
<?php } else {
?>
  <div class='w-[1200px] mx-auto mt-20'>
    <p class='text-[24px] font-bold text-center'>Giỏ hàng trống</p>
    <a href='../index.php' class='btn bg-primary text-white p-3 rounded-md block w-40 mx-auto mt-5'>Tiếp tục mua hàng</a>
  </div>
<?php

}
?>