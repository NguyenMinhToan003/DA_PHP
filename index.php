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
    'title' => 'iPhone 16 Pro Max | Chinh hang VN/A giảm giá 30%',
    'img' => './images/banner1.png',
  ),
  array(
    'color' => 'slate-400',
    'title' => 'Stone',

  ),
  array(
    'color' => 'orange-800',
    'title' => 'Orange',

  )
);

?>

<body>

  <div>
    <div>
      <div class=' bg-black text-white sticky top-0 z-50 shadow-2xl'>
        <div class='w-[1200px] mx-auto flex justify-between items-center py-2 '>
          <div class=' font-bold text-[24px] w-[271px]'>Exclusive</div>
          <div class='flex gap-5'>
            <div class='text-[14px] font-medium'><a href='/'>Home</a></div>
            <div class='text-[14px] font-medium'><a href='/product'>Product</a></div>
            <div class='text-[14px] font-medium'>About</div>
            <div class='text-[14px] font-medium'>Sign Up</div>
          </div>
          <div class='relative w-[300px]'>
            <input placeholder='What are you looking for?'
              class='bg-gray-50 border border-gray-300 block w-full py-2
            pl-2  pr-10 text-md text-primary' />
            <div class='absolute top-0 right-0 h-full w-[50px] flex items-center justify-center'>
              <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
              </svg>
            </div>
          </div>
          <button class='btn p-2 bg-slate-400 rounded'>
            <img src='./icons/search.svg' />
          </button>
        </div>
      </div>
      <div class=' h-[1px] w-full bg-more'></div>

      <?php
      $path = $_SERVER['REQUEST_URI'];
      if ($path == '/') {
        include 'banner.php';
        include 'listProduct.php';
      }
      if ($path == '/product') {
        include 'product.php';
      }
      ?>
    </div>
  </div>

  </div>
  <?php
  include './config/tailwind.php';
  ?>
  <script>
    const dots = document.querySelectorAll('.dot');
    const banner = document.querySelector('.banner');
    let activeDot = dots[0];
    dots[0].classList.add('bg-primary', 'border-while', 'border-2');
    dots.forEach((dot, index) => {
      dot.addEventListener('click', () => {
        banner.style.transform = `translateX(-${index * 100}%)`;
        activeDot.classList.remove('bg-primary', 'border-while', 'border-2');
        dot.classList.add('bg-primary', 'border-while', 'border-2');
        activeDot = dot;
      });
    });
    const arrowLeft = document.querySelector('.arrowlef');
    const arrowRight = document.querySelector('.arrowright');
    let indexBanner = 0;
    const handlerNextBanner = (element = '') => {
      if (element === 'right' || element === '') {
        indexBanner++;
        if (indexBanner >= dots.length) {
          indexBanner = 0;
        }
      } else {
        indexBanner--;
        if (indexBanner < 0) {
          indexBanner = dots.length - 1;
        }
      }
      banner.style.transform = `translateX(-${indexBanner * 100}%)`;
      activeDot.classList.remove('bg-primary', 'border-while', 'border-2');
      dots[indexBanner].classList.add('bg-primary', 'border-while', 'border-2');
      activeDot = dots[indexBanner];
    }
    arrowRight.addEventListener('click', () => {
      handlerNextBanner('right');
    });
    arrowLeft.addEventListener('click', () => {
      handlerNextBanner('left');
    })
    const timeout = setInterval(() => {
      handlerNextBanner();
    }, 4000);
  </script>
</body>

</html>