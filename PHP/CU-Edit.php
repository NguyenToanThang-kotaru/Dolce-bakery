<?php
ob_clean(); 
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config.php';
header('Content-Type: application/json');
$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['customer-id']; 
    $fullName = $_POST['customer-name'];
    $phoneNumber = $_POST['customer-phone'];
    $email = $_POST['customer-email'];
    $userName = $_POST['customer-uname'];
    $password = $_POST['customer-pass'];

    // Lấy trạng thái hiện tại của khách hàng từ database
    $sql_get_status = "SELECT status FROM customers WHERE id = ?";
    $stmt_get_status = $conn->prepare($sql_get_status);
    $stmt_get_status->bind_param("i", $id);
    $stmt_get_status->execute();
    $stmt_get_status->bind_result($current_status);
    $stmt_get_status->fetch();
    $stmt_get_status->close();
    $status = $current_status; 

    // Lấy thông tin địa chỉ chi tiết
    $sql_get_address = "SELECT c.addressDetail, p.name as province_name, d.name as district_name 
                       FROM customers c 
                       JOIN provinces p ON c.province_id = p.id 
                       JOIN districts d ON c.district_id = d.id 
                       WHERE c.id = ?";
    $stmt_get_address = $conn->prepare($sql_get_address);
    $stmt_get_address->bind_param("i", $id);
    $stmt_get_address->execute();
    $result = $stmt_get_address->get_result();
    $address_info = $result->fetch_assoc();
    $stmt_get_address->close();

    // Cập nhật database
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT); 
    $sql = "UPDATE customers SET userName = ?, email = ?, fullName = ?, phoneNumber = ?, password = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $userName, $email, $fullName, $phoneNumber, $hashedPassword, $id);

    if ($stmt->execute()) {
        $response = [
            "success" => true,
            "message" => "Cập nhật thông tin thành công!",
            "customer" => [
                "id" => $id,
                "fullName" => $fullName,
                "status" => $status,
                "addressDetail" => $address_info['addressDetail'],
                "province_name" => $address_info['province_name'],
                "district_name" => $address_info['district_name'],
                "phoneNumber" => $phoneNumber,
                "email" => $email,
                "userName" => $userName
            ]
        ];
    } else {
        $response = ["success" => false, "message" => "Lỗi cập nhật: " . $conn->error];
    }

    $stmt->close();
    $conn->close();

    // Trả về JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}
?>
