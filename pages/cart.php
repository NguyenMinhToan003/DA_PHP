<?php

$lstProduct = new Product();

$carts = $_SESSION['cart'] ?? [];
$cartsDetail = $carts;
// foreach ($carts as $k => $v) {
//   $pd = $lstProduct->getProductDetailById($v['product_detail_id']);
//   $cartsDetail[] = $pd;
// }
$tongtien = 0;
// echo '<pre>';
// print_r($carts);
// echo '</pre>';

include './views/nav.php';

if (count($cartsDetail) > 0) {
?>
  <div class=' container mx-auto mt-20 shadow-lg rounded-lg border border-gray-200 p-4'>
    <?php if (count($cartsDetail) > 0) { ?>
      <div class='overflow-x-auto'>
        <table class='table-auto w-full text-left'>
          <thead class='bg-gray-800 text-white'>
            <tr>
              <th class='px-5 py-4'>Hình ảnh</th>
              <th class='px-5 py-4'>Tên sản phẩm</th>
              <th class='px-5 py-4'>Giá sản phẩm</th>
              <th class='px-5 py-4'>Số lượng</th>
              <th class='px-5 py-4'>Thành tiền</th>
            </tr>
          </thead>
          <tbody class='divide-y'>
            <?php
            foreach ($cartsDetail as $k => $v) {
              $tongtien += $v['price'] * $carts[$k]['quatity'];
            ?>
              <tr class='hover:bg-gray-50'>
                <td class='px-5 py-4'>
                  <a href='../index.php?page=sanpham&id=<?php echo $v['product_id'] ?>'>
                    <img src='<?php echo $v['url_image'] ?>' class='w-16 h-16 object-scale-down rounded-md border' alt='Sản phẩm' />
                  </a>
                </td>
                <td class='px-5 py-4'>
                  <p class='font-semibold text-gray-700'><?php echo $v['name'] ?></p>
                  <p class='text-sm text-gray-500'>Màu: <?php echo $v['color_name'] ?></p>
                  <p class='text-sm text-gray-500'>Size: <?php echo $v['size_name'] ?></p>
                </td>
                <td class='px-5 py-4'>
                  <p class='text-red-600 font-bold'><?php echo number_format($v['price'] ?? 0) ?> đ</p>
                </td>
                <td class='px-5 py-4'>
                  <form method='POST' action='../functions/cart.php'>
                    <input type='hidden' name='updateCart' value='1'>
                    <input type='hidden' name='product_detail_id' value='<?php echo $v['product_detail_id'] ?>'>
                    <input type='number' name='quatity' value='<?php echo $carts[$k]['quatity'] ?>' min='1' class='w-16 border rounded-md p-1 text-center'>
                  </form>
                </td>
                <td class='px-5 py-4'>
                  <p class='text-red-600 font-bold'><?php echo number_format($v['price'] * $carts[$k]['quatity']) ?> đ</p>
                  <form method='POST' action='../functions/cart.php'>
                    <input type='hidden' name='product_detail_id' value='<?php echo $v['product_detail_id'] ?>'>
                    <input type='hidden' name='removeCart' value='1'>
                    <button type='submit' class='p-2 bg-gray-200 rounded hover:bg-gray-300'>
                      <img src='./images/trash.png' alt='Remove' class='w-4 h-4'>
                    </button>
                  </form>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

      <!-- Total Price Section -->
      <div class='flex flex-col sm:flex-row justify-between items-center gap-4 mt-6'>
        <p class='text-lg font-bold'>Tổng tiền: <span class='text-red-600'><?php echo number_format($tongtien) ?> đ</span></p>
        <a href='../index.php?page=xacnhan-muahang' class='bg-red-600 text-white py-2 px-4 rounded hover:bg-red-700'>Mua hàng</a>
      </div>
    <?php } else { ?>
      <!-- Empty Cart -->
      <div class='text-center py-10'>
        <p class='text-xl font-bold text-gray-700'>Giỏ hàng trống</p>
        <a href='../index.php' class='bg-blue-600 text-white py-2 px-4 rounded mt-4 inline-block hover:bg-blue-700'>Tiếp tục mua hàng</a>
      </div>
    <?php } ?>
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