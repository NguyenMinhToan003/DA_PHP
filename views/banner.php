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
<div class='flex w-[1200px] mx-auto'>

  <div class='w-[271px] h-full mt-[40px] mr-[16px] flex flex-col gap-4'>
    <div class='text-[16px] hover:text-primary transition-colors duration-200'>
      <a href='#'>Woman’s Fashion</a>
    </div>
    <div class='text-[16px] hover:text-primary transition-colors duration-200'>
      <a href='#'>Man’s Fashion</a>
    </div>
    <div class='text-[16px] hover:text-primary transition-colors duration-200'>
      Electronics
    </div>
    <div class='text-[16px] hover:text-primary transition-colors duration-200'>
      Home & Lifestyle
    </div>
    <div class='text-[16px] hover:text-primary transition-colors duration-200'>
      Medicine
    </div>
    <div class='text-[16px] hover:text-primary transition-colors duration-200'>
      Sports & Outdoor
    </div>
    <div class='text-[16px] hover:text-primary transition-colors duration-200'>
      Baby’s & Toys
    </div>
    <div class='text-[16px] hover:text-primary transition-colors duration-200'>
      Groceries & Pets
    </div>
    <div class='text-[16px] hover:text-primary transition-colors duration-200'>
      Health & Beauty
    </div>
  </div>


  <div class='h-[388px] w-[1px] bg-[#dedede]'></div>


  <div class='mt-[40px] ml-[45px] relative'>
    <div class='w-[892px] h-[344px] bg-gray-500 overflow-hidden rounded-md shadow-lg'>
      <div class='w-full h-full flex banner transition-all ease-linear'>
        <?php
        foreach ($banner as $key => $value) {
        ?>
          <div class='relative min-w-full h-full overflow-hidden flex items-center justify-center bg-<?php echo $value['color'] ?> rounded-xl'>
            <div class='text-white max-w-56 text-xl font-semibold absolute left-16 bottom-20'>
              <?php echo $value['title'] ?>
            </div>
            <?php
            if (isset($value['img'])) {
            ?>
              <img src='<?php echo $value['img'] ?>' class='w-[496px] h-[352px] object-cover absolute top-[50%] right-3 translate-y-[-50%]' />
            <?php
            }
            ?>
          </div>
        <?php
        }
        ?>
      </div>
    </div>

    <div class='absolute left-1 right-1 top-0 h-full flex justify-between items-center '>
      <button class='bg-slate-300 p-1 rounded-full hover:bg-primary transition-all arrowlef'>
        <img src='./icons/arrowleft.svg' />
      </button>
      <button class='bg-slate-300 p-1 rounded-full hover:bg-primary transition-all arrowright '>
        <img src='./icons/arrowright.svg' />
      </button>
      <div class='absolute bottom-3 left-[50%] translate-x-[-50%]'>
        <?php
        for ($i = 0; $i < count($banner); $i++) {
        ?>
          <div class='dot w-3 h-3 cursor-pointer bg-[#808080] rounded-full inline-block mx-1 transition-all hover:bg-primary'></div>
        <?php
        }
        ?>
      </div>
    </div>
  </div>
</div>
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