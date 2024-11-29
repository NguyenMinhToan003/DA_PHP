<?php
include './function.php';
spl_autoload_register('autoLoad');
$product = new Product();
$key = $_GET['key'] ?? '';
$lstProduct = $product->searchByName($key);
?>
<div class='mt-7 w-[1200px] mx-auto'>
  <div class='flex gap-3 items-center justify-start my-10'>
    <div class="w-5 h-10 rounded-sm bg-primary"></div>
    <p class='text-primary font-bold text-2xl'>Sales</p>
  </div>
  <div class='grid grid-cols-4 gap-3 p-3'>
    <?php

    foreach ($lstProduct as $product) {
    ?>
      <a href='/product.php?id=<?php echo $product['id']; ?>' class='h-80'>
        <div class='h-64 bg-[#f5f5f5] rounded-sm w-full px-[40px] py-[35px]'>
          <img src='<?php echo $product['image'] ?>' class='w-full h-full object-scale-down' />
        </div>
        <div class='p-2 flex flex-col gap-2'>
          <p class='text-black text-[16px] font-bold'><?php echo $product['name'] ?></p>
          <p class='text-red-700'>200.000đ</p>
        </div>
      </a>
    <?php
    }
    ?>
  </div>
</div>