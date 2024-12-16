<?php
// Khởi tạo đối tượng Order
$order = new Order();

// Lấy user_id từ session
$user_id = $_SESSION['user_id'];

// Lấy danh sách đơn hàng của người dùng
$orders = $order->selectSQL('SELECT * FROM `order` WHERE user_id = ?', [$user_id['user_id']]);

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử đơn hàng</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800">
    <?php
    include './views/nav.php';
    ?>

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Lịch sử đơn hàng</h1>

        <?php if (empty($orders)) : ?>
            <p class="text-lg">Bạn chưa có đơn hàng nào.</p>
        <?php else : ?>
            <?php foreach ($orders as $order_item) : ?>
                <div class="bg-white rounded-lg shadow-md mb-6 p-4">
                    <!-- Tóm tắt đơn hàng -->
                    <div class="mb-4">
                        <span class="block text-lg font-semibold">ID Đơn Hàng: <span
                                class="text-blue-500">#<?php echo $order_item['order_id']; ?></span></span>
                        <span class="block">Tổng Tiền: <strong
                                class="text-green-600"><?php echo number_format($order_item['total'], 0, ',', '.'); ?>
                                đ</strong></span>
                        <span class="block">Trạng Thái:
                            <strong>
                                <?php
                                switch ($order_item['status']) {
                                    case 1:
                                        echo 'Chờ xử lý';
                                        break;
                                    case 2:
                                        echo 'Đã duyệt';
                                        break;
                                    case 3:
                                        echo 'Đã hủy';
                                        break;
                                    default:
                                        echo 'Không xác định';
                                }
                                ?>
                            </strong>
                        </span>
                    </div>

                    <!-- Chi tiết sản phẩm -->
                    <?php
                    $order_details = $order->getOrderDetail($order_item['order_id']);
                    if (!empty($order_details)) : ?>
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-200">
                                        <th class="border border-gray-300 px-4 py-2">Tên Sản Phẩm</th>
                                        <th class="border border-gray-300 px-4 py-2">Số Lượng</th>
                                        <th class="border border-gray-300 px-4 py-2">Đơn Giá</th>
                                        <th class="border border-gray-300 px-4 py-2">Thành Tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($order_details as $detail) : ?>
                                        <tr class="bg-white hover:bg-gray-100">
                                            <td class="border border-gray-300 px-4 py-2"><?php echo $detail['product_name']; ?></td>
                                            <td class="border border-gray-300 px-4 py-2 text-center"><?php echo $detail['quantity']; ?>
                                            </td>
                                            <td class="border border-gray-300 px-4 py-2 text-right">
                                                <?php echo number_format($detail['total_price'], 0, ',', '.'); ?> đ</td>
                                            <td class="border border-gray-300 px-4 py-2 text-right">
                                                <?php $tong = $detail['quantity'] * $detail['total_price'];
                                                echo number_format($tong, 0, ',', '.'); ?> đ</td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <a href="index.php"
            class="inline-block mt-4 px-6 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600">Quay lại
            trang chủ</a>
    </div>
</body>

</html>