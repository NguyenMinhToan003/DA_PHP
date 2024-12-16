<?php
$product = new Product();
$lstProduct = $product->getProductsByKeyAndCata() ?? [];

// echo '<pre>';
// print_r($lstProduct);
// echo '</pre>';
if (isset($_POST['deleteProduct'])) {
    $product_id = $_POST['product_id'];
    $product->deleteProduct($product_id);
    header('location: index.php?page=qlsanpham');
}
?>

<!DOCTYPE html>
<html lang='vi'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Trang Quản Trị</title>
    <link href='https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css' rel='stylesheet'>
</head>

<body class='bg-gray-100 font-sans'>

    <div class='flex'>
        <!-- Sidebar -->
        <?php include './views/navAdmin.php'; ?>
        <!-- Nội dung chính -->
        <div class='flex-1 p-6'>
            <div class='bg-white p-6 rounded-lg shadow-lg'>
                <div class='flex justify-between items-center mb-6'>
                    <h2 class='text-2xl font-semibold text-gray-800'>Danh Sách Sản Phẩm</h2>
                    <a href='index.php?page=themsanpham' class='bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-700 transition duration-200'>Thêm Sản Phẩm</a>
                </div>

                <div class='overflow-x-auto'>
                    <table class='min-w-full bg-white border border-gray-200'>
                        <thead class='bg-gray-200 text-gray-700 text-sm'>
                            <tr>
                                <th class='py-3 px-4 text-left font-semibold'>ID</th>
                                <th class='py-3 px-4 text-left font-semibold'>Tên sản phẩm</th>
                                <th class='py-3 px-4 text-left font-semibold'>Hình ảnh</th>
                                <th class='py-3 px-4 text-left font-semibold'>Danh mục</th>
                                <th class='py-3 px-4 text-left font-semibold'>Kích thước</th>
                                <th class='py-3 px-4 text-left font-semibold'>Màu sắc</th>
                                <th class='py-3 px-4 text-left font-semibold'>Số lượng</th>
                                <th class='py-3 px-4 text-left font-semibold'>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class='text-gray-700 text-sm'>
                            <?php foreach ($lstProduct as $product) { ?>
                                <tr class='border-b hover:bg-gray-50'>
                                    <td class='py-3 px-4'><?php echo $product['product_id']; ?></td>
                                    <td class='py-3 px-4'><?php echo $product['product_name']; ?></td>
                                    <td class='py-3 px-4'>
                                        <div class='w-16 h-16 flex justify-center items-center'>
                                            <img src='<?php echo $product['images'][0]['url_image'] ?? ''; ?>' class='w-16 h-16 object-contain'>
                                        </div>
                                    </td>
                                    <td class='py-3 px-4'><?php echo $product['catagory']['name']; ?></td>
                                    <td class='py-3 px-4'>
                                        <div class='flex flex-wrap gap-2'>
                                            <?php foreach ($product['sizes'] as $size) { ?>
                                                <span class='bg-gray-200 text-gray-700 px-3 py-1 shadow-sm rounded-md text-xs'><?php echo $size['size_code']; ?></span>
                                            <?php } ?>
                                        </div>
                                    </td>
                                    <td class='py-3 px-4'>
                                        <div class='flex flex-wrap gap-2'>
                                            <?php foreach ($product['colors'] as $color) { ?>
                                                <span class='inline-block border border-gray-200 bg-<?php echo $color['color_code']; ?> text-<?php if ($color['color_code'] === 'white') echo 'black';
                                                                                                                                                else echo 'white'; ?> px-3 py-1 rounded-md text-xs'>
                                                    <?php echo $color['color_name']; ?>
                                                </span>
                                            <?php } ?>
                                        </div>
                                    </td>
                                    <td class='py-3 px-4'><?php echo $product['quatity']; ?></td>
                                    <td class='py-3 px-4'>
                                        <div class='flex gap-3'>
                                            <a href='index.php?page=suasanpham&id=<?php echo $product['product_id']; ?>' class='bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-200 h-fit'>Sửa</a>
                                            <form method='POST'>
                                                <input type='hidden' name='product_id' value='<?php echo $product['product_id']; ?>'>
                                                <button type='submit' name='deleteProduct' value='1' class='bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-700 transition duration-200'>Xóa</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>