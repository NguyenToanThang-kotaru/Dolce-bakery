<?php
require_once 'config.php';

$response = [];

if (isset($_POST['account-id']) && isset($_POST['account-name'])) {
    $accountId = $_POST['account-id'];
    $userName = $_POST['account-name'];
    $password = $_POST['account-pass'];
    $email = $_POST['account-email'];
    $permissionId = $_POST['permission_id']; 

    // Cập nhật thông tin tài khoản
    $sql = "UPDATE users SET username = ?, email = ?, password = ?, permission_id = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssii", $userName, $email, $password, $permissionId, $accountId);


    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['error'] = "Không thể cập nhật tài khoản!";
    }

    // Đóng statement
    $stmt->close();
} else {
    $response['error'] = "Dữ liệu không hợp lệ!";
}

echo json_encode($response);
?>
