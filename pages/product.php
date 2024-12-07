<?php
$productId = $_GET['id'] ?? 0;
$sizeId = $_GET['size_id'] ?? 0;

$lstProduct = new Product();
$product = $lstProduct->getProductDetails($productId, $sizeId);

if ($sizeId == 0) {
  $sizeId = $product['sizes'][0]['size_id'] ?? 0;
  $product = $lstProduct->getProductDetails($productId, $sizeId);
}
$lstProduct = $lstProduct->random4($productId);

if (!$product) {
  header('Location: index.php');
  exit;
}

include './views/nav.php';
?>

<!-- Product Details Form -->
<form method='POST' action='../functions/cart.php' class=' w-[1200px] flex gap-10 mx-auto mt-10 flex-col md:flex-row p-1'>
  <div class='w-full flex gap-6'>
    <!-- Thumbnail Images -->
    <div class='flex flex-col gap-3'>
      <?php for ($i = 1; $i < count($product['images']); $i++) { ?>
        <div class='bg-gray-100 p-4 w-[170px] h-[140px] rounded-md shadow-sm'>
          <img src='<?php echo $product['images'][$i]['url_image']; ?>' alt='Product Thumbnail' class='w-full h-full object-scale-down' />
        </div>
      <?php } ?>
    </div>

    <!-- Main Product Image -->
    <div class=' bg-gray-100 p-2 flex justify-center items-center rounded-md  w-[600px] h-[600px]'>
      <img src='<?php echo $product['images'][0]['url_image']; ?>' alt='Main Product Image' class='w-full h-full  object-scale-down' />
    </div>
  </div>

  <div class='flex flex-col gap-6 w-full'>
    <!-- Product Information -->
    <h1 class='text-2xl font-semibold'><?php echo $product['product_name']; ?></h1>
    <p class='text-gray-600'><?php echo $product['product_description']; ?></p>
    <p class='text-3xl text-red-500 font-bold'><?php echo number_format($product['price']); ?> đ</p>
    <div class='h-1 bg-gradient-to-r from-red-500 via-gray-400 to-blue-500 my-4'></div>

    <!-- Size Options -->
    <?php if ($product['sizes']) { ?>
      <div class='flex items-center gap-4'>
        <span class='text-lg font-semibold'>Sizes:</span>
        <?php

        foreach ($product['sizes'] as $size) { ?>
          <a href='../index.php?page=sanpham&id=<?php echo $productId; ?>&size_id=<?php echo $size['size_id']; ?>'>
            <div class='w-8 h-8 flex justify-center items-center rounded-md border-2 border-gray-400 text-sm p-4  
                            <?php echo $size['size_id'] == $sizeId ? 'bg-red-500 text-white' : ''; ?>'>
              <?php echo strtoupper($size['size_code']); ?>
            </div>
          </a>
        <?php } ?>
      </div>
    <?php } ?>

    <!-- Color Options -->
    <?php if ($product['colors']) { ?>
      <div class='flex items-center gap-4'>
        <span class='text-lg font-semibold'>Colors:</span>
        <?php
        $colorDefault = $product['colors'][0]['color_id'];

        foreach ($product['colors'] as $color) { ?>
          <label class='cursor-pointer'>
            <input type='radio' name='color' value='<?php echo $color['color_id']; ?>'
              checked='<?php echo $color['color_id'] == $colorDefault ? 'checked' : ''; ?>'
              class='hidden peer' />
            <div class='w-6 h-6 rounded-full bg-<?php echo $color['color_code']; ?> border-2 
                            peer-checked:ring-2 peer-checked:ring-black'></div>
          </label>
        <?php } ?>
      </div>
    <?php } ?>

    <!-- Add to Cart Button -->
    <div>
      <input type='hidden' name='product_id' value='<?php echo $product['product_id']; ?>' />
      <input type='hidden' name='size' value='<?php echo $sizeId; ?>' />
      <button type='submit' name='add_to_cart' value='1' class='bg-gradient-to-r from-red-500 to-orange-700 text-white px-6 py-2 w-full rounded-lg font-semibold hover:opacity-90 transition'>
        Thêm vào giỏ hàng
      </button>

    </div>
  </div>
</form>

<!-- Other Products -->
<div class='my-10 w-[1200px] mx-auto'>
  <h2 class='text-primary font-bold text-2xl mb-6'>Sản phẩm khác</h2>
  <div class='grid grid-cols-2 md:grid-cols-4 gap-4'>
    <?php foreach ($lstProduct as $relatedProduct) { ?>
      <a href='../index.php?page=sanpham&id=<?php echo $relatedProduct['product_id']; ?>' class='bg-gray-100 rounded-lg p-4 shadow-md hover:shadow-lg transition'>
        <img src='<?php echo $relatedProduct['images'][0]['url_image']; ?>' alt='Product Image' class='w-full h-40 object-scale-down mb-4' />
        <h3 class='font-semibold text-lg'><?php echo $relatedProduct['name']; ?></h3>
        <p class='text-red-500 font-bold'><?php
                                          echo number_format($relatedProduct['price']);
                                          ?>
          đ</p>
      </a>
    <?php } ?>
  </div>
</div>