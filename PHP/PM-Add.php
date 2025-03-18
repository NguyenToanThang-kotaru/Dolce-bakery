<?php
require_once 'PM-Manager.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role_name = trim($_POST['role-name']);
    $functions = isset($_POST['permissions']) ? $_POST['permissions'] : []; 

    if (empty($role_name)) {
        echo "<script>alert('Vui lòng nhập tên quyền!'); window.history.back();</script>";
        exit();
    }

    // Thêm quyền vào bảng permissions
    $stmt = $conn->prepare("INSERT INTO permissions (name) VALUES (?)");
    $stmt->bind_param("s", $role_name);
    $stmt->execute();
    $permission_id = $stmt->insert_id;
    $stmt->close();

    // Thêm vào bảng permission_function nếu có chọn chức năng
    if (!empty($functions)) {
        $stmt = $conn->prepare("INSERT INTO permission_function (permission_id, function_id) VALUES (?, ?)");
        foreach ($functions as $function_id) {
            $stmt->bind_param("ii", $permission_id, $function_id);
            $stmt->execute();
        }
        $stmt->close();
    }

    echo "<script>alert('Thêm quyền thành công!'); window.location.href = '../admin.php';</script>";

}
?>



