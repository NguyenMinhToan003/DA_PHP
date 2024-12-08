<!DOCTYPE html>
<html lang='vi'>

<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>Thêm Sản Phẩm</title>
  <link href='https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css' rel='stylesheet'>

</head>

<body class='bg-gray-100'>
  <div class='flex h-screen'>
    <!-- Sidebar -->
    <?php include './views/navAdmin.php'; ?>

    <!-- Nội dung chính -->
    <div class='flex-1 p-6 gap-2'>
      <div class='bg-white p-6 rounded-lg shadow-lg'>
        <h2 class='text-xl font-bold mb-4'>Chi tiết sản phẩm</h2>

        <form action='' method='POST' enctype='multipart/form-data'>
          <div class='mb-4'>
            <label for='product_name' class='block text-sm font-medium text-gray-700'>Tên sản phẩm</label>
            <input type='text' id='product_name' name='product_name' class='w-full p-3 border border-gray-300 rounded-md' required>
          </div>

          <div class='mb-4'>
            <label for='product_description' class='block text-sm font-medium text-gray-700'>Mô tả sản phẩm</label>
            <textarea id='product_description' name='product_description' class='w-full p-3 border border-gray-300 rounded-md' required></textarea>
          </div>

          <div class='mb-4'>
            <label for='catagory_id' class='block text-sm font-medium text-gray-700'>Danh mục</label>
            <select name='catagory_id' id='catagory_id' class='w-full p-3 border border-gray-300 rounded-md' required>
              <option value=''>Chọn danh mục</option>
              <?php foreach ($lstCatagory as $catagory) { ?>
                <option value='<?php echo $catagory['catagory_id']; ?>'><?php echo $catagory['name']; ?></option>
              <?php } ?>
            </select>
          </div>

          <div id='optionsContainer'>
            <div class='flex space-x-2 mb-4'>
              <div class='w-1/4'>
                <label for='colorSelect' class='block text-sm font-medium text-gray-700'>Chọn màu sắc</label>
                <select id='colorSelect' name='colors[]' class='w-full p-3 border border-gray-300 rounded-md' required>
                  <option value=''>Chọn màu sắc</option>
                  <?php foreach ($allColors as $color) { ?>
                    <option value='<?php echo $color['color_id']; ?>'><?php echo $color['color_name']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class='w-1/4'>
                <label for='sizeSelect' class='block text-sm font-medium text-gray-700'>Chọn kích thước</label>
                <select id='sizeSelect' name='sizes[]' class='w-full p-3 border border-gray-300 rounded-md' required>
                  <option value=''>Chọn kích thước</option>
                  <?php foreach ($allSizes as $size) { ?>
                    <option value='<?php echo $size['size_id']; ?>'><?php echo $size['size_code']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class='w-1/4'>
                <label for='quantities' class='block text-sm font-medium text-gray-700'>Số lượng</label>
                <input type='number' id='quantities' name='quantities[]' class='w-full p-3 border border-gray-300 rounded-md' min='1' required>
              </div>
              <div class='w-1/4'>
                <label for='price' class='block text-sm font-medium text-gray-700'>Giá sản phẩm</label>
                <input type='number' id='price' name='prices[]' class='w-full p-3 border border-gray-300 rounded-md' required>
              </div>
            </div>
          </div>

          <div class='flex justify-end mb-4'>
            <button type='button' onclick='addProductDetailRow()' class='bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-700'>Thêm mẫu sản phẩm</button>
          </div>

          <div class='mb-4'>
            <label for='image_url' class='block text-sm font-medium text-gray-700'>Upload hình ảnh</label>
            <input multiple type='file' id='image_url' name='image_url[]' class='w-full p-3 border border-gray-300 rounded-md' required>
          </div>

          <div class='flex justify-between items-center'>
            <a href='index.php?page=qlsanpham' class='bg-red-500 text-white px-6 py-2 rounded-md hover:bg-red-700 mr-4'>Hủy</a>
            <button type='submit' class='bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-700'>Chỉnh sửa sản phẩm</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>