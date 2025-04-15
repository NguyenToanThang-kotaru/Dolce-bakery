<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json; charset=UTF-8');

include '../../PHP/config.php';

if (!isset($_GET['query']) || empty($_GET['query'])) {
    echo json_encode(["error" => "Thiếu query"], JSON_UNESCAPED_UNICODE);
    exit;
}

$keyword = "%" . $_GET['query'] . "%";
$sql = "SELECT pd_name FROM products WHERE pd_name LIKE ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $keyword);
$stmt->execute();
$result = $stmt->get_result();

$suggestions = [];
while ($row = $result->fetch_assoc()) {
    $suggestions[] = $row['pd_name'];
}   

$stmt->close();
$conn->close();

echo json_encode($suggestions, JSON_UNESCAPED_UNICODE);

?>

 
