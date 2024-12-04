<?php

$lstProduct = new Product();

$carts = $_SESSION['cart'] ?? [];
$cartsDetail = [];
foreach ($carts as $k => $v) {

  $pd = $lstProduct->getProductDetailByIdColorIdSizeId($v['product_id'], $v['color'], $v['size']);
  $cartsDetail[] = $pd;
}
$tongtien = 0;
// echo '<pre>';
// print_r($carts);
// echo '</pre>';

include './views/nav.php';

if (count($cartsDetail) > 0) {
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
        <?php foreach ($cartsDetail as $k => $v) {
          $tongtien += $v['price'] * $carts[$k]['quatity'];
        ?>
          <tr class='border-b hover:bg-gray-100 relative'>
            <td class='px-5 py-5 text-center '>
              <a href='../index.php?page=sanpham&id=<?php echo $v['product_id'] ?>'>
                <img src='<?php echo $v['images'][0]['url_image'] ?>' class='w-24 h-24 object-scale-down rounded-md border border-gray-300' />
              </a>
            </td>
            <td class='px-5 py-5'>
              <p class='text-[16px] font-bold text-gray-700'><?php echo $v['name'] ?></p>
              <p class='text-[14px] text-gray-400'>Màu: <?php echo $v['color_name'] ?></p>
              <p class='text-[14px] text-gray-400'>Size: <?php echo $v['size_name'] ?></p>
            </td>
            <td class='px-5 py-5'>
              <p class='text-red-600 font-semibold'><?php echo number_format($v['price']) ?>đ</p>
            </td>
            <td class='px-5 py-5'>
              <form method='POST' action='../functions/cart.php'>
                <input type='hidden' name='updateCart' value='1' />
                <input type='hidden' name='color' value='<?php echo $v['color_id'] ?>' />
                <input type='hidden' name='size' value='<?php echo $v['size_id'] ?>' />
                <input type='hidden' name='product_id' value='<?php echo $v['product_id'] ?>' />
                <input type='number' class='w-20 h-10 p-3 border border-gray-300 rounded-md' value='<?php echo $carts[$k]['quatity'] ?>' name='quatity' />
              </form>
            </td>
            <td class='px-5 py-5'>
              <div class='text-red-600 font-semibold'><?php echo number_format($v['price'] * $carts[$k]['quatity']) ?>đ</div>
              <form method='POST' action='../functions/cart.php'>
                <input type='hidden' name='product_id' value='<?php echo $v['product_id'] ?>' />
                <input type='hidden' name='color' value='<?php echo $v['color_id'] ?>' />
                <input type='hidden' name='size' value='<?php echo $v['size_id'] ?>' />
                <input type='hidden' name='removeCart' value='1' />
                <button type='submit' class='absolute top-0 right-0 p-3 bg-slate-400'>
                  <img src='./images/trash.png' class='w-5 h-5' />
                </button>
              </form>
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
  </div>
<?php } else {
?>
  <div class='w-[1200px] mx-auto mt-20'>
    <p class='text-[24px] font-bold text-center'>Giỏ hàng trống</p>
    <a href='../index.php' class='btn bg-primary text-white p-3 rounded-md block w-40 mx-auto mt-5'>Tiếp tục mua hàng</a>
  </div>
<?php

}
?>