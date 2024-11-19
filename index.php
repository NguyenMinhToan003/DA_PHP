<!doctype html>
<html class="dark">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<?php
$indexBanner = $_GET['indexbanner'] ?? 0;

$banner = array(
  array(
    'color' => 'black',
    'title' => 'Black',
  ),
  array(
    'color' => 'green-900',
    'title' => 'Stone',
  ),
  array(
    'color' => 'orange-950',
    'title' => 'Orange',
  ),
  array(
    'color' => 'emerald-800',
    'title' => 'Emerald',
  ),
);

?>

<body>
  <div>
    <div>
      <div class='flex w-[1170px] justify-between mx-auto py-[7px] items-center my-[8px]'>
        <div class='font-bold text-[24px] w-[271px]'>Exclusive</div>
        <div class='flex gap-5'>
          <div class='text-[16px] font-medium'>Home</div>
          <div class='text-[16px] font-medium'>Contact</div>
          <div class='text-[16px] font-medium'>About</div>
          <div class='text-[16px] font-medium'>Sign Up</div>
        </div>
        <div class='relative w-[300px]'>
          <input placeholder='What are you looking for?'
            class='bg-gray-50 border border-gray-300 block w-full py-[10px] 
            pl-[10px] pr-[40px] text-md text-[#db4444]' />
          <div class='absolute top-0 right-0 h-full w-[50px] flex items-center justify-center'>
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
            </svg>
          </div>
        </div>
        <button class='btn p-3 bg-slate-400 rounded'>
          <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
          </svg>

        </button>
      </div>
      <div class=' h-[1px] w-full bg-[#dedede]'>
        <div class='flex w-[1170px] mx-auto'>
          <div class='w-[271px] h-full mt-[40px] mr-[16px] flex flex-col gap-4'>
            <div class='text-[16px] '><a href='#'>Woman’s Fashion</a></div>
            <div class='text-[16px] '><a href='#'>Man’s Fashion</a></div>
            <div class='text-[16px] '>Electronics</div>
            <div class='text-[16px] '>Home & Lifestyle</div>
            <div class='text-[16px] '>Medicine</div>
            <div class='text-[16px] '>Sports & Outdoor</div>
            <div class='text-[16px] '>Baby’s & Toys</div>
            <div class='text-[16px] '>Groceries & Pets</div>
            <div class='text-[16px] '>Health & Beauty</div>
          </div>
          <div class='h-[388px] w-[1px] bg-[#dedede]'></div>
          <div class='mt-[40px] ml-[45px] relative'>
            <div class=' w-[892px] h-[344px] bg-gray-500 overflow-x-hidden  '>
              <div class='w-full h-full flex banner transition-all  '>
                <?php
                foreach ($banner as $key => $value) {
                  echo "<div class='min-w-full text-white h-full bg-" . $value['color'] . "'>
                   <div>" . $value['title'] . "</div>
                  </div>";
                }
                ?>
              </div>
            </div>
            <div class=' absolute bottom-[11px] left-[50%] translate-x-[-50%] '>
              <?php
              for ($i = 0; $i < count($banner); $i++) {
              ?>
                <div class='dot w-3 h-3 cursor-pointer bg-[#808080] rounded-full inline-block mx-1'></div>
              <?php
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    const dots = document.querySelectorAll('.dot');
    const banner = document.querySelector('.banner');
    let activeDot = dots[0];
    dots[0].classList.add('bg-[#db4444]', 'border-while', 'border-2');
    dots.forEach((dot, index) => {
      dot.addEventListener('click', () => {
        banner.style.transform = `translateX(-${index * 100}%)`;
        activeDot.classList.remove('bg-[#db4444]', 'border-while', 'border-2');
        dot.classList.add('bg-[#db4444]', 'border-while', 'border-2');
        activeDot = dot;
      });
    });
  </script>
</body>

</html>