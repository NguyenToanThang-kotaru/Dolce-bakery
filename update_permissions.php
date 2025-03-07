<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_POST['userId'];
    $permissions = $_POST['permissions']; // Mảng quyền đã chọn

    // Cập nhật database (ví dụ MySQL)
    $conn = new mysqli("localhost", "root", "", "dolce_db");
    if ($conn->connect_error) {
        die("Lỗi kết nối: " . $conn->connect_error);
    }

    // Xóa quyền cũ của người dùng
    $conn->query("DELETE FROM user_permissions WHERE user_id = $userId");

    // Chèn quyền mới
    foreach ($permissions as $perm) {
        $conn->query("INSERT INTO user_permissions (user_id, permission_id) VALUES ($userId, '$perm')");
    }

    echo "Cập nhật thành công cho user ID: $userId";
}
?>