<?php
$product = new Product();
$lstProduct = $product->getProductsByKeyAndCata() ?? [];

if (isset($_POST['deleteProduct'])) {
    $product_id = $_POST['product_id'];
    $product->deleteProduct($product_id);
    header('location: index.php?page=qlsanpham');
}
// echo "<pre>";
// print_r($lstProduct);
// echo "</pre>";
// exit;
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Trị</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="flex ">
        <!-- Sidebar -->
        <?php include './views/navAdmin.php'; ?>
        <!-- Nội dung chính -->
        <div class="flex-1 p-4">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold">Danh Sách Sản Phẩm</h2>
                    <a href="index.php?page=themsanpham" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-700">Thêm Sản Phẩm</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-200 text-gray-700 text-sm">
                            <tr>
                                <th class="py-2 px-3 uppercase font-semibold text-left">ID</th>
                                <th class="py-2 px-3 uppercase font-semibold text-left">Tên sản phẩm</th>
                                <th class="py-2 px-3 uppercase font-semibold text-left">Hình ảnh</th>
                                <th class="py-2 px-3 uppercase font-semibold text-left">Danh mục</th>
                                <th class="py-2 px-3 uppercase font-semibold text-left">Kích thước</th>
                                <th class="py-2 px-3 uppercase font-semibold text-left">Màu sắc</th>
                                <th class="py-2 px-3 uppercase font-semibold text-left">Giá</th>
                                <th class="py-2 px-3 uppercase font-semibold text-left">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm">

                            <!-- Lặp lại cho các sản phẩm khác -->
                            <?php foreach ($lstProduct as $product) { ?>
                                <tr>
                                    <td class="py-2 px-3 border"><?php echo $product['product_id']; ?></td>
                                    <td class="py-2 px-3 border"><?php echo $product['product_name']; ?></td>
                                    <td class="py-2 px-3 border">
                                        <div class='w-full h-full flex justify-center items-center'>
                                            <img src="<?php echo $product['images'][0]['url_image'] ?? ''; ?>" class="w-16 h-16 object-scale-down">
                                        </div>
                                    </td>
                                    <td class="py-2 px-3 border"><?php echo $product['catagory']['name']; ?></td>
                                    <td class="py-2 px-3 border">
                                        <!-- Hiển thị kích thước dưới dạng badge -->
                                        <div class="flex flex-wrap gap-1">
                                            <?php foreach ($product['sizes'] as $size) { ?>
                                                <span class="bg-gray-200  p-2  mr-1"><?php echo $size['size_code']; ?></span>
                                            <?php } ?>
                                        </div>
                                    </td>
                                    <td class="py-2 px-3 border">
                                        <!-- Hiển thị màu sắc dưới dạng màu nền -->
                                        <div class="flex flex-wrap gap-1">
                                            <?php foreach ($product['colors'] as $color) { ?>
                                                <span class="inline-block
                                                    bg-<?php echo $color['color_code']; ?>
                                                    p-2 mr-1 text-white
                                                ">
                                                    <?php echo $color['color_name']; ?>
                                                </span>
                                            <?php } ?>
                                        </div>
                                    </td>
                                    <td class="py-2 px-3 border"><?php echo number_format($product['price']); ?>đ</td>
                                    <td class="py-2 px-3 border">
                                        <a href="index.php?page=suasanpham&id=<?php echo $product['product_id']; ?>" class="bg-blue-500 text-white px-2 py-1 rounded-sm hover:bg-blue-700">Sửa</a>
                                        <form action="" method="POST">
                                            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                            <button type="submit" name="deleteProduct" value='1' class="bg-red-500 text-white px-2 py-1 rounded-sm hover:bg-red-700">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                            <!-- Thêm các hàng sản phẩm khác ở đây -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>