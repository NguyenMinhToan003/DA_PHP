<?php
$product = new Product();
$key = $_GET['key'] ?? '';
$catagory_id = $_GET['catagory_id'] ?? 0;
$lstProduct = $product->getProductsByKeyAndCata($key, $catagory_id);
// $lstProduct = [];
// foreach ($lstProduct as $key => $value) {
//   // $p = $product->getProductDetails($value['product_id']);
//   // echo '<pre>';
//   // print_r($p);
//   // echo '</pre>';
// }
//in mang co can bo cuc
// $p = $product->all();
// echo '<pre>';
// print_r($p);
// echo '</pre>';

?>
<div class='mt-7 w-[1200px] mx-auto'>

  <div class='flex gap-3 items-center justify-start my-10'>
    <div class="w-5 h-10 rounded-sm bg-primary shadow-md"></div>
    <p class='text-primary font-bold text-2xl '>Sales</p>
  </div>

  <div class='grid grid-cols-4 gap-6'>
    <?php foreach ($lstProduct as $product) {
    ?>
      <article class='group '>
        <a href='../index.php?page=sanpham&id=<?= $product['product_id'] ?>' class='block h-full'>
          <div class='relative bg-gray-100 h-64 p-3'>
            <img src='<?= $product['images'][0]['url_image'] ?? '' ?>'
              class='object-scale-down w-full h-full group-hover:scale-110 transition-transform duration-300'>
            <div class='absolute bottom-0 left-0 w-full bg-black/50 text-white text-center py-2 group-hover:bg-green-500'>
              Xem chi tiết
            </div>
          </div>
          <div class='p-4'>
            <h3 class='text-lg font-bold text-gray-800 group-hover:text-primary whitespace-nowrap'><?= $product['product_name'] ?></h3>
            <p class='text-primary text-xl font-semibold'>
              <?php echo $product['price'] ?>đ
            </p>
          </div>
        </a>
      </article>
    <?php } ?>
  </div>
</div>