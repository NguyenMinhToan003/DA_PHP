<!doctype html>
<html>

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


      <?php
      include 'nav.php';
      include 'banner.php';
      $path = $_SERVER['REQUEST_URI'];
      include 'products.php';

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