<script src="https://cdn.tailwindcss.com"></script>
<?php
include './function.php';
spl_autoload_register('autoLoad');
$lstProduct = new Product();
$id = $_GET['id'] ?? 0;
$product = $lstProduct->detail($id);
include './config/tailwind.php';
include 'nav.php';
?>
<div class='w-[1200px] flex gap-[70px] h-[600px] mx-auto mt-32'>
  <div class='w-full flex gap-[30px]'>
    <div class='w-[170px] h-full gap-4 flex col flex-wrap'>
      <div class=' bg-[#f5f5f5] w-[170px] p-4 h-[138px]'>
        <img src='./images/product1.png' class='w-full h-full object-cover' />
      </div>
      <div class=' bg-[#f5f5f5] w-[170px] p-4 h-[138px]'>
        <img src='./images/product1.png' class='w-full h-full object-cover' />
      </div>
      <div class=' bg-[#f5f5f5] w-[170px] p-4 h-[138px]'>
        <img src='./images/product1.png' class='w-full h-full object-cover' />
      </div>
      <div class=' bg-[#f5f5f5] w-[170px] p-4 h-[138px]'>
        <img src='./images/product1.png' class='w-full h-full object-cover' />
      </div>
    </div>
    <div class=' w-[500px] h-full bg-[#f5f5f5] px-[27px] flex justify-center items-center'>
      <img src='./images/product1.png' class='w-full object-cover' />
    </div>
  </div>
  <div class='w-full flex flex-col gap-9'>
    <p class='font-semibold text-[24px]'><?php echo $product['name'] ?></p>
    <p class='text-red-500 text-[24px]'>200.000 đ</p>
    <div class='w-full h-[1px] bg-gray-600 my-2'></div>

    <div class='flex gap-4 items-center'>
      Colors:
      <div class='w-8 h-8 rounded-full border-2 border-white bg-red-500'></div>
      <div class='w-8 h-8 rounded-full border-2 border-black bg-orange-500'></div>
      <div class='w-8 h-8 rounded-full border-2 border-white bg-lime-500'></div>
      <div class='w-8 h-8 rounded-full border-2 border-white bg-cyan-500'></div>
    </div>
    <div class='flex gap-4 items-center'>
      <p>Size:</p>
      <div class='border w-8 h-8 border-[#989898] rounded-md flex justify-center items-center'>
        <div class='text-[#989898] font-semibold text-[14px]'>SX</div>
      </div>
      <div class='border w-8 h-8 border-[#989898] rounded-md flex justify-center items-center bg-primary'>
        <div class='font-semibold text-[14px] text-white'>X</div>
      </div>
      <div class='border w-8 h-8 border-[#989898] rounded-md flex justify-center items-center'>
        <div class='text-[#989898] font-semibold text-[14px]'>M</div>
      </div>
      <div class='border w-8 h-8 border-[#989898] rounded-md flex justify-center items-center'>
        <div class='text-[#989898] font-semibold text-[14px]'>L</div>
      </div>
    </div>
    <div class='flex gap-2 h-11'>
      <div class='flex'>
        <div class='w-10 border-2 border-r border-gray-700 flex justify-center items-center cursor-pointer rounded-l-md'>
          <p class='font-bold text-[16px]'>-</p>
        </div>
        <div class='w-16 border-2 border-gray-500 flex justify-center items-center '>
          <p class='font-bold text-[16px]'>1</p>
        </div>
        <div class=' w-10  flex justify-center items-center cursor-pointer rounded-r-md bg-primary text-white'>
          <p class='font-bold text-[16px]'>+</p>
        </div>
      </div>
      <button class=' w-full h-full bg-primary font-bold text-white rounded-sm'>Add to cart</button>
    </div>
  </div>
</div>