<?php
session_start();
include '../config.php';

$customer_id = $_SESSION['userInfo']['userID']; 

$addressDetail = $_POST['addressDetail'];
$district_id = $_POST['district_id'];
$province_id = $_POST['province_id'];
$default_id = $_POST['default_id'];  

if ($default_id == 1) {
    $updateQuery = "UPDATE customeraddress SET default_id = 0 WHERE customer_id = ? AND default_id = 1";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("i", $customer_id);
    $updateStmt->execute();
    $updateStmt->close();
}

$query = "INSERT INTO customeraddress (customer_id, addressDetail, district_id, province_id, default_id)
          VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("issii", $customer_id, $addressDetail, $district_id, $province_id, $default_id);

if ($stmt->execute()) {
    echo json_encode(array("status" => "success", "message" => "Thêm địa chỉ thành công"));
} else {
    echo json_encode(array("status" => "error", "message" => "Thêm địa chỉ thất bại"));
}

$stmt->close();
$conn->close();
?>
