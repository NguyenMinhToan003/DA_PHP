<?php
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $register = isset($_POST['register']) ? $_POST['register'] : 0;

  if ($register == '1') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);
    $tel = trim($_POST['tel']);
    $user = new User();

    if (empty($username) || empty($password) || empty($email) || empty($address) || empty($tel)) {
      $message = "
      <div class='flex items-center p-3 bg-red-100 mb-2 rounded-md'>
        <svg class='w-5 h-5 text-red-500 mr-2' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='currentColor'>
          <path fill-rule='evenodd' d='M18 8A8 8 0 11. . .'></path>
        </svg>
        <p class='text-red-900 text-sm'>Vui lòng nhập đầy đủ thông tin.</p>
      </div>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $message = "
      <div class='flex items-center p-3 bg-red-100 mb-2 rounded-md'>
        <p class='text-red-900 text-sm'>Email không hợp lệ.</p>
      </div>";
    } else {

      $checkEmail = $user->checkEmail($email);
      if ($checkUser || $checkEmail) {
        $message = "
        <div class='p-3 bg-red-100 mb-2'>
          <p class='text-red-900 text-center'>Tài khoản hoặc email đã tồn tại.</p>
        </div>";
      } else {
        $register = $user->register($username, $password, $email, $address, $tel);
        if ($register) {
          header('location:/index.php?page=dangnhap');
          exit();
        } else {
          $message = "
          <div class='p-3 bg-red-100 mb-2'>
            <p class='text-red-900 text-center'>Đăng kí tài khoản thất bại.</p>
          </div>";
        }
      }
    }
  }
}
?>

<div class='min-h-screen bg-gradient-to-br from-blue-50 via-blue-100 to-blue-500 flex items-center justify-center'>
  <form method='POST' class='w-full max-w-md p-8 bg-white rounded-lg shadow-lg'>
    <input type='hidden' name='page' value='dangky' />
    <input type='hidden' name='register' value='1' />
    <h5 class='text-center text-3xl font-bold text-gray-700 mb-6'>Đăng ký tài khoản</h5>

    <?php echo $message; ?>

    <div class="mb-4">
      <label for="email" class="block text-gray-700 font-semibold mb-1">Email:</label>
      <input placeholder="Nhập email của bạn" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" type='text' id="email" name='email' />
    </div>

    <div class="mb-4">
      <label for="username" class="block text-gray-700 font-semibold mb-1">Username:</label>
      <input placeholder="Chọn tên người dùng" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" type='text' id="username" name='username' />
    </div>

    <div class="mb-4">
      <label for="password" class="block text-gray-700 font-semibold mb-1">Password:</label>
      <input placeholder="Nhập mật khẩu" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" type='password' id="password" name='password' />
    </div>

    <div class="mb-4">
      <label for="address" class="block text-gray-700 font-semibold mb-1">Địa chỉ:</label>
      <input placeholder="Nhập địa chỉ của bạn" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" type='text' id="address" name='address' />
    </div>

    <div class="mb-4">
      <label for="tel" class="block text-gray-700 font-semibold mb-1">Số điện thoại:</label>
      <input placeholder="Nhập số điện thoại của bạn" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" type='text' id="tel" name='tel' />
    </div>

    <button type='submit' class='w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition duration-300'>
      Đăng ký tài khoản
    </button>

    <p class="text-center text-gray-600 text-sm mt-4">
      Đã có tài khoản?
      <a href='index.php?page=dangnhap' class='text-blue-600 hover:underline'>Đăng nhập</a>
    </p>
  </form>
</div>