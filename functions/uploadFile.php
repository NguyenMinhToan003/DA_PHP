<?
function uploadImage($file, $uploadDir = './uploads/')
{
  if ($file['error'] === UPLOAD_ERR_OK) {
    // Kiểm tra nếu thư mục tồn tại
    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0777, true); // Tạo thư mục nếu chưa tồn tại
    }

    $fileTmpPath = $file['tmp_name'];
    $fileName = $file['name'];
    $fileSize = $file['size'];
    $fileType = $file['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // Chọn một tên file duy nhất
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

    // Kiểm tra định dạng file
    $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
    if (in_array($fileExtension, $allowedfileExtensions)) {
      // Đường dẫn lưu file
      $destPath = $uploadDir . $newFileName;

      if (move_uploaded_file($fileTmpPath, $destPath)) {
        return $newFileName;
      } else {
        return 'Error moving the file to upload directory.';
      }
    } else {
      return 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
    }
  } else {
    return 'Error in the file upload. Error code: ' . $file['error'];
  }
}
