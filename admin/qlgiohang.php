<?php

$order = new Order();

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
    <div class='flex '>
        <!-- Sidebar -->
        <?php include './views/navAdmin.php'; ?>
        <!-- Nội dung chính -->
        <div class='flex-1 p-4'>
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
                                <td class="px-4 py-2 border border-gray-200"><?php if($order['status'] == 1){
                                    echo "Chưa duyệt";
                                }else{
                                    echo "Đã duyệt";
                                } ?></td>
                                <td class="px-4 py-2 border border-gray-200">

                                    <a href="index.php?page=chitiet&order_id=<?php echo $order['order_id']; ?>"
                                        class="text-blue-600 hover:underline">Chi tiết</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="7" class="px-4 py-2 text-center">Không có đơn hàng nào.</td>
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