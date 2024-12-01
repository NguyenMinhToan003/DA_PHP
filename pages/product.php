<?php
$lstProduct = new Product();
$id = $_GET['id'] ?? 0;
$product = $lstProduct->detail($id);
if (!$product) {
  header('location: index.php');
}

include './views/nav.php';
?>

<form method='POST' action='../functions//cart.php' class='w-[1200px] flex gap-[70px] md:h-[600px] h-auto mx-auto mt-10 md:flex-row flex-col'>
  <div class=' w-full flex gap-[30px]'>
    <div class='w-[170px] h-full gap-4 flex flex-col flex-wrap'>
      <?php for ($i = 1; $i < 4; $i++) { ?>
        <div class='bg-[#f5f5f5] w-[170px] p-4 h-[138px]'>
          <img src='<?php echo $product['images'][$i]['url_image'] ?>' class='w-full h-full object-scale-down' />
        </div>
      <?php } ?>
    </div>
    <div class='w-[500px] md:h-[600px] h-auto bg-[#f5f5f5] px-[27px] flex justify-center items-center p-10'>
      <img src='<?php echo $product['images'][0]['url_image'] ?>' class='w-full  object-scale-down' />
    </div>
  </div>


  <div class='w-full flex flex-col gap-6' method='post'>
    <p class='font-semibold text-[24px]'><?php echo $product['name']; ?></p>
    <p>
      <?php echo $product['description']; ?>
    </p>
    <p class='text-primary text-[32px] font-bold'><?php echo number_format($product['price']); ?> đ</p>
    <div class='w-full h-1 bg-gradient-to-r from-red-500 via-gray-400 to-blue-500 my-4'></div>

    <div class='flex gap-4 items-center'>
      <span class='text-lg font-semibold'>Colours:</span>
      <?php
      $defaultColor = $product['colors'][0]['color'] ?? '';
      foreach ($product['colors'] as $color) { ?>
        <div>
          <input
            type='radio'
            name='color'
            value='<?php echo $color['color']; ?>'
            id='<?php echo $color['color']; ?>'
            <?php echo $color['color'] === $defaultColor ? 'checked' : ''; ?>
            class='peer hidden' />
          <label
            for='<?php echo $color['color']; ?>'
            class='w-8 h-8 rounded-full border-2 border-gray-400 flex justify-center items-center cursor-pointer 
               peer-checked:border-black peer-checked:ring-2 peer-checked:ring-black transition-all'>
            <div class='w-full h-full rounded-full bg-<?php echo $color['color']; ?>'></div>
          </label>
        </div>
      <?php } ?>
    </div>

    <div class='flex gap-4 items-center'>
      <span>Size:</span>
      <?php

      $defaultSize = $product['sizes'][0]['size_code'] ?? '';
      foreach ($product['sizes'] as $size) { ?>
        <div>
          <input
            name='size'
            type='radio'
            value='<?php echo $size['size_code']; ?>'
            id='<?php echo $size['size_code']; ?>'
            <?php echo $size['size_code'] === $defaultSize ? 'checked' : ''; ?>
            class='peer hidden' />
          <label
            for='<?php echo $size['size_code']; ?>'
            class='w-12 h-12 rounded-md border-2 border-gray-400 flex justify-center items-center cursor-pointer
               peer-checked:bg-red-500 peer-checked:border-red-500 peer-checked:text-white '>
            <p class='text-black font-semibold text-inherit'><?php echo strtoupper($size['size_code']); ?></p>
          </label>
        </div>
      <?php } ?>
    </div>


    <div class='flex gap-2 h-11'>
      <div class='flex'>
        <div class='w-10 flex justify-center items-center cursor-pointer rounded-l-md bg-gray-100  border-2 border-black border-r-0 '>
          <p class='font-bold text-[16px]'>-</p>
        </div>
        <div class='w-16 border-2 border-black flex justify-center items-center  border-r-0'>
          <p name='quatity' value='1' class='font-bold text-[16px]'>1</p>
        </div>
        <div class='w-10 flex justify-center items-center cursor-pointer rounded-r-md bg-primary text-white hover:text-black hover:bg-gray-300 transition-all duration-300'>
          <p class=' font-bold text-[16px]'>+</p>
        </div>
      </div>
      <input type='hidden' name='product_id' value='<?php echo $product['product_id']; ?>' />
      <input type='hidden' name='price' value='<?php echo $product['price']; ?>' />
      <input type='hidden' name='add_to_cart' value='1' />
      <input type='hidden' name='url_image' value='<?php echo $product['images'][0]['url_image'] ?>' />
      <input type='hidden' name='name' value='<?php echo $product['name']; ?>' />
      <button type='submit' class='btn w-full bg-gradient-to-r from-red-500 via-primary to-orange-700 text-white p-3 rounded-md '>
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