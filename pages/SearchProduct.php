<?php

$Catagory = new Catagory();
$catagories = $Catagory->all();
$Product = new Product();
$key = isset($_GET['key']) ? $_GET['key'] : '';
$catagory_id = isset($_GET['catagory_id']) ? $_GET['catagory_id'] : 0;
$lstProduct = $Product->getProductsByKeyAndCata($key, $catagory_id);

include './views/nav.php';

?>

<div class='w-full bg-green-600 h-28 flex items-center justify-center'>
  <?php if ($key != '') { ?>
    <p class='text-[24px] font-bold text-white'>Kết quả tìm kiếm: <span class='text-orange-300'><?= $key ?></span></p>
  <?php } elseif ($catagory_id != 0) {
    $catagory = $Catagory->find($catagory_id); ?>
    <p class='text-[24px] font-bold text-white'>Danh mục sản phẩm: <span class='text-orange-300'><?= $catagory[0]['name'] ?></span></p>
  <?php } else { ?>
    <p class='text-[24px] font-bold text-white'>Tất cả sản phẩm</p>
  <?php } ?>
</div>

<div class='flex w-[1200px] mx-auto gap-8 mt-10'>
  <div class='w-[270px] flex flex-col gap-4'>
    <?php foreach ($catagories as $catagory) { ?>
      <a href='../index.php?page=timkiem&catagory_id=<?= $catagory['catagory_id'] ?>'
        class='text-[16px] py-3 px-4 border-l-4 border-transparent hover:border-green-500 transition-all'>
        <?= $catagory['name'] ?>
      </a>
    <?php } ?>
  </div>


  <div class='h-auto w-[1px] bg-gray-300'></div>


  <main class='flex-1 grid grid-cols-3 gap-6'>
    <?php if (count($lstProduct) > 0) { ?>
      <?php foreach ($lstProduct as $product) { ?>
        <article class='group '>
          <a href='../index.php?page=sanpham&id=<?= $product['product_id'] ?>' class='block h-full'>
            <div class='relative bg-gray-100 h-64 p-3'>
              <img src='<?= $product['images'][0]['url_image'] ?>'
                class='object-scale-down w-full h-full group-hover:scale-110 transition-transform duration-300'>
              <div class='absolute bottom-0 left-0 w-full bg-black/50 text-white text-center py-2 group-hover:bg-green-500'>
                Xem chi tiết
              </div>
            </div>
            <div class='p-4'>
              <h3 class='text-lg font-bold text-gray-800 group-hover:text-green-500'><?= $product['product_name'] ?></h3>
              <p class='text-red-600 text-xl font-semibold'><?= number_format($product['price']) ?>đ</p>
            </div>
          </a>
        </article>
      <?php } ?>
    <?php } else { ?>
      <p class='col-span-3 text-center text-gray-500'>Không tìm thấy sản phẩm nào</p>
    <?php } ?>
  </main>
</div>