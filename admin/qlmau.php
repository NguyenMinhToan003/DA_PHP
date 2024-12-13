<?php


// Khởi tạo kết nối cơ sở dữ liệu
$db = new Db();

// Lấy danh sách các màu
$sql = "SELECT * FROM colors";
$result = $db->selectSQL($sql);

// Thêm màu
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $color_name = $_POST['color_name'];
    $color_code = $_POST['color_code'];

    $sql = "INSERT INTO colors (color_name, color_code) VALUES (?, ?)";
    $arrParam = [$color_name, $color_code];
    if ($db->insertSQL($sql, $arrParam)) {
        echo "<script>alert('Thêm màu thành công!'); window.location.href='qlmau.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi thêm màu!');</script>";
    }
}

// Sửa màu
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])) {
    $color_id = $_POST['color_id'];
    $color_name = $_POST['color_name'];
    $color_code = $_POST['color_code'];

    $sql = "UPDATE colors SET color_name = ?, color_code = ? WHERE color_id = ?";
    $arrParam = [$color_name, $color_code, $color_id];
    if ($db->updateSQL($sql, $arrParam)) {
        echo "<script>alert('Sửa màu thành công!'); window.location.href='qlmau.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi sửa màu!');</script>";
    }
}

// Xóa màu
if (isset($_GET['delete'])) {
    $color_id = $_GET['delete'];

    $sql = "DELETE FROM colors WHERE color_id = ?";
    $arrParam = [$color_id];
    if ($db->deleteSQL($sql, $arrParam)) {
        echo "<script>alert('Xóa màu thành công!'); window.location.href='qlmau.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi xóa màu!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Màu</title>
    <!-- Thêm Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans text-gray-800">
    <div class='flex '>
        <!-- Sidebar -->
        <?php include './views/navAdmin.php'; ?>
        <!-- Nội dung chính -->
        <div class='flex-1 p-4'>
            <div class="container mx-auto p-4">
                <h1 class="text-3xl font-bold text-center mb-6">Quản Lý Màu</h1>

                <!-- Thêm Màu -->
                <button onclick="openAddModal()" class="bg-blue-500 text-white p-3 rounded-md mb-8">Thêm Màu</button>

                <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="py-2 px-4 text-left">ID</th>
                            <th class="py-2 px-4 text-left">Tên Màu</th>
                            <th class="py-2 px-4 text-left">Mã Màu</th>
                            <th class="py-2 px-4 text-left">Màu</th>
                            <th class="py-2 px-4 text-left">Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result as $row) { ?>
                        <tr class="border-b">
                            <td class="py-2 px-4"><?php echo $row['color_id']; ?></td>
                            <td class="py-2 px-4"><?php echo $row['color_name']; ?></td>
                            <td class="py-2 px-4"><?php echo $row['color_code']; ?></td>
                            <td class="py-2 px-4">
                                <div class="w-8 h-8 rounded-full border-4 bg-<?php echo $row['color_code']; ?>">
                                    <?php
                            echo "";
                            ?>
                                </div>
                            </td>
                            </td>
                            <td class="py-2 px-4">
                                <button
                                    onclick="openEditModal(<?php echo $row['color_id']; ?>, '<?php echo $row['color_name']; ?>', '<?php echo $row['color_code']; ?>')"
                                    class="bg-yellow-500 text-white p-2 rounded-md">Sửa</button>
                                <button onclick="confirmDelete(<?php echo $row['color_id']; ?>)"
                                    class="bg-red-500 text-white p-2 rounded-md">Xóa</button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <!-- Modal Thêm/Sửa -->
                <div id="modal" class="fixed inset-0 flex justify-center items-center bg-gray-800 bg-opacity-50 hidden">
                    <div class="bg-white p-6 rounded-lg w-96">
                        <h2 class="text-2xl font-semibold mb-4" id="modalTitle">Thêm Màu</h2>
                        <form id="colorForm" method="POST" action="" class="space-y-4">
                            <input type="hidden" name="color_id" id="color_id">
                            <div>
                                <label for="color_name" class="block text-sm font-medium text-gray-700">Tên Màu</label>
                                <input type="text" name="color_name" id="color_name" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label for="color_code" class="block text-sm font-medium text-gray-700">Mã Màu</label>
                                <input type="text" name="color_code" id="color_code" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md">
                            </div>
                            <div class="flex justify-evenly mt-4">
                                <button type="submit" name="add" id="submitBtn"
                                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700">Thêm</button>
                                <button type="button" onclick="closeModal()"
                                    class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-700">Đóng</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Modal Xác Nhận Xóa -->
                <div id="deleteModal"
                    class="fixed inset-0 flex justify-center items-center bg-gray-800 bg-opacity-50 hidden">
                    <div class="bg-white p-6 rounded-lg w-96">
                        <h2 class="text-xl font-semibold mb-4">Xác Nhận Xóa</h2>
                        <p>Bạn có chắc muốn xóa màu này không?</p>
                        <div class="flex justify-evenly mt-4">
                            <button id="confirmDeleteBtn"
                                class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-700">Xóa</button>
                            <button onclick="closeDeleteModal()"
                                class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-700">Hủy</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Open Add Modal
    function openAddModal() {
        document.getElementById('modal').classList.remove('hidden');
        document.getElementById('modalTitle').innerText = 'Thêm Màu';
        document.getElementById('submitBtn').name = 'add';
        document.getElementById('colorForm').reset();
    }

    // Open Edit Modal with existing data
    function openEditModal(id, name, code) {
        document.getElementById('modal').classList.remove('hidden');
        document.getElementById('modalTitle').innerText = 'Sửa Màu';
        document.getElementById('submitBtn').name = 'edit';
        document.getElementById('color_id').value = id;
        document.getElementById('color_name').value = name;
        document.getElementById('color_code').value = code;
    }

    // Close Modal
    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
    }

    // Open Delete Confirmation Modal
    function confirmDelete(color_id) {
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('confirmDeleteBtn').onclick = function() {
            deleteColor(color_id);
        };
    }

    // Close Delete Confirmation Modal
    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    // Delete Color
    function deleteColor(color_id) {
        window.location.href = '?delete=' + color_id;
    }
    </script>
</body>

</html>