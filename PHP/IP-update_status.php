<?php
include 'config.php';
header('Content-Type: application/json');

$import_id = $_POST['import_id'] ?? '';
$status = $_POST['status'] ?? '';

if (!$import_id || !in_array($status, ['1', '2'])) {
    echo json_encode(['success' => false, 'message' => 'Dữ liệu không hợp lệ!']);
    exit;
}

// Lấy trạng thái hiện tại
$stmt = $conn->prepare("SELECT status FROM importreceipts WHERE id = ?");
$stmt->bind_param('s', $import_id);
$stmt->execute();
$stmt->bind_result($current_status);
$stmt->fetch();
$stmt->close();

// Duyệt thành công thì tăng số lượng trong bảng products lên
if ($current_status == '1' && $status == '2') {
    // Lấy danh sách sản phẩm và số lượng trong phiếu nhập
    $sql = "SELECT product_id, quantity FROM importreceipt_detail WHERE importreceipt_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $import_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        // Tăng số lượng sản phẩm
        $update = $conn->prepare("UPDATE products SET quantity = quantity + ? WHERE id = ?");
        $update->bind_param('ii', $row['quantity'], $row['product_id']);
        $update->execute();
        $update->close();
    }
    $stmt->close();
}

// Cập nhật trạng thái phiếu nhập
$stmt = $conn->prepare("UPDATE importreceipts SET status = ? WHERE id = ?");
$stmt->bind_param('ss', $status, $import_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Cập nhật trạng thái thành công!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Cập nhật thất bại!']);
}

$stmt->close();
$conn->close(); 