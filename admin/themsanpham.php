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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Lấy dữ liệu từ form
  $product_name = trim($_POST['product_name']);
  $description = trim($_POST['product_description']);
  $catagory_id = $_POST['catagory_id'];
  $sizes = isset($_POST['sizes']) ? $_POST['sizes'] : [];
  $colors = isset($_POST['colors']) ? $_POST['colors'] : [];
  $quantities = isset($_POST['quantities']) ? $_POST['quantities'] : [];
  $prices = isset($_POST['prices']) ? $_POST['prices'] : [];

  // Xử lý file upload
  if (isset($_FILES['image_url'])) {
    if (count($_FILES['image_url']['name']) > 5) {
      echo '
        <script>
          alert("Chỉ được phép tải lên tối đa 5 hình ảnh.");
          window.history.back();
      </script>';
      exit();
    }
    $uploadResult = uploadImage($_FILES['image_url']);
    if (is_array($uploadResult)) {
      $uploadedFileNames = $uploadResult;
    }
  }

  if (!empty($sizes) && !empty($colors) && !empty($quantities) && !empty($prices) && !empty($uploadedFileNames)) {
    $productObj = new Product();

    $product_id = $productObj->addProduct($product_name, $description, $catagory_id);

    if (!empty($uploadedFileNames)) {
      foreach ($uploadedFileNames as $uploadedFileName) {
        $productObj->addProductImage($product_id, $uploadedFileName);
      }
    }

    foreach ($sizes as $index => $size_id) {
      $color_id = $colors[$index];
      $quantity = $quantities[$index];
      $price = $prices[$index];
      $productObj->addProductDetail($product_id, $color_id, $size_id, $quantity, $price);
    }

    header('Location: index.php?page=qlsanpham');
    exit();
  } else {
    echo 'Vui lòng chọn đầy đủ màu sắc, kích thước và số lượng.';
  }
}

$catagory = new Catagory();
$lstCatagory = $catagory->all();
$product = new Product();
$allSizes = $product->getAllSizes();
$allColors = $product->getAllColors();
?>

<!DOCTYPE html>
<html lang='vi'>

<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>Thêm Sản Phẩm</title>
  <script>
    function addProductDetailRow() {
      const container = document.getElementById('optionsContainer');
      const row = document.createElement('div');
      row.className = 'flex space-x-4 mb-6';
      row.innerHTML = `
        <div class='w-full sm:w-1/4'>
          <label for='colorSelect' class='block text-sm font-medium text-gray-700'>Chọn màu sắc</label>
          <select id='colorSelect' name='colors[]' class='w-full p-3 border border-gray-300 rounded-md' required>
            <option value=''>Chọn màu sắc</option>
            <?php foreach ($allColors as $color) { ?>
              <option value='<?php echo $color['color_id']; ?>'><?php echo $color['color_name']; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class='w-full sm:w-1/4'>
          <label for='sizeSelect' class='block text-sm font-medium text-gray-700'>Chọn kích thước</label>
          <select id='sizeSelect' name='sizes[]' class='w-full p-3 border border-gray-300 rounded-md' required>
            <option value=''>Chọn kích thước</option>
            <?php foreach ($allSizes as $size) { ?>
              <option value='<?php echo $size['size_id']; ?>'><?php echo $size['size_code']; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class='w-full sm:w-1/4'>
          <label for='quantities' class='block text-sm font-medium text-gray-700'>Số lượng</label>
          <input type='number' id='quantities' name='quantities[]' class='w-full p-3 border border-gray-300 rounded-md' min='1' required>
        </div>
        <div class='w-full sm:w-1/4'>
          <label for='price' class='block text-sm font-medium text-gray-700'>Giá sản phẩm</label>
          <input type='number' id='price' name='prices[]' class='w-full p-3 border border-gray-300 rounded-md' required>
        </div>`;
      container.appendChild(row);
    }

    function removeProductDetailRow() {
      const container = document.getElementById('optionsContainer');
      const rows = container.querySelectorAll('.flex');
      if (rows.length > 1) {
        container.removeChild(rows[rows.length - 1]);
      }
    }
  </script>
</head>

<body class='bg-gray-100'>
  <div class='flex h-screen'>
    <!-- Sidebar -->
    <?php include './views/navAdmin.php'; ?>

    <!-- Nội dung chính -->
    <div class='flex-1 p-6'>
      <div class='bg-white p-6 rounded-lg shadow-lg'>
        <h2 class='text-xl font-bold mb-6'>Thêm Sản Phẩm Mới</h2>

        <form action='' method='POST' enctype='multipart/form-data'>
          <div class='mb-6'>
            <label for='product_name' class='block text-sm font-medium text-gray-700'>Tên sản phẩm</label>
            <input type='text' id='product_name' name='product_name' class='w-full p-3 border border-gray-300 rounded-md' required>
          </div>

          <div class='mb-6'>
            <label for='product_description' class='block text-sm font-medium text-gray-700'>Mô tả sản phẩm</label>
            <textarea id='product_description' name='product_description' class='w-full p-3 border border-gray-300 rounded-md' required></textarea>
          </div>

          <div class='mb-6'>
            <label for='catagory_id' class='block text-sm font-medium text-gray-700'>Danh mục</label>
            <select name='catagory_id' id='catagory_id' class='w-full p-3 border border-gray-300 rounded-md' required>
              <option value=''>Chọn danh mục</option>
              <?php foreach ($lstCatagory as $catagory) { ?>
                <option value='<?php echo $catagory['catagory_id']; ?>'><?php echo $catagory['name']; ?></option>
              <?php } ?>
            </select>
          </div>

          <div id='optionsContainer'>
            <div class='flex space-x-4 mb-6'>
              <div class='w-full sm:w-1/4'>
                <label for='colorSelect' class='block text-sm font-medium text-gray-700'>Chọn màu sắc</label>
                <select id='colorSelect' name='colors[]' class='w-full p-3 border border-gray-300 rounded-md' required>
                  <option value=''>Chọn màu sắc</option>
                  <?php foreach ($allColors as $color) { ?>
                    <option value='<?php echo $color['color_id']; ?>'><?php echo $color['color_name']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class='w-full sm:w-1/4'>
                <label for='sizeSelect' class='block text-sm font-medium text-gray-700'>Chọn kích thước</label>
                <select id='sizeSelect' name='sizes[]' class='w-full p-3 border border-gray-300 rounded-md' required>
                  <option value=''>Chọn kích thước</option>
                  <?php foreach ($allSizes as $size) { ?>
                    <option value='<?php echo $size['size_id']; ?>'><?php echo $size['size_code']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class='w-full sm:w-1/4'>
                <label for='quantities' class='block text-sm font-medium text-gray-700'>Số lượng</label>
                <input type='number' id='quantities' name='quantities[]' class='w-full p-3 border border-gray-300 rounded-md' min='1' required>
              </div>
              <div class='w-full sm:w-1/4'>
                <label for='price' class='block text-sm font-medium text-gray-700'>Giá sản phẩm</label>
                <input type='number' id='price' name='prices[]' class='w-full p-3 border border-gray-300 rounded-md' required>
              </div>
            </div>
          </div>

          <div class='flex justify-between'>
            <button type='button' onclick='addProductDetailRow()' class='bg-blue-500 text-white py-2 px-4 rounded-lg'>
              Thêm Mẫu sản phẩm
            </button>
            <button type='button' onclick='removeProductDetailRow()' class='bg-red-500 text-white py-2 px-4 rounded-lg'>
              Xóa mẫu sản phẩm
            </button>

          </div>

          <div class='mb-6'>
            <label for='image_url' class='block text-sm font-medium text-gray-700'>Hình ảnh sản phẩm</label>
            <input type='file' id='image_url' name='image_url[]' class='w-full p-3 border border-gray-300 rounded-md' multiple>
          </div>

          <button type='submit' class='w-full bg-green-500 text-white py-3 rounded-md'>Lưu sản phẩm</button>
        </form>
      </div>
    </div>
  </div>
</body>

</html>