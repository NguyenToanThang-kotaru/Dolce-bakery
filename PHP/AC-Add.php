<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Kiểm tra xem các trường có tồn tại trong mảng $_POST hay không
    $userName = isset($_POST['account-name']) ? $_POST['account-name'] : null;
    $password = isset($_POST['account-pass']) ? $_POST['account-pass'] : null;
    $email = isset($_POST['account-email']) ? $_POST['account-email'] : null;
   

    // Kiểm tra bằng RegEx
    if (!preg_match("/^[a-zA-Z0-9_]+$/", $userName)) {
        // echo "Tên đăng nhập không hợp lệ!";
        exit();
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // echo "Email không hợp lệ!";
        exit();
    }
    if (!preg_match("/^.{8,}$/", $password)) {
        // echo "Mật khẩu không hợp lệ!";
        exit();
    }

    // Thực hiện câu lệnh SQL để thêm sản phẩm vào cơ sở dữ liệu
    $sql = "INSERT INTO users (userName, password, email) VALUES ('$userName', '$password', '$email')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../HTML/admin/admin.php");
        echo "AC đã được thêm thành công!";
        exit();

    } else {
        echo "Lỗi: " . $conn->error;
    }

    // Đóng kết nối
    $conn->close();
}
?>
