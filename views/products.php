<?php
$product = new Product();
$key = $_GET['key'] ?? '';
$lstProduct = $product->searchByName($key);

//in mang co can bo cuc
// echo '<pre>';
// print_r($lstProduct);
// echo '</pre>';

?>
<div class='mt-7 w-[1200px] mx-auto'>

  <div class='flex gap-3 items-center justify-start my-10'>
    <div class="w-5 h-10 rounded-sm bg-primary shadow-md"></div>
    <p class='text-primary font-bold text-2xl '>Sales</p>
  </div>

  <div class='grid grid-cols-4 gap-6 p-3'>
    <?php
    foreach ($lstProduct as $product) {
    ?>
      <a href='../index.php?page=sanpham&id=<?php echo $product['product_id']; ?>'
        class='h-80 group '>
        <div class='h-64 bg-[#f9f9f9] rounded-lg w-full px-[40px] py-[35px] border border-gray-200  group-hover:shadow-md relative'>
          <img src='<?php echo $product['images'][0]['url_image'] ?>'
            class='w-full h-full object-scale-down group-hover:scale-110
            transition-transform duration-300 ' />
          <div class='absolute bottom-0 left-0 right-0 h-10 p-1 bg-black text-white flex items-center justify-center rounded-b opacity-40'>
            <p class='text-[14px] font-semibold'>Xem chi tiết</p>
          </div>
        </div>

        <div class='p-3 flex flex-col gap-2'>
          <p class='text-black text-[16px] font-bold group-hover:text-primary'>
            <?php echo $product['name'] ?>
          </p>
          <p class='text-red-700 font-semibold text-lg'>
            200.000đ
          </p>
        </div>
      </a>
    <?php
    }
    ?>
  </div>
</div>