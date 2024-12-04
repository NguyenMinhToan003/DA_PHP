<?php

$productId = $_GET['id'] ?? 0;

$sizeId = $_GET['size_id'] ?? 0;

$lstProduct = new Product();
$product = $lstProduct->getProductDetails($productId, $sizeId);
if ($sizeId == 0) {
  $sizeId = $product['sizes'][0]['size_id'] ?? 0;
  $product = $lstProduct->getProductDetails($productId, $sizeId);
}

if (!$product) {
  header('Location: index.php');
  exit;
}

include './views/nav.php';
?>

<form method='POST' action='../functions/cart.php' class='w-[1200px] flex gap-[70px] md:h-[600px] h-auto mx-auto mt-10 md:flex-row flex-col'>
  <div class='w-full flex gap-[30px]'>
    <div class='w-[170px] h-full gap-4 flex flex-col flex-wrap'>
      <?php foreach ($product['images'] as $image) { ?>
        <div class='bg-[#f5f5f5] w-[170px] p-4 h-[138px]'>
          <img src='<?php echo $image['url_image']; ?>' class='w-full h-full object-scale-down' />
        </div>
      <?php } ?>
    </div>
    <div class='w-[500px] md:h-[600px] h-auto bg-[#f5f5f5] px-[27px] flex justify-center items-center p-10'>
      <img src='<?php echo $product['images'][0]['url_image']; ?>' class='w-full object-scale-down' />
    </div>
  </div>

  <div class='w-full flex flex-col gap-6'>

    <p class='font-semibold text-[24px]'><?php echo $product['product_name']; ?></p>
    <p><?php echo $product['product_description']; ?></p>


    <p class='text-primary text-[32px] font-bold'><?php echo number_format($product['price']); ?> đ</p>
    <div class='w-full h-1 bg-gradient-to-r from-red-500 via-gray-400 to-blue-500 my-4'></div>

    <?php
    if ($product['sizes']) { ?>
      <div class='flex gap-4 items-center'>
        <span class='text-lg font-semibold'>Sizes:</span>
        <?php
        foreach ($product['sizes'] as $size) { ?>
          <a
            href='../index.php?page=sanpham&id=<?php echo $productId ?>&size_id=<?php
                                                                                echo $size['size_id'] ?>'>
            <div
              for='<?php echo $size['size_id']; ?>'
              class='w-[32px] h-[32px] rounded-md border-2 border-gray-400 flex justify-center items-center cursor-pointer text-[12px] p-[6px]
                transition-all duration-300
             <?php
              if ($size['size_id'] == $sizeId) {
                echo 'bg-red-500 border-red-500 text-white';
              }
              ?>
           '>
              <p class=' text-black font-semibold text-inherit'><?php echo strtoupper($size['size_code']); ?></p>
            </div>
          </a>
        <?php } ?>
      </div>
    <?php } ?>

    <?php
    if ($product['colors']) { ?>
      <div class='flex gap-4 items-center'>
        <span class='text-lg font-semibold'>Colours:</span>
        <?php
        $defaultColor = $product['colors'][0]['color_id'] ?? 0;
        foreach ($product['colors'] as $color) {
        ?>
          <div>
            <input
              type='radio'
              name='color'
              <?php echo $color['color_id'] === $defaultColor ? 'checked' : '' ?>
              value='<?php echo $color['color_id']; ?>'
              id='<?php echo $color['color_code']; ?>'
              class='peer hidden' />
            <label
              for='<?php echo $color['color_code']; ?>'
              class='w-[24px] h-[24px] rounded-full flex justify-center items-center cursor-pointer p-1
                        transition-all duration-300 peer-checked:border-black peer-checked:ring-black peer-checked:ring-2'>
              <div class='w-[16px] h-[16px] rounded-full bg-<?php echo $color['color_code']; ?>'></div>
            </label>
          </div>
        <?php } ?>
      </div>
    <?php } ?>
    <div class='flex gap-6 h-11'>
      <input type='hidden' name='product_id' value='<?php echo $product['product_id']; ?>' />
      <input type='hidden' name='size' value='<?php echo $sizeId ?>' />
      <button type='submit' name='add_to_cart' value='1' class='btn w-full bg-gradient-to-r from-red-500 via-primary to-orange-700 text-white p-3 rounded-sm font-semibold'>
        Add to cart
      </button>
    </div>


  </div>
</form>



<?php
$lstProduct = new Product();
$lstProduct = $lstProduct->random4();
?>
<div class='my-7 w-[1200px] mx-auto'>
  <div class='flex gap-3 items-center justify-start my-10'>
    <div class='w-5 h-10 rounded-sm bg-primary'></div>
    <p class='text-primary font-bold text-2xl'>Sản phẩm khác</p>
  </div>
  <div class='grid grid-cols-4 gap-3 p-3'>
    <?php foreach ($lstProduct as $product) { ?>
      <a href='../index.php?page=sanpham&id=<?php echo $product['product_id']; ?>' class='h-80'>
        <div class='h-64 bg-[#f5f5f5] rounded-sm w-full px-[40px] py-[35px]'>
          <img src='<?php echo $product['images'][0]['url_image']; ?>' class='w-full h-full object-scale-down' />
        </div>
        <div class='p-2 flex flex-col gap-2'>
          <p class='text-black text-[16px] font-bold'><?php echo $product['name']; ?></p>
          <p class='text-red-700'>200.000đ</p>
        </div>
      </a>
    <?php } ?>
  </div>
</div>