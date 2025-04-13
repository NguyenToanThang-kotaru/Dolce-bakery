<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config.php'; // Kết nối database
header('Content-Type: application/json');
$response = []; // Mảng chứa phản hồi

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['account-name'] ?? '');
    $password = trim($_POST['account-pass'] ?? '');
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

    // Lấy trạng thái hiện tại và tên nhân viên
    $sql_get_status = "
    SELECT ea.status, e.fullName 
    FROM employeeaccount ea 
    JOIN employees e ON ea.userName = e.id 
    WHERE ea.id = ?
    ";
    $stmt_get_status = $conn->prepare($sql_get_status);
    $stmt_get_status->bind_param("i", $accountId);
    $stmt_get_status->execute();
    $stmt_get_status->bind_result($current_status, $fullName);
    $stmt_get_status->fetch();
    $stmt_get_status->close();
    $status = $current_status;

    // 🔹 Thêm tài khoản vào bảng
    $hasshedPassword = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $conn->prepare("INSERT INTO employeeaccount (userName, password, permission_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $username, $hasshedPassword, $permission_id);

    if ($stmt->execute()) {
        $response = [
            "success" => true,
            "message" => "Thêm tài khoản thành công!",
            "account" => [
                "id" => $conn->insert_id,
                "username" => $username,
                "hasshedPassword" => $hasshedPassword,
                "permission_id" => $permission_id,
                "permission_name" => $permission_name,
                "fullName" => $fullName,
                "status" => $status
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
