<?php

// Tạo đối tượng Catagory
$catagory = new Catagory();

// Lấy danh sách tất cả các danh mục
$categories = $catagory->all();

// Xử lý thêm danh mục
if (isset($_POST['add_category'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $sql = "INSERT INTO categories (name, description) VALUES (?, ?)";
    $catagory->executeSQL($sql, [$name, $description]);
    header("Location: danhmuc.php");
    exit();
}

// Xử lý sửa danh mục
if (isset($_POST['edit_category'])) {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $sql = "UPDATE categories SET name = ?, description = ? WHERE catagory_id = ?";
    $catagory->executeSQL($sql, [$name, $description, $category_id]);
    header("Location: danhmuc.php");
    exit();
}

// Xử lý xóa danh mục
if (isset($_POST['delete_category'])) {
    $category_id = $_POST['category_id'];
    $sql = "DELETE FROM categories WHERE catagory_id = ?";
    $catagory->executeSQL($sql, [$category_id]);
    header("Location: danhmuc.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Danh Mục</title>
    <!-- Thêm Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class='flex '>
        <!-- Sidebar -->
        <?php include './views/navAdmin.php'; ?>
        <!-- Nội dung chính -->
        <div class='flex-1 p-4'>
            <div class="container mx-auto p-6">
                <h1 class="text-3xl font-bold text-center mb-6">Quản Lý Danh Mục</h1>

                <!-- Nút Thêm Danh Mục -->
                <button onclick="openModal('add')" class="bg-blue-500 text-white p-3 rounded-md mb-8">Thêm Danh
                    Mục</button>

                <!-- Hiển thị danh sách danh mục -->
                <h2 class="text-2xl font-semibold mb-4">Danh Sách Danh Mục</h2>
                <table class="w-full table-auto border-collapse bg-white rounded-lg shadow-lg">
                    <thead class="bg-blue-500 text-white">
                        <tr>
                            <th class="p-3 border">ID</th>
                            <th class="p-3 border">Tên Danh Mục</th>
                            <th class="p-3 border">Mô Tả</th>
                            <th class="p-3 border">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $row): ?>
                        <tr class="border-b">
                            <td class="p-3 text-center"><?php echo $row['catagory_id']; ?></td>
                            <td class="p-3"><?php echo $row['name']; ?></td>
                            <td class="p-3"><?php echo $row['description']; ?></td>
                            <td class="p-3 text-center">
                                <!-- Sửa -->
                                <button
                                    onclick="openModal('edit', <?php echo $row['catagory_id']; ?>, '<?php echo $row['name']; ?>', '<?php echo $row['description']; ?>')"
                                    class="bg-yellow-500 text-white p-2 rounded-md">Sửa</button>
                                <!-- Xóa -->
                                <button onclick="openDeleteModal(<?php echo $row['catagory_id']; ?>)"
                                    class="bg-red-500 text-white p-2 rounded-md">Xóa</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Modal Thêm / Sửa -->
            <div id="modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-6 rounded-lg w-96">
                    <h2 id="modal-title" class="text-2xl font-semibold mb-4">Thêm Danh Mục</h2>
                    <form id="modal-form" method="POST" action="danhmuc.php">
                        <input type="hidden" id="category_id" name="category_id">

                        <label for="name" class="block text-lg">Tên danh mục:</label>
                        <input type="text" id="name" name="name"
                            class="w-full p-3 border border-gray-300 rounded-md mb-4" required>

                        <label for="description" class="block text-lg">Mô tả:</label>
                        <textarea id="description" name="description"
                            class="w-full p-3 border border-gray-300 rounded-md mb-4"></textarea>

                        <button type="submit" id="modal-submit" name="add_category"
                            class="bg-blue-500 text-white p-3 rounded-md">
                            Thêm
                        </button>
                        <button type="button" onclick="closeModal()" class="bg-gray-500 text-white p-3 rounded-md ml-4">
                            Hủy
                        </button>
                    </form>
                </div>
            </div>

            <!-- Modal Xác Nhận Xóa -->
            <div id="confirm-modal"
                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-6 rounded-lg w-96">
                    <h2 class="text-2xl font-semibold mb-4">Xác nhận xóa</h2>
                    <p class="mb-4">Bạn có chắc chắn muốn xóa danh mục này?</p>
                    <form class="flex justify-evenly mt-4" id="confirm-form" method="POST" action="danhmuc.php">
                        <input type="hidden" id="delete-category-id" name="category_id">
                        <button type="submit" name="delete_category"
                            class="bg-red-500 text-white p-3 rounded-md">Xóa</button>
                        <button type="button" onclick="closeModal('confirm-modal')"
                            class="bg-gray-500 text-white p-3 rounded-md ml-4">
                            Hủy
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
    function openModal(action, id = null, name = '', description = '') {
        const modal = document.getElementById('modal');
        const title = document.getElementById('modal-title');
        const submitButton = document.getElementById('modal-submit');
        const categoryIdInput = document.getElementById('category_id');
        const nameInput = document.getElementById('name');
        const descriptionInput = document.getElementById('description');

        modal.classList.remove('hidden');

        if (action === 'add') {
            title.textContent = 'Thêm Danh Mục';
            submitButton.textContent = 'Thêm';
            submitButton.name = 'add_category';
            nameInput.value = '';
            descriptionInput.value = '';
        } else if (action === 'edit') {
            title.textContent = 'Sửa Danh Mục';
            submitButton.textContent = 'Cập Nhật';
            submitButton.name = 'edit_category';
            categoryIdInput.value = id;
            nameInput.value = name;
            descriptionInput.value = description;
        }
    }

    function openDeleteModal(id) {
        const confirmModal = document.getElementById('confirm-modal');
        const deleteCategoryIdInput = document.getElementById('delete-category-id');

        confirmModal.classList.remove('hidden');
        deleteCategoryIdInput.value = id;
    }

    function closeModal(modalId = 'modal') {
        document.getElementById(modalId).classList.add('hidden');
    }
    </script>
</body>

</html>