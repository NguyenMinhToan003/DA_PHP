<?php

// Gọi lớp xử lý đơn hàng
$orderObj = new Order();

if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    die("Lỗi: Không tìm thấy thông tin người dùng trong session.");
}

$user_id = $_SESSION['user_id'];
$user = $_SESSION['user'];
$carts = $_SESSION['cart'] ?? [];
$tong_tam = 0;

if (empty($carts)) {
    header('Location: index.php');
    exit;
}

if (isset($_POST['confirm-order'])) {
    $username = $_POST['name'];
    $street_address = $_POST['address'];
    $phone_number = $_POST['tel'];
    $email_address = $_POST['email'];
    $note = $_POST['note'];

    // Tính tổng giá trị đơn hàng
    $total = 0;
    foreach ($carts as $product) {
        $total += $product['price'] * $product['quatity'];
    }

    try {
        // Thêm đơn hàng mới và nhận lại order_id
        $order = $orderObj->addOrder(
            $user_id['user_id'],            // user_id từ session
            $email_address,
            $username,
            $street_address,
            $phone_number,
            $note,
            $total
        );

        if (!$order) {
            die("Lỗi: Không thể tạo đơn hàng.");
        }

        // Đảm bảo order_id hợp lệ trước khi thêm chi tiết đơn hàng
        if ($order) {
            // Thêm chi tiết đơn hàng vào bảng order_detail
            foreach ($carts as $product) {
                $product_detail_id = $product['product_detail_id'];
                $quantity = $product['quatity'];
                $product_name = $product['name'];
                $item_total = $product['price'] * $quantity;

                // Thêm chi tiết đơn hàng vào bảng order_detail
                $orderObj->addOrderDetail(
                    $order,           // Truyền order_id hợp lệ
                    $product_detail_id,
                    $quantity,
                    $product_name,
                    $item_total
                );
            }
        }

        // Xóa giỏ hàng sau khi đặt hàng thành công
        unset($_SESSION['cart']);

        // Chuyển hướng đến trang thanh toán thành công
        header('Location: index.php?page=dathang-thanhcong');
        exit;

    } catch (Exception $e) {
        // Xử lý lỗi nếu có
        echo "<script>alert('Đã xảy ra lỗiiii: " . $e->getMessage() . "');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Thanh Toán</title>
</head>

<body class="bg-gradient-to-r from-blue-50 via-blue-100 to-blue-200 min-h-screen flex items-center justify-center p-4">
    <form method='POST' class="w-full max-w-[1200px] bg-white p-8 rounded-lg shadow-lg">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Thông Tin Thanh Toán -->
            <div>
                <h2 class="text-3xl font-bold text-blue-700 mb-6">Thông Tin Thanh Toán</h2>
                <div class="mb-4">
                    <label for="username" class="block font-medium mb-1 text-gray-700">Họ và Tên*</label>
                    <input type="text" id="username" name="name" required value="<?php echo $user['username']?>"
                        class="w-full border rounded px-4 py-2 focus:ring focus:ring-blue-300">
                </div>
                <div class="mb-4">
                    <label for="street_address" class="block font-medium mb-1 text-gray-700">Địa Chỉ*</label>
                    <input type="text" id="street_address" name="address" required value="<?php echo $user['address']?>"
                        class="w-full border rounded px-4 py-2 focus:ring focus:ring-blue-300">
                </div>

                <div class="mb-4">
                    <label for="phone_number" class="block font-medium mb-1 text-gray-700">Số Điện Thoại*</label>
                    <input type="tel" id="phone_number" name="tel" required
                        class="w-full border rounded px-4 py-2 focus:ring focus:ring-blue-300">
                </div>
                <div class="mb-4">
                    <label for="email_address" class="block font-medium mb-1 text-gray-700">Địa Chỉ Email*</label>
                    <input type="email" id="email_address" name="email" required value="<?php echo $user['email']?>"
                        class="w-full border rounded px-4 py-2 focus:ring focus:ring-blue-300">
                </div>
                <div class="mb-4">
                    <label for="note" class="block font-medium mb-1 text-gray-700">Ghi chú</label>
                    <textarea type="text" id="note" name="note"
                        class="w-full border rounded px-4 py-2 focus:ring focus:ring-blue-300"></textarea>
                </div>
            </div>

            <!-- Tóm Tắt Đơn Hàng -->
            <div>
                <h2 class="text-3xl font-bold text-gray-700 mb-6">Đơn hàng của bạn</h2>
                <div class="bg-gray-50 p-4 rounded-md shadow">
                    <?php foreach ($carts as $product) :
                        $item_total = $product['price'] * $product['quatity'];
                        $tong_tam += $item_total;
                    ?>
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <p class="font-medium text-gray-800"><?php echo $product['name']; ?></p>
                            <p class="text-sm text-gray-600">x<?php echo $product['quatity']; ?> - Size:
                                <?php echo $product['size_name']; ?> - Màu: <?php echo $product['color_name']; ?></p>
                        </div>
                        <span class="text-gray-700"><?php echo number_format($item_total); ?> đ</span>
                    </div>
                    <?php endforeach; ?>
                    <div class="flex justify-between items-center font-medium text-gray-800 border-t pt-2">
                        <span>Tạm Tính</span>
                        <span><?php echo number_format($tong_tam); ?> đ</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span>Phí Vận Chuyển</span>
                        <span class="text-green-600">Miễn phí</span>
                    </div>
                    <div class="flex justify-between items-center font-bold text-gray-900 border-t pt-2">
                        <span>Tổng Cộng</span>
                        <span class="text-red-500"><?php echo number_format($tong_tam); ?> đ</span>
                    </div>
                </div>

                <!-- Nút Đặt Hàng -->
                <div class="mt-6 flex justify-between">
                    <!-- Nút Quay Lại -->
                    <a href="javascript:history.back()"
                        class="bg-gray-200 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-300">
                        Quay Lại
                    </a>

                    <!-- Nút Đặt Hàng -->
                    <button type="submit" name='confirm-order' value='1'
                        class="bg-gradient-to-r from-red-500 to-orange-500 text-white py-2 px-6 rounded-md hover:from-red-600 hover:to-orange-600">
                        Đặt Hàng
                    </button>
                </div>

            </div>
        </div>
    </form>
</body>

</html>