<?php
include 'config.php'; // Kết nối database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['account-name']);
    $password = trim($_POST['account-pass']);
    $email = trim($_POST['account-email']);
    $permission_id = isset($_POST['permission_id']) ? $_POST['permission_id'] : null;

    if (empty($username) || empty($password) || empty($email) || empty($permission_id)) {
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin!'); window.history.back();</script>";
        exit();
    }
    
    // Kiểm tra bằng RegEx
    // if (!preg_match("/^[a-zA-Z0-9_]+$/", $userName)) {
    //     // echo "Tên đăng nhập không hợp lệ!";
    //     exit();
    // }
    // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //     // echo "Email không hợp lệ!";
    //     exit();
    // }
    // if (!preg_match("/^.{8,}$/", $password)) {
    //     // echo "Mật khẩu không hợp lệ!";
    //     exit();
    // }

    

    // Thêm tài khoản vào bảng users với permission_id
    $stmt = $conn->prepare("INSERT INTO users (username, password, email, permission_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $username, $password, $email, $permission_id);
    $stmt->execute();
    $stmt->close();

    echo "<script>alert('Thêm tài khoản thành công!'); window.location.href = '../admin.php';</script>";
}
?>
