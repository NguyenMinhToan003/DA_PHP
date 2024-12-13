<?php
$user = isset($_SESSION['user']) ? $_SESSION['user'] : '';

?>
<form method='GET' action="../index.php">
    <div class='bg-blue-900 text-white w-48 p-4 flex flex-col justify-between fixed left-0 top-0 bottom-0'>
        <div>
            <h2 class='text-lg font-bold mb-4'>Trang Quản Trị</h2>
            <div class="mb-4">
                <img src='../images/Logo_STU.png' alt='Logo' class='w-32 h-32 mx-auto' />
            </div>
            <nav>
                <ul>

                    <li class='mb-3'><a href='../index.php?page=qlsanpham'
                            class='flex items-center py-2 px-3 rounded transition duration-200 hover:bg-blue-700'>
                            <svg class='w-4 h-4 mr-2' fill='none' stroke='currentColor' viewBox='0 0 24 24'
                                xmlns='http://www.w3.org/2000/svg'>
                                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2'
                                    d='M12 8v4l3 3m6 0a9 9 0 11-18 0 9 9 0 0118 0z'></path>
                            </svg>
                            Sản phẩm
                        </a></li>
                    <li class='mb-3'><a href='../index.php?page=qlgiohang'
                            class='flex items-center py-2 px-3 rounded transition duration-200 hover:bg-blue-700'>
                            <svg class='w-4 h-4 mr-2' fill='none' stroke='currentColor' viewBox='0 0 24 24'
                                xmlns='http://www.w3.org/2000/svg'>
                                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2'
                                    d='M3 7h18M3 12h18M3 17h18'></path>
                            </svg>
                            Đơn hàng
                        </a></li>
                    <li class='mb-3'><a href='../index.php?page=qltaikhoan'
                            class='flex items-center py-2 px-3 rounded transition duration-200 hover:bg-blue-700'>
                            <svg class='w-4 h-4 mr-2' fill='none' stroke='currentColor' viewBox='0 0 24 24'
                                xmlns='http://www.w3.org/2000/svg'>
                                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M3 3v18h18'>
                                </path>
                            </svg>
                            Khách hàng
                        </a></li>
                    <li class='mb-3'><a href='../index.php?page=danhmuc'
                            class='flex items-center py-2 px-3 rounded transition duration-200 hover:bg-blue-700'>
                            <svg class='w-4 h-4 mr-2' fill='none' stroke='currentColor' viewBox='0 0 24 24'
                                xmlns='http://www.w3.org/2000/svg'>
                                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2'
                                    d='M8 7l4-4 4 4m0 6H8'></path>
                            </svg>
                            Danh mục
                        </a></li>
                    <li class='mb-3'>
                        <a href='../index.php?page=qlmau'
                            class='flex items-center py-2 px-3 rounded transition duration-200 hover:bg-blue-700'>
                            <svg class='w-4 h-4 mr-2' fill='none' stroke='currentColor' viewBox='0 0 24 24'
                                xmlns='http://www.w3.org/2000/svg'>
                                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2'
                                    d='M3 12l2 2 4-4 4 4 4-4 4 4'></path>
                            </svg>
                            Quản lý màu
                        </a>
                    </li>

                    <li class='mb-3'><a href='../index.php?page=qlsize'
                            class='flex items-center py-2 px-3 rounded transition duration-200 hover:bg-blue-700'>
                            <svg class='w-4 h-4 mr-2' fill='none' stroke='currentColor' viewBox='0 0 24 24'
                                xmlns='http://www.w3.org/2000/svg'>
                                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2'
                                    d='M11 11V7h2v4h4v2h-4v4h-2v-4H7v-2h4z'></path>
                            </svg>
                            Quản lý Size
                        </a></li>
                    <li class='mb-3'>
                        <a href='./functions/logout.php'
                            class='flex items-center py-2 px-3 rounded transition duration-200 hover:bg-red-700'>
                            <svg class='w-4 h-4 mr-2' fill='none' stroke='currentColor' viewBox='0 0 24 24'
                                xmlns='http://www.w3.org/2000/svg'>
                                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2'
                                    d='M17 11l4-4m0 0l-4-4m4 4H3'></path>
                            </svg>
                            Đăng xuất
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div>
            <p class='text-center text-sm'>&copy; 2024 Công ty ABC</p>
        </div>
    </div>
</form>
<div class='w-48 p-4 '></div>