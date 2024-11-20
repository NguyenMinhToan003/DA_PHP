<?php

$products = array(
  array(
    'name' => 'iPhone 16 Pro Max| Chinh hang VN/A',
    'image' => 'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-16-pro-max.png',
    'price' => '34.300.000đ',
    'discount' => '-30%',
    'properties' => array(
      '6.9 inches',
      '256GB'
    )
  ),
  array(
    'name' => 'iPhone 16 Pro Max| Chinh hang VN/A',
    'image' => 'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/s/s/ss-s24-ultra-xam-222.png',
    'price' => '34.300.000đ',
    'discount' => '-30%',
    'properties' => array(
      '6.9 inches',
      '256GB'
    )
  ),
  array(
    'name' => 'iPhone 16 Pro Max| Chinh hang VN/A',
    'image' => 'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/d/i/dien-thoai-samsung-galaxy-s24-fe_3__4.png',
    'price' => '34.300.000đ',
    'discount' => '-30%',
    'properties' => array(
      '6.9 inches',
      '256GB'
    )
  ),
  array(
    'name' => 'iPhone 16 Pro Max| Chinh hang VN/A',
    'image' => 'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-15-plus_1__1.png',
    'price' => '34.300.000đ',
    'discount' => '-30%',
    'properties' => array(
      '6.9 inches',
      '256GB'
    )
  ),
  array(
    'name' => 'iPhone 16 Pro Max| Chinh hang VN/A',
    'image' => 'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-15-plus_1__1.png',
    'price' => '34.300.000đ',
    'discount' => '-30%',
    'properties' => array(
      '6.9 inches',
      '256GB'
    )
  ),
  array(
    'name' => 'iPhone 16 Pro Max| Chinh hang VN/A',
    'image' => 'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/s/a/samsung-s23-ulatra_2_.png',
    'price' => '34.300.000đ',
    'discount' => '-30%',
    'properties' => array(
      '6.9 inches',
      '256GB'
    )
  ),
  array(
    'name' => 'iPhone 16 Pro Max| Chinh hang VN/A',
    'image' => 'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-16-pro-max.png',
    'price' => '34.300.000đ',
    'discount' => '-30%',
    'properties' => array(
      '6.9 inches',
      '256GB',
      '8GB'
    )
  ),
  array(
    'name' => 'iPhone 16 Pro Max| Chinh hang VN/A',
    'image' => 'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-16-pro-max.png',
    'price' => '34.300.000đ',
    'discount' => '-30%',
    'properties' => array(
      '6.9 inches',
      '256GB'
    )
  ),
)
?>
<div class='mt-7 w-[1200px] mx-auto'>
  <div class='flex gap-3 items-center justify-start my-10'>
    <div class="w-5 h-10 rounded-sm bg-primary"></div>
    <p class='text-primary font-bold text-2xl'>Điện thoại nổi bật</p>
  </div>
  <div class='grid grid-cols-5 gap-3 '>

    <?php
    foreach ($products as $product) {
    ?>
      <div class='h-80 w-full rounded-md shadow-lg mb-3 relative cursor-pointer border border-gray-150'>
        <img src='<?php echo $product['image'] ?>' class='w-48 h-48 object-scale-down p-1 mx-auto' />
        <div class='px-2 flex flex-col gap-1 '>
          <div class='text-md font-bold'><?php echo $product['name'] ?></div>
          <div class='h-full flex gap-1 flex-wrap'>
            <?php
            foreach ($product['properties'] as $property) {
            ?>
              <p class=' px-2 py-1 border border-gray-300 rounded-lg max-w-fit max-h-fit text-[12px] inline-block'><?php echo $property ?></p>
            <?php
            }
            ?>
          </div>
          <div class='font-bold text-lg text-primary p-2'><?php echo $product['price'] ?></div>

        </div>
        <div class='absolute -left-2 top-0 bg-primary text-white px-3  py-1  rounded-r-full text-sm font-bold'><?php echo $product['discount'] ?></div>
      </div>
    <?php
    }
    ?>
  </div>
</div>