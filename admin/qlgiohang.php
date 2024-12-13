<?php

// Khởi tạo đối tượng Order
$order = new Order();

// Kiểm tra nếu có yêu cầu cập nhật trạng thái đơn hàng
if (isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];  // Lấy giá trị trạng thái từ form

    // Cập nhật trạng thái đơn hàng
    $order->updateOrderStatus($order_id, $status);

    // Sau khi cập nhật, chuyển hướng lại trang để làm mới danh sách
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Lấy danh sách đơn hàng
$orders = $order->selectSQL('SELECT * FROM `order`', []);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <?php include './views/navAdmin.php'; ?>
        <!-- Nội dung chính -->
        <div class="flex-1 p-4">
            <div class="container mx-auto px-4 py-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Quản lý đơn hàng</h1>

                <!-- Danh sách đơn hàng -->
                <div class="overflow-x-auto bg-white rounded-lg shadow">
                    <table class="table-auto w-full text-left border-collapse border border-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 border border-gray-200">ID</th>
                                <th class="px-4 py-2 border border-gray-200">Khách hàng</th>
                                <th class="px-4 py-2 border border-gray-200">Địa chỉ</th>
                                <th class="px-4 py-2 border border-gray-200">Số điện thoại</th>
                                <th class="px-4 py-2 border border-gray-200">Email</th>
                                <th class="px-4 py-2 border border-gray-200">Ghi chú</th>
                                <th class="px-4 py-2 border border-gray-200">Tổng tiền</th>
                                <th class="px-4 py-2 border border-gray-200">Trạng thái</th>
                                <th class="px-4 py-2 border border-gray-200">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($orders): ?>
                            <?php foreach ($orders as $order): ?>
                            <tr>
                                <td class="px-4 py-2 border border-gray-200"><?php echo $order['order_id']; ?></td>
                                <td class="px-4 py-2 border border-gray-200"><?php echo $order['user_name']; ?></td>
                                <td class="px-4 py-2 border border-gray-200"><?php echo $order['user_address']; ?></td>
                                <td class="px-4 py-2 border border-gray-200"><?php echo $order['tel']; ?></td>
                                <td class="px-4 py-2 border border-gray-200"><?php echo $order['email']; ?></td>
                                <td class="px-4 py-2 border border-gray-200"><?php echo $order['note']; ?></td>
                                <td class="px-4 py-2 border border-gray-200">
                                    <?php echo number_format($order['total']); ?>₫</td>
                                <td class="px-4 py-2 border border-gray-200">
                                    <?php if($order['status'] == 1){
                                            echo "Chưa duyệt";
                                        } elseif($order['status'] == 2) {
                                            echo "Đã duyệt";
                                        }else{
                                            echo "Từ chối";
                                        } ?>
                                </td>
                                <td class="px-4 py-2 border border-gray-200">
                                    <div class="flex space-x-2">
                                        <!-- Chi tiết -->
                                        <form method="GET" action="index.php">
                                            <input type="hidden" name="page" value="chitiet" />
                                            <input type="hidden" name="order_id"
                                                value="<?php echo $order['order_id']; ?>" />
                                            <button type="submit"
                                                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Chi
                                                tiết</button>
                                        </form>
                                        <!-- Duyệt và Từ chối chỉ hiển thị nếu trạng thái là chưa duyệt -->
                                        <?php if ($order['status'] == 1): // Trạng thái "Chưa duyệt" ?>
                                        <!-- Duyệt -->
                                        <form method="POST" action="index.php?page=qlgiohang">
                                            <input type="hidden" name="order_id"
                                                value="<?php echo $order['order_id']; ?>" />
                                            <input type="hidden" name="status" value="2" /> <!-- Trạng thái "Duyệt" -->
                                            <button type="submit" name="update_status"
                                                class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Duyệt</button>
                                        </form>

                                        <!-- Từ chối -->
                                        <form method="POST" action="index.php?page=qlgiohang">
                                            <input type="hidden" name="order_id"
                                                value="<?php echo $order['order_id']; ?>" />
                                            <input type="hidden" name="status" value="3" />
                                            <!-- Trạng thái "Từ chối" -->
                                            <button type="submit" name="update_status"
                                                class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Từ
                                                chối</button>
                                        </form>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="8" class="px-4 py-2 text-center">Không có đơn hàng nào.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>