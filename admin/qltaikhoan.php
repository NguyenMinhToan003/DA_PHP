<?php
    include '../views/navAdmin.php';
    require_once '../class/Db.php';

    $db = new Db();

    // Lấy danh sách tài khoản từ bảng `users`
    $sql = "SELECT u.user_id, u.email, u.username, u.address, r.role_name 
            FROM users u 
            INNER JOIN role r ON u.role_id = r.role_id";
    $users = $db->selectSQL($sql);
?>

<div class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-bold text-center text-gray-700">Quản lý tài khoản</h1>
        <div class="overflow-x-auto mt-6">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 text-left border-b border-gray-200 text-gray-600">ID</th>
                        <th class="py-2 px-4 text-left border-b border-gray-200 text-gray-600">Email</th>
                        <th class="py-2 px-4 text-left border-b border-gray-200 text-gray-600">Tên đăng nhập</th>
                        <th class="py-2 px-4 text-left border-b border-gray-200 text-gray-600">Địa chỉ</th>
                        <th class="py-2 px-4 text-left border-b border-gray-200 text-gray-600">Vai trò</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)) : ?>
                    <?php foreach ($users as $user) : ?>
                    <tr class="hover:bg-gray-50">
                        <td class="py-2 px-4 border-b border-gray-200"><?= htmlspecialchars($user['user_id']); ?>
                        </td>
                        <td class="py-2 px-4 border-b border-gray-200"><?= htmlspecialchars($user['email']); ?></td>
                        <td class="py-2 px-4 border-b border-gray-200"><?= htmlspecialchars($user['username']); ?>
                        </td>
                        <td class="py-2 px-4 border-b border-gray-200"><?= htmlspecialchars($user['address']); ?>
                        </td>
                        <td class="py-2 px-4 border-b border-gray-200"><?= htmlspecialchars($user['role_name']); ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else : ?>
                    <tr>
                        <td colspan="5" class="py-4 px-4 text-center text-gray-600">Không có tài khoản nào!</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>