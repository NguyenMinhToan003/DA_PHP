<?php
function uploadImage($file, $uploadDir = './uploads/')
{
  $uploadedFiles = [];
  foreach ($file['name'] as $key => $name) {
    if ($file['error'][$key] === UPLOAD_ERR_OK) {
      if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
      }

      $fileTmpPath = $file['tmp_name'][$key];
      $fileExtension = strtolower(pathinfo($name, PATHINFO_EXTENSION));

      // Tạo tên file mới duy nhất
      $newFileName = md5(time() . $name) . '.' . $fileExtension;

      // Kiểm tra định dạng file
      $allowedfileExtensions = ['jpg', 'gif', 'png', 'jpeg'];
      if (in_array($fileExtension, $allowedfileExtensions)) {
        $destPath = $uploadDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $destPath)) {
          $uploadedFiles[] = $newFileName;
        } else {
          return 'Tải ảnh lên thất bại.';
        }
      } else {
        return 'Tải ảnh bị lỗi' . implode(',', $allowedfileExtensions);
      }
    }
  }

  return $uploadedFiles;
}


$productObj = new Product();

$productId = $_GET['id'] ?? 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $product_name = trim($_POST['product_name']);
  $product_description = trim($_POST['product_description']);
  $catagory_id = $_POST['catagory_id'];
  $sizes = isset($_POST['sizes']) ? $_POST['sizes'] : [];
  $colors = isset($_POST['colors']) ? $_POST['colors'] : [];
  $quantities = isset($_POST['quantities']) ? $_POST['quantities'] : [];
  $product_detail_id = isset($_POST['product_detail_id']) ? $_POST['product_detail_id'] : [];
  $prices = isset($_POST['prices']) ? $_POST['prices'] : [];
  $remove_product_detail_id = isset($_POST['remove_product_detail_id']) ? $_POST['remove_product_detail_id'] : [];

  $add_sizes = isset($_POST['add_sizes']) ? $_POST['add_sizes'] : [];
  $add_colors = isset($_POST['add_colors']) ? $_POST['add_colors'] : [];
  $add_quantities = isset($_POST['add_quantities']) ? $_POST['add_quantities'] : [];
  $add_prices = isset($_POST['add_prices']) ? $_POST['add_prices'] : [];


  // upload hinh anh len server
  if (isset($_FILES['image_url'])) {
    if (count($_FILES['image_url']['name']) > 5) {
      echo '
        <script>
          alert("Chỉ được phép tải lên tối đa 5 hình ảnh.");
          window.history.back();
      </script>';
      ';';
      exit();
    }
    $uploadResult = uploadImage($_FILES['image_url']);
    if (is_array($uploadResult)) {
      $uploadedFileNames = $uploadResult;
    }
  }
  if (!empty($uploadedFileNames)) {
    $allimage = $productObj->getImages($productId);
    foreach ($allimage as $image) {
      unlink($image['url_image']);
    }
    $productObj->deleteProductImage($productId);
    foreach ($uploadedFileNames as $uploadedFileName) {
      $productObj->addProductImage($productId, $uploadedFileName);
    }
  }
  // cap nhat san pham
  $productObj->updateProduct($productId, $product_name, $product_description, $catagory_id);

  // cap nhat chi tiet san pham
  foreach ($product_detail_id as $index => $product_detail_id) {
    $size_id = $sizes[$index];
    $color_id = $colors[$index];
    $quantity = $quantities[$index];
    $price = $prices[$index];
    $productObj->updateProductDetail($product_detail_id, $color_id, $size_id, $quantity, $price);
  }
  foreach ($remove_product_detail_id as $product_detail_id) {
    $productObj->deleteProductDetail($product_detail_id);
  }
  foreach ($add_sizes as $index => $size_id) {
    $color_id = $add_colors[$index];
    $quantity = $add_quantities[$index];
    $price = $add_prices[$index];
    $check_product_detail = $productObj->getProductDetailByIdColorIdSizeId($productId,$color_id,$size_id)['product_detail_id']??-1;
    // echo '<pre>';
    // print_r($check_product_detail);
    // echo $check_product_detail;
    // exit;
    if($check_product_detail==-1){
      $productObj->addProductDetail($productId, $color_id, $size_id, $quantity, $price);
    }
    
  }
  // header('Location: index.php?page=qlsanpham');
  // exit();
}
$product = $productObj->getProductById($productId);

$catagory = new Catagory();
$lstCatagory = $catagory->all();
$allSizes = $productObj->getAllSizes();
$allColors = $productObj->getAllColors();
$lstProductDetail = $productObj->getListProductDetailByProductId($productId);
if (!$product) {
  header('Location: index.php?page=qlsanpham');
  exit();
}
?>






<!DOCTYPE html>
<html lang='vi'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Thêm Sản Phẩm</title>
    <link href='https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css' rel='stylesheet'>

</head>
<script>
function addProductDetailRow() {
    const container = document.getElementById('optionsContainer');
    const row = document.createElement('div');
    row.className = 'flex space-x-2 mb-4';
    row.innerHTML = `
        <div class='w-1/4'>
          <label for='colorSelect' class='block text-sm font-medium text-gray-700'>Chọn màu sắc</label>
          <select id='colorSelect' name='add_colors[]' class='w-full p-3 border border-gray-300 rounded-md' required>
            <option value=''>Chọn màu sắc</option>
            <?php foreach ($allColors as $color) { ?>
              <option value='<?php echo $color['color_id']; ?>'><?php echo $color['color_name']; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class='w-1/4'>
          <label for='sizeSelect' class='block text-sm font-medium text-gray-700'>Chọn kích thước</label>
          <select id='sizeSelect' name='add_sizes[]' class='w-full p-3 border border-gray-300 rounded-md' required>
            <option value=''>Chọn kích thước</option>
            <?php foreach ($allSizes as $size) { ?>
              <option value='<?php echo $size['size_id']; ?>'><?php echo $size['size_code']; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class='w-1/4'>
          <label for='quantities' class='block text-sm font-medium text-gray-700'>Số lượng</label>
          <input type='number' id='quantities' name='add_quantities[]' class='w-full p-3 border border-gray-300 rounded-md' min='1' required>
        </div>
        <div class='w-1/4'>
          <label for='price' class='block text-sm font-medium text-gray-700'>Giá sản phẩm</label>
          <input type='number' id='price' name='add_prices[]' class='w-full p-3 border border-gray-300 rounded-md' required>
        </div>`;
    container.appendChild(row);
}

function removeProductDetailRow() {
    const container = document.getElementById('optionsContainer');
    const rows = container.querySelectorAll('.flex');


    if (rows.length > 1) {
        const value = rows[rows.length - 1].querySelector('input').value;
        const input = document.createElement('div');
        input.innerHTML = `
      <input type='hidden' name='remove_product_detail_id[]' value='${value}' />
    `;
        container.appendChild(input);
        container.removeChild(rows[rows.length - 1]);
    }
}
</script>

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
                        <input type='text' id='product_name' name='product_name'
                            value='<?php echo $product['product_name']; ?>'
                            class='w-full p-3 border border-gray-300 rounded-md' required>
                    </div>

                    <div class='mb-4'>
                        <label for='product_description' class='block text-sm font-medium text-gray-700'>Mô tả sản
                            phẩm</label>
                        <textarea id='product_description' name='product_description'
                            class='w-full p-3 border border-gray-300 rounded-md' required>
              <?php echo $product['product_description']; ?>
            </textarea>
                    </div>

                    <div class='mb-4'>
                        <label for='catagory_id' class='block text-sm font-medium text-gray-700'>Danh mục</label>
                        <select name='catagory_id' id='catagory_id' class='w-full p-3 border border-gray-300 rounded-md'
                            required>
                            <option value=''>Chọn danh mục</option>
                            <?php foreach ($lstCatagory as $catagory) { ?>
                            <option
                                <?php echo $product['catagory']['catagory_id'] === $catagory['catagory_id'] ? 'selected' : ''; ?>
                                value='<?php echo $catagory['catagory_id']; ?>'><?php echo $catagory['name']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div id='optionsContainer'>
                        <?php
            foreach ($lstProductDetail as $productDetail) {
            ?>
                        <div class='flex space-x-2 mb-4'>
                            <input type='hidden' name='product_detail_id[]'
                                value='<?php echo $productDetail['product_detail_id']; ?>' />
                            <div class='w-1/5'>
                                <label for='colorSelect' class='block text-sm font-medium text-gray-700'>Chọn màu
                                    sắc</label>
                                <select id='colorSelect' name='colors[]'
                                    class='w-full p-3 border border-gray-300 rounded-md' required>
                                    <option value=''>Chọn màu sắc</option>
                                    <?php foreach ($allColors as $color) { ?>
                                    <option
                                        <?php echo $productDetail['color_id'] === $color['color_id'] ? 'selected' : ''; ?>
                                        value='<?php echo $color['color_id']; ?>'><?php echo $color['color_name']; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class='w-1/5'>
                                <label for='sizeSelect' class='block text-sm font-medium text-gray-700'>Chọn kích
                                    thước</label>
                                <select id='sizeSelect' name='sizes[]'
                                    class='w-full p-3 border border-gray-300 rounded-md' required>
                                    <option value=''>Chọn kích thước</option>
                                    <?php foreach ($allSizes as $size) { ?>
                                    <option
                                        <?php echo $productDetail['size_id'] == $size['size_id'] ? 'selected' : ''; ?>
                                        value='<?php echo $size['size_id']; ?>'><?php echo $size['size_code']; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class='w-1/5'>
                                <label for='quantities' class='block text-sm font-medium text-gray-700'>Số lượng</label>
                                <input type='number' id='quantities' name='quantities[]'
                                    class='w-full p-3 border border-gray-300 rounded-md' min='1'
                                    value='<?php echo $productDetail['quantity']; ?>' required>
                            </div>
                            <div class='w-1/5'>
                                <label for='price' class='block text-sm font-medium text-gray-700'>Giá sản phẩm</label>
                                <input type='number' id='price' name='prices[]'
                                    value='<?php echo $productDetail['price']; ?>'
                                    class='w-full p-3 border border-gray-300 rounded-md' required>
                            </div>
                            <div class="w-1/5 flex justify-center items-center">
                                <label for="remove_product_detail_<?php echo $productDetail['product_detail_id'] ?>"
                                    class="block text-sm font-medium text-gray-700">Xóa</label>
                                <input type="checkbox"
                                    id="remove_product_detail_<?php echo $productDetail['product_detail_id'] ?>"
                                    value="<?php echo $productDetail['product_detail_id']; ?>"
                                    name="remove_product_detail_id[]" class="w-4 h-4">
                            </div>
                        </div>
                        <?php
            }
            ?>
                    </div>

                    <div class='flex justify-end mb-4'>
                        <button type='button' onclick='removeProductDetailRow()'
                            class='bg-red-500 text-white px-6 py-2 rounded-md hover:bg-red-700 mr-4'>Xóa mẫu sản
                            phẩm</button>
                        <button type='button' onclick='addProductDetailRow()'
                            class='bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-700'>Thêm mẫu sản
                            phẩm</button>
                    </div>

                    <div class='mb-4 flex flex-wrap gap-3'>
                        <?php
            foreach ($product['images'] as $image) {
              echo "<img src='{$image['url_image']}' class='w-36 h-36 object-scale-down rounded-md border' alt='Sản phẩm' />";
            }
            ?>
                    </div>
                    <div class='mb-4'>
                        <label for='image_url' class='block text-sm font-medium text-gray-700'>Upload hình ảnh
                            mới</label>
                        <input multiple type='file' id='image_url' name='image_url[]'
                            class='w-full p-3 border border-gray-300 rounded-md'>
                    </div>

                    <div class='flex justify-between items-center'>
                        <a href='index.php?page=qlsanpham'
                            class='bg-red-500 text-white px-6 py-2 rounded-md hover:bg-red-700 mr-4'>Quay lại</a>
                        <button type='submit'
                            class='bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-700'>Chỉnh sửa sản
                            phẩm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>