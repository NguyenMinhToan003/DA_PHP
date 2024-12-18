<?php
$carts = $_SESSION['cart'] ?? [];
$cartsDetail = $carts;
$tongtien = 0;


include './views/nav.php';

if (count($cartsDetail) > 0) {
?>
  <div class="container mx-auto mt-20 shadow-xl rounded-lg border border-gray-300 p-6 bg-white">
    <div class="overflow-x-auto">
      <table class="table-auto w-full text-left">
        <thead class="bg-gray-800 text-white">
          <tr>
            <th class="px-6 py-4">Hình ảnh</th>
            <th class="px-6 py-4">Tên sản phẩm</th>
            <th class="px-6 py-4">Giá sản phẩm</th>
            <th class="px-6 py-4">Số lượng</th>
            <th class="px-6 py-4">Thành tiền</th>
            <th class="px-6 py-4">Xoá</th>
          </tr>
        </thead>
        <tbody class="divide-y">
          <?php
          foreach ($cartsDetail as $k => $v) {
            $tongtien += $v['price'] * $carts[$k]['quatity'];
          ?>
            <tr class="hover:bg-gray-50 transition-all">
              <td class="px-6 py-4">
                <a href="../index.php?page=sanpham&id=<?php echo $v['product_id'] ?>">
                  <img src="<?php echo $v['url_image'] ?>" class="w-20 h-20 object-cover rounded-md border shadow-md" alt="Sản phẩm" />
                </a>
              </td>
              <td class="px-6 py-4">
                <p class="font-semibold text-gray-700"><?php echo $v['name'] ?></p>
                <p class="text-sm text-gray-500">Màu: <?php echo $v['color_name'] ?></p>
                <p class="text-sm text-gray-500">Size: <?php echo $v['size_name'] ?></p>
              </td>
              <td class="px-6 py-4">
                <p class="text-red-600 font-bold"><?php echo number_format($v['price'] ?? 0) ?> đ</p>
              </td>
              <td class="px-6 py-4">
                <form method="POST" action="../functions/cart.php" class="flex justify-center items-center">
                  <input type="hidden" name="updateCart" value="1">
                  <input type="hidden" name="product_detail_id" value="<?php echo $v['product_detail_id'] ?>">
                  <input type="number" name="quatity" value="<?php echo $carts[$k]['quatity'] ?>" min="1" class="w-16 border rounded-md p-2 text-center focus:ring-2 focus:ring-blue-500" />
                </form>
              </td>
              <td class="px-6 py-4">
                <p class="text-red-600 font-bold"><?php echo number_format($v['price'] * $carts[$k]['quatity']) ?> đ</p>
              </td>
              <td class="px-6 py-4">
                <form method="POST" action="../functions/cart.php" class="flex justify-center">
                  <input type="hidden" name="product_detail_id" value="<?php echo $v['product_detail_id'] ?>">
                  <input type="hidden" name="removeCart" value="1">
                  <button type="submit" class="p-2 bg-gray-200 rounded hover:bg-gray-300 transition-all">
                    <img src="./images/trash.png" alt="Remove" class="w-5 h-5" />
                  </button>
                </form>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

    <!-- Total Price Section -->
    <div class="flex flex-col sm:flex-row justify-between items-center gap-6 mt-6">
      <p class="text-lg font-bold">Tổng tiền: <span class="text-red-600"><?php echo number_format($tongtien) ?> đ</span></p>
      <a href="../index.php?page=xacnhan-muahang" class="bg-red-600 text-white py-3 px-6 rounded-md hover:bg-red-700 transition-all">
        Mua hàng
      </a>
    </div>
  </div>

<?php } else { ?>
  <!-- Empty Cart -->
  <div class="w-[1200px] mx-auto mt-20">
    <p class="text-[24px] font-bold text-center text-gray-700">Giỏ hàng trống</p>
    <a href="../index.php" class="bg-blue-600 text-white py-2 px-6 rounded-md block w-48 mx-auto mt-6 text-center hover:bg-blue-700 transition-all">
      Tiếp tục mua hàng
    </a>
  </div>
<?php } ?>