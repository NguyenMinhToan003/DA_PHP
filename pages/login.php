<?php
$message = '';
if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $user = new User();
  if (empty($email) || empty($password)) {
    $message = "
      <div class='p-3 bg-red-100 mb-2'>
        <p class=' text-red-900 text-center'>Vui lòng nhập đầy đủ thông tin.</p>
      </div>
        ";
  } else {
    $login = $user->login($email, $password);
    if ($login) {
      $message = "
        <div class='p-3 bg-green-100 mb-2'>
          <p class=' text-green-900 text-center'>Đăng nhập thành công</p>
        </div>  
        ";
      $_SESSION['user'] = $login[0];
      $_SESSION['user_id'] = $login[0];

      if ($_SESSION['user']['role_id'] === 1) {
        header('location: ../index.php?page=qlsanpham');
      } else {

        header('location:/index.php');
      }
    } else {
      $message = "
        <div class='p-3 bg-red-100 mb-2'>
          <p class=' text-red-900 text-center'>Đăng nhập thất bại.</p>
        </div>
        ";
    }
  }
}
?>
<div class='bg-gradient-to-r from-blue-50 via-blue-100 flex justify-center items-center h-full'>
  <form method='POST' class='w-[500px]  mt-20 p-10 bg-white  rounded-md shadow-lg'>
    <input type='hidden' name='page' value='dangnhap' />
    <input type='hidden' name='login' value='1' />
    <h5 class='text-center text-[30px] font-bold mb-4'>Đăng nhập</h5>
    <?php echo $message; ?>
    <div class="mb-4">
      <label for="email" class="block">Email:</label>
      <input class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
        type='text' id="email" name='email' />
    </div>

    <div class="mb-4">
      <label class="block" for="password">Password:</label>
      <input class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
        type='password' id="password" name='password' />
    </div>

    <button type='submit' class='btn text-center p-3 bg-blue-600 text-white w-full rounded-sm font-bold'>Đăng nhập</button>
    <a href='index.php?page=dangky' class='block text-start mt-4 text-blue-600'>Đăng ký tài khoản</a>
  </form>
</div>