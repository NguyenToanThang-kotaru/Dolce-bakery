<?php
include 'config.php';
header('Content-Type: application/json');

if (isset($_GET['category_id']) && isset($_GET['supplier_id'])) {
    $category_id = intval($_GET['category_id']);
    $supplier_id = intval($_GET['supplier_id']);
    $sql = "SELECT DISTINCT sc.id, sc.name FROM subcategories sc
            JOIN products p ON sc.id = p.subcategory_id
            WHERE sc.category_id = ? AND p.supplier_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $category_id, $supplier_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $subcategories = [];
    while ($row = $result->fetch_assoc()) {
        $subcategories[] = $row;
    }
    echo json_encode(['success' => true, 'subcategories' => $subcategories]);
} else {
    echo json_encode(['success' => false, 'message' => 'Thiếu category_id hoặc supplier_id']);
}
$conn->close(); 