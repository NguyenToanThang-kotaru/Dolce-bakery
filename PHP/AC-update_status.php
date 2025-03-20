<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $status = isset($_POST['status']) ? intval($_POST['status']) : 0;

    if ($id <= 0 || ($status != 1 && $status != 2)) {
        echo "Lỗi: Dữ liệu không hợp lệ!";
        exit();
    }

    $stmt = $conn->prepare("UPDATE users SET status = ? WHERE id = ?");
    if (!$stmt) {
        echo "Lỗi chuẩn bị truy vấn: " . $conn->error;
        exit();
    }

    $stmt->bind_param("ii", $status, $id);
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Lỗi khi cập nhật: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Lỗi: Chỉ chấp nhận phương thức POST!";
}
?>

