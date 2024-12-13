<?php

$order = new Order();
$order_id = $_GET['order_id']; // Lấy ID đơn hàng từ URL

// Lấy thông tin đơn hàng và chi tiết đơn hàng
$order_data = $order->selectSQL('SELECT * FROM `order` WHERE order_id = ?', [$order_id])[0];
$order_details = $order->selectSQL('SELECT * FROM `order_detail` WHERE order_id = ?', [$order_id]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class='flex '>
        <!-- Sidebar -->
        <?php include './views/navAdmin.php'; ?>
        <!-- Nội dung chính -->
        <div class='flex-1 p-4'>
            <div class="container mx-auto px-4 py-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Chi tiết đơn hàng
                    <?php echo $order_data['order_id']; ?></h1>

                <!-- Thông tin đơn hàng -->
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <p><strong>Khách hàng:</strong> <?php echo $order_data['user_name']; ?></p>
                    <p><strong>Địa chỉ:</strong> <?php echo $order_data['user_address']; ?></p>
                    <p><strong>Số điện thoại:</strong> <?php echo $order_data['tel']; ?></p>
                    <p><strong>Email:</strong> <?php echo $order_data['email']; ?></p>
                    <p><strong>Tổng tiền:</strong> <?php echo number_format($order_data['total']); ?>₫</p>

                </div>

                <!-- Chi tiết các sản phẩm trong đơn hàng -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-semibold mb-4">Chi tiết sản phẩm</h2>
                    <table class="table-auto w-full text-left border-collapse border border-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 border border-gray-200">Sản phẩm</th>
                                <th class="px-4 py-2 border border-gray-200">Số lượng</th>
                                <th class="px-4 py-2 border border-gray-200">Giá</th>
                                <th class="px-4 py-2 border border-gray-200">Tổng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($order_details as $detail): ?>
                            <tr>
                                <td class="px-4 py-2 border border-gray-200"><?php echo $detail['product_name']; ?></td>
                                <td class="px-4 py-2 border border-gray-200"><?php echo $detail['quantity']; ?></td>
                                <td class="px-4 py-2 border border-gray-200">
                                    <?php echo number_format($detail['total_price']); ?>₫
                                </td>
                                <td class="px-4 py-2 border border-gray-200">
                                    <?php echo number_format($detail['quantity'] * $detail['total_price']); ?>₫</td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</body>

</html>