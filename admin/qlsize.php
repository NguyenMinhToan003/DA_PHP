<?php

$db = new Db();

// Lấy danh sách các kích cỡ
$sql = "SELECT * FROM sizes";
$result = $db->selectSQL($sql);

// Thêm kích cỡ
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $size_name = $_POST['size_name'];
    $size_code = $_POST['size_code'];

    $sql = "INSERT INTO sizes (size_name, size_code) VALUES (?, ?)";
    $arrParam = [$size_name, $size_code];
    if ($db->insertSQL($sql, $arrParam)) {
        echo "<script>alert('Thêm kích cỡ thành công!'); window.location.href='qlsize.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi thêm kích cỡ!');</script>";
    }
}

// Sửa kích cỡ
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])) {
    $size_id = $_POST['size_id'];
    $size_name = $_POST['size_name'];
    $size_code = $_POST['size_code'];

    $sql = "UPDATE sizes SET size_name = ?, size_code = ? WHERE size_id = ?";
    $arrParam = [$size_name, $size_code, $size_id];
    if ($db->updateSQL($sql, $arrParam)) {
        echo "<script>alert('Sửa kích cỡ thành công!'); window.location.href='qlsize.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi sửa kích cỡ!');</script>";
    }
}

// Xóa kích cỡ
if (isset($_GET['delete'])) {
    $size_id = $_GET['delete'];

    $sql = "DELETE FROM sizes WHERE size_id = ?";
    $arrParam = [$size_id];
    if ($db->deleteSQL($sql, $arrParam)) {
        echo "<script>alert('Xóa kích cỡ thành công!'); window.location.href='qlsize.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi xóa kích cỡ!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Kích Cỡ</title>
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
                <h1 class="text-3xl font-bold text-center mb-6">Quản Lý Kích Cỡ</h1>

                <!-- Thêm Kích Cỡ -->
                <button onclick="openAddModal()" class="bg-blue-500 text-white p-3 rounded-md mb-8">Thêm Kích
                    Cỡ</button>
                <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="py-2 px-4 text-left">ID</th>
                            <th class="py-2 px-4 text-left">Tên Kích Cỡ</th>
                            <th class="py-2 px-4 text-left">Mã Kích Cỡ</th>
                            <th class="py-2 px-4 text-left">Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result as $row) { ?>
                        <tr class="border-b">
                            <td class="py-2 px-4"><?php echo $row['size_id']; ?></td>
                            <td class="py-2 px-4"><?php echo $row['size_name']; ?></td>
                            <td class="py-2 px-4"><?php echo $row['size_code']; ?></td>
                            <td class="py-2 px-4">
                                <button
                                    onclick="openEditModal(<?php echo $row['size_id']; ?>, '<?php echo $row['size_name']; ?>', '<?php echo $row['size_code']; ?>')"
                                    class="bg-yellow-500 text-white p-2 rounded-md">Sửa</button>
                                <button onclick="confirmDelete(<?php echo $row['size_id']; ?>)"
                                    class="bg-red-500 text-white p-2 rounded-md">Xóa</button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <!-- Modal Thêm/Sửa -->
                <div id="modal" class="fixed inset-0 flex justify-center items-center bg-gray-800 bg-opacity-50 hidden">
                    <div class="bg-white p-6 rounded-lg w-96">
                        <h2 class="text-2xl font-semibold mb-4" id="modalTitle">Thêm Kích Cỡ</h2>
                        <form id="sizeForm" method="POST" action="" class="space-y-4">
                            <input type="hidden" name="size_id" id="size_id">
                            <div>
                                <label for="size_name" class="block text-sm font-medium text-gray-700">Tên Kích
                                    Cỡ</label>
                                <input type="text" name="size_name" id="size_name" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label for="size_code" class="block text-sm font-medium text-gray-700">Mã Kích
                                    Cỡ</label>
                                <input type="text" name="size_code" id="size_code" required
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
                        <p>Bạn có chắc muốn xóa kích cỡ này không?</p>
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
        document.getElementById('modalTitle').innerText = 'Thêm Kích Cỡ';
        document.getElementById('submitBtn').name = 'add';
        document.getElementById('sizeForm').reset();
    }

    // Open Edit Modal with existing data
    function openEditModal(id, name, code) {
        document.getElementById('modal').classList.remove('hidden');
        document.getElementById('modalTitle').innerText = 'Sửa Kích Cỡ';
        document.getElementById('submitBtn').name = 'edit';
        document.getElementById('size_id').value = id;
        document.getElementById('size_name').value = name;
        document.getElementById('size_code').value = code;
    }

    // Close Modal
    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
    }

    // Open Delete Confirmation Modal
    function confirmDelete(size_id) {
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('confirmDeleteBtn').onclick = function() {
            deleteSize(size_id);
        };
    }

    // Close Delete Confirmation Modal
    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    // Delete Size
    function deleteSize(size_id) {
        window.location.href = '?delete=' + size_id;
    }
    </script>
</body>

</html>