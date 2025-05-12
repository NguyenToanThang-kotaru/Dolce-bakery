<?php
session_start();
include '../config.php';

$addressId = $_POST['id'];

$query = "SELECT * FROM customeraddress WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $addressId);
$stmt->execute();

$result = $stmt->get_result();
if($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode([
        "status" => "success",
        "data" => $row
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Không tìm thấy địa chỉ"
    ]);
}
?>