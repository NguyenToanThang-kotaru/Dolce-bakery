<?php
session_start();
include '../config.php';

// Lấy customer_id từ session
$customer_id = $_SESSION['userInfo']['userID']; 

// Cập nhật tất cả địa chỉ của customer_id thành default_id = 0
$query = "UPDATE customeraddress SET default_id = 0 WHERE customer_id = ? AND default_id = 1";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $customer_id);

if ($stmt->execute()) {
    echo json_encode(array("status" => "success", "message" => "Cập nhật địa chỉ mặc định thành công"));
} else {
    echo json_encode(array("status" => "error", "message" => "Cập nhật địa chỉ mặc định thất bại"));
}

$stmt->close();
$conn->close();
?>
