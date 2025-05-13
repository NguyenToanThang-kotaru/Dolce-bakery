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
    $sql_get_address = "SELECT 
                            customers.*, 
                            provinces.name AS province_name, 
                            districts.name AS district_name,
                            customeraddress.addressDetail AS addressDetail
                        FROM customers
                        LEFT JOIN customeraddress ON customers.id = customeraddress.customer_id AND customeraddress.default_id = 1
                        LEFT JOIN provinces ON customeraddress.province_id = provinces.id
                        LEFT JOIN districts ON customeraddress.district_id = districts.id
                        WHERE customers.id = ?";
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
