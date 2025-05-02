<?php
include 'config.php';
header('Content-Type: application/json');

if (isset($_GET['subcategory_id']) && isset($_GET['supplier_id'])) {
    $subcategory_id = intval($_GET['subcategory_id']);
    $supplier_id = intval($_GET['supplier_id']);
    $sql = "SELECT p.id, p.pd_name, p.image, p.price, p.quantity FROM products p
            WHERE p.subcategory_id = ? AND p.supplier_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $subcategory_id, $supplier_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    echo json_encode(['success' => true, 'products' => $products]);
} else {
    echo json_encode(['success' => false, 'message' => 'Thiếu subcategory_id hoặc supplier_id']);
}
$conn->close(); 