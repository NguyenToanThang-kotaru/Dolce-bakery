<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config.php'; // Kết nối database
header('Content-Type: application/json');
$response = []; // Mảng chứa phản hồi

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['account-name'] ?? '');
    $password = trim($_POST['account-pass'] ?? '');
    $email = trim($_POST['account-email'] ?? '');
    $permission_id = $_POST['permission_id'] ?? null;
    $permission_name = null;

    //Lấy tên quyền
    $sql = "SELECT name FROM permissions WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $permission_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $permission_name = $row["name"];
    }

    $stmt->close();

    // 🔹 Thêm tài khoản vào bảng users
    $hasshedPassword = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $conn->prepare("INSERT INTO users (userName, password, email, permission_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $username, $hasshedPassword, $email, $permission_id);

    if ($stmt->execute()) {
        $response = [
            "success" => true,
            "message" => "Thêm tài khoản thành công!",
            "account" => [
                "id" => $conn->insert_id,
                "username" => $username,
                "hasshedPassword" => $hasshedPassword,
                "email" => $email,
                "permission_id" => $permission_id,
                "permission_name" => $permission_name  
            ]
        ];
    } else {
        $response = ["success" => false, "message" => "Lỗi: " . $conn->error];
    }

    $stmt->close();
    $conn->close();
    echo json_encode($response);
    exit();
}
?>
