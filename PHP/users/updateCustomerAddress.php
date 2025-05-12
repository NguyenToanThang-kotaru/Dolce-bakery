<?php
include '../config.php';
session_start();

$id = $_POST['id'];
$addressDetail = $_POST['addressDetail'];
$province_id = $_POST['province_id'];
$district_id = $_POST['district_id'];
$default_id = $_POST['default_id'];

$query = "UPDATE customeraddress 
          SET addressDetail = ?, province_id = ?, district_id = ?, default_id = ? 
          WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssiii", $addressDetail, $province_id, $district_id, $default_id, $id);

if ($stmt->execute()) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => $stmt->error]);
}
$stmt->close();
$conn->close();
?>
