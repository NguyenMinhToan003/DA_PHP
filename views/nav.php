<form method='GET' action='../index.php?page=timkiem' class='bg-black text-white sticky top-0 z-50 shadow-lg'>
  <div class='w-[1200px] mx-auto flex justify-between items-center py-2 max-h-14'>
    <div class='font-bold text-[24px] w-[271px] hover:text-gray-300'>
      Exclusive
    </div>

    <div class='flex gap-5'>
      <div class='text-[14px] font-medium hover:text-yellow-400 transition-colors duration-200'>
        <a href='/index.php'>HOME</a>
      </div>
      <div class='text-[14px] font-medium hover:text-yellow-400 transition-colors duration-200'>
        <a>PRODUCT</a>
      </div>
      <div class='text-[14px] font-medium hover:text-yellow-400 transition-colors duration-200'>
        ABOUT
      </div>
    </div>


    <div class='relative w-[300px] flex justify-center items-center h-10'>
      <input placeholder='What are you looking for?'
        name='key'
        class='bg-white border border-gray-300 w-full py-2 pl-2 pr-10 text-md text-black rounded-md focus:ring-2 focus:ring-blue-400 transition-all' />
      <div class='absolute top-0 right-0 h-full w-[50px] flex items-center justify-center'>
        <img src='./icons/s.svg' class='w-4 h-4' />
      </div>
    </div>


    <a href='../index.php?page=giohang' class='bg-slate-500 p-2 rounded-full hover:bg-blue-600 transition-all'>
      <img src='./icons/search.svg' class='w-5 h-5' />
    </a>
  </div>
</form>