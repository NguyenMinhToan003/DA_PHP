<?php
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

?>
<form method='GET' action='../index.php' class='bg-black text-white sticky top-0 z-50 shadow-lg'>
    <input type='hidden' name='page' value='timkiem' />
    <div class='w-[1200px] mx-auto flex justify-between items-center py-2 max-h-14'>
        <div class='font-bold text-[24px] w-[271px] hover:text-gray-300'>
            Exclusive
        </div>
        <div class='flex gap-5'>
            <div class='text-[14px] font-medium hover:text-yellow-400 transition-colors duration-200'>
                <a href='/index.php'>HOME</a>
            </div>
            <div class='text-[14px] font-medium hover:text-yellow-400 transition-colors duration-200'>
                <a href='../index.php?page=history'>Lịch sử mua hàng</a>
            </div>
            <div class='text-[14px] font-medium hover:text-yellow-400 transition-colors duration-200'>
                ABOUT
            </div>
            <?php
      if (!isset($_SESSION['user'])) {
      ?>

        <a href='../index.php?page=dangky' class='text-[14px] font-medium hover:text-yellow-400 transition-colors duration-200'>
          DANG KY
        </a>
      <?php
      } else if ($_SESSION['user']['role_id'] === 1) {

      ?>
            <a href='../index.php?page=qlsanpham'
                class='text-[14px] font-medium hover:text-yellow-400 transition-colors duration-200'>
                QUAN LY SAN PHAM
            </a>
            <?php
      }
      ?>
        </div>


        <div class='relative w-[300px] flex justify-center items-center '>
            <input placeholder='What are you looking for?' name='key'
                class='bg-white border border-gray-300 w-full py-2 pl-2 pr-10 text-md text-black rounded-md focus:ring-2 focus:ring-blue-400 transition-all' />
            <div class='absolute top-0 right-0 h-full w-[50px] flex items-center justify-center'>
                <img src='./icons/s.svg' class='w-4 h-4' />
            </div>
        </div>


        <div class='flex gap-3 justify-center items-center'>
            <?php
      if (isset($_SESSION['user'])) {
      ?>
            <a href='../functions/logout.php'
                class='text-[14px] font-medium hover:text-yellow-400 transition-colors duration-200'>
                Chào bạn <?php echo $_SESSION['user']['username']; ?>
            </a>
            <?php
      } else {
      ?>
            <a href='../index.php?page=dangnhap' class=''>
                LOGIN
            </a>
            <?php
      }
      ?>

            <a href='../index.php?page=giohang'
                class='bg-slate-500 p-2 rounded-full hover:bg-blue-600 transition-all relative block'>
                <img src='./icons/search.svg' class='w-5 h-5' />
                <?php if (count($cart) > 0) { ?>
                <div
                    class='absolute -top-2 -right-2 bg-red-500 text-white w-5 h-5 flex justify-center items-center rounded-full'>
                    <?php echo count($cart); ?>
                </div>
                <?php } ?>
            </a>
        </div>
    </div>
</form>