<?php
session_start();
include '../../PHP/config.php';
$userId = $_SESSION['userInfo']['userID'];
$sql = "SELECT ca.id, ca.addressDetail, ca.province_id, ca.district_id, p.name AS provinceName, d.name AS districtName
        FROM customeraddress ca
        JOIN provinces p ON ca.province_id = p.id
        JOIN districts d ON ca.district_id = d.id
        WHERE ca.customer_id = ? AND ca.default_id = 1
        LIMIT 1";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if ($data) {
    echo json_encode([
        "status" => "success",
        "data" => $data
    ]);
} else {
    echo json_encode([
        "status" => "fail",
        "message" => "Không tìm thấy địa chỉ mặc định"
    ]);
}

