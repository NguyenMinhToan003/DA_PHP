<?php 

$user = new User();
$users = $user->getAllUsers(); // Lấy dữ liệu người dùng

// Kiểm tra xem có yêu cầu xóa người dùng không
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user_id'])) {
    $delete_user_id = (int) $_POST['delete_user_id'];
    
    // Xóa người dùng
    if ($user->deleteUser($delete_user_id)) {
        header('Location: qltaikhoan.php'); // Chuyển hướng lại trang sau khi xóa
        exit;
    } else {
        echo "Có lỗi khi xóa người dùng.";
    }
}
?>
<div class='flex '>
    <!-- Sidebar -->
    <?php include './views/navAdmin.php'; ?>
    <!-- Nội dung chính -->
    <div class='flex-1 p-4'>
        <div class="container mx-auto p-4">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-2">
                    <label for="roleFilter" class="text-gray-700 font-medium">Phân loại:</label>
                    <select id="roleFilter"
                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                        <option value="">Tất cả</option>
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                    </select>
                </div>
            </div>


            <div class="overflow-x-auto bg-white shadow-md rounded">
                <table class="min-w-full text-sm text-left text-gray-500">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Username</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Address</th>
                            <th class="px-4 py-2">Role Name</th>
                            <th class="px-4 py-2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users)): ?>
                        <?php foreach ($users as $user): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2"><?= htmlspecialchars($user['user_id']) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($user['username']) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($user['email']) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($user['address']) ?></td>
                            <td class="px-4 py-2">
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                    <?= htmlspecialchars($user['role_name']) ?>
                                </span>
                            </td>
                            <td class="px-4 py-2">
                                <?php 
                        // Chỉ hiển thị nút xóa với người dùng có role là 'User'
                        if ($user['role_name'] == 'USER'):  
                        ?>
                                <form action="qltaikhoan.php" method="POST"
                                    onsubmit="return confirm('Bạn có chắc muốn xóa người dùng này?')">
                                    <input type="hidden" name="delete_user_id" value="<?= $user['user_id'] ?>">
                                    <button type="submit" class="text-red-500 hover:underline">Xóa</button>
                                </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center px-4 py-2">Không có dữ liệu</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('roleFilter').addEventListener('change', function() {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');

    rows.forEach(row => {
        const role = row.querySelector('td:nth-child(5)').textContent.toLowerCase();
        if (filter === "" || role.includes(filter)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
</script>