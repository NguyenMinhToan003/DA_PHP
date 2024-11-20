 <div class='flex w-[1200px] mx-auto'>
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
       <div class='w-full h-full flex banner transition-all ease-linear '>
         <?php
          foreach ($banner as $key => $value) {
          ?>
           <div class='relative min-w-full h-full overflow-hidden flex items-center justify-center bg-<?php echo $value['color'] ?>'>
             <div class='text-white max-w-56 text-xl font-semibold absolute left-16 bottom-20 '><?php echo $value['title'] ?></div>
             <?php
              if (isset($value['img'])) {
              ?>
               <img src='<?php echo $value['img'] ?>' class='w-[496px] h-[352px] object-cover absolute top-[50%] right-3 translate-y-[-50%] ' />
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
       <button class='bg-slate-300 p-1 arrowlef'><img src=' ./icons/arrowleft.svg' /></button>
       <button class='bg-slate-300 p-1 arrowright'><img src='./icons/arrowright.svg' /></button>
       <div class=' absolute bottom-3 left-[50%] translate-x-[-50%] '>
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