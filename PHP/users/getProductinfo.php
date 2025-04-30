<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json; charset=UTF-8');

include '../../PHP/config.php';

if (!isset($_GET['pd_name']) || empty($_GET['pd_name'])) {
    echo json_encode(["error" => "Thiếu tên sản phẩm"], JSON_UNESCAPED_UNICODE);
    exit;
}

$productName = $_GET['pd_name'];
$sql = "SELECT pd_name, price, image FROM products WHERE pd_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $productName);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode($row, JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(["error" => "Không tìm thấy sản phẩm"], JSON_UNESCAPED_UNICODE);
}

$stmt->close();
$conn->close();
?>
