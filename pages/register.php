<?php
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $register = isset($_POST['register']) ? $_POST['register'] : 0;

  if ($register == '1') {
    $username = ($_POST['username']);
    $password = ($_POST['password']);
    $email = ($_POST['email']);
    $address = ($_POST['address']);
    $tel = ($_POST['tel']);
    $user = new User();
    if (empty($username) || empty($password) || empty($email) || empty($address)) {
      $message = "
      <div class='p-3 bg-red-100 mb-2'>
        <p class=' text-red-900 text-center'>Vui lòng nhập đầy đủ thông tin.</p>
      </div>
        ";
    } else {
      $checkUser = $user->checkUser($username);
      $checkEmail = $user->checkEmail($email);
      if ($checkUser || $checkEmail) {
        $message = "
      <div class='p-3 bg-red-100 mb-2'>
        <p class=' text-red-900 text-center'>Tài khoản hoặc email đã tồn tại.</p>
      </div>
        ";
      } else {
        $register = $user->register($username, $password, $email, $address, $tel);
        if ($register) {
          $message = "
        <div class='p-3 bg-green-100 mb-2'>
          <p class=' text-green-900 text-center'>Đăng ký tài khoản thành công</p>
        </div>  
        ";
          header('location:/index.php?page=dangnhap');
        } else {
          $message = "
        <div class='p-3 bg-red-100 mb-2'>
          <p class=' text-red-900 text-center'>Đăng kí tài khoản thất bại.</p>
        </div>
        ";
        }
      }
    }
  }
}
?>
<div class='bg-gradient-to-r from-blue-50 via-blue-100 flex justify-center items-center h-full'>
  <form method='POST' class='w-[500px]  mt-20 p-10 bg-white  rounded-md shadow-lg'>
    <input type='hidden' name='page' value='dangky' />
    <input type='hidden' name='register' value='1' />
    <h5 class='text-center text-[30px] font-bold mb-4'>Đăng kí tài khoản</h5>
    <?php echo $message; ?>
    <div class="mb-4">
      <label for="email" class="block">Email:</label>
      <input class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" type='text' id="email" name='email' />
    </div>
    <div class="mb-4">
      <label class="block" for="username">Username:</label>
      <input class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" type='text' id="username" name='username' />
    </div>
    <div class="mb-4">
      <label class="block" for="password">Password:</label>
      <input class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" type='password' id="password" name='password' />
    </div>
    <div class="mb-4">
      <label class="block" for="address">Address:</label>
      <input class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" type='text' id="address" name='address' />
    </div>
    <div class="mb-4">
      <label class="block" for="tel">Số điện thoại:</label>
      <input class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" type='text' id="tel" name='tel' />
    </div>
    <button type='submit' class='btn text-center p-3 bg-blue-600 text-white w-full rounded-sm font-bold'>Đăng kí tài khoản</button>
    <a href='index.php?page=dangnhap' class='block text-start mt-4 text-blue-600'>Đăng nhập</a>
  </form>
</div>