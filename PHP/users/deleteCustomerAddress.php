<?php
session_start();
include '../config.php';

$customer_id = $_SESSION['userInfo']['userID'];

if (isset($_POST['id'])) {
    $address_id = (int) $_POST['id'];

    $query = "DELETE FROM customeraddress WHERE id = ? AND customer_id = ?";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("ii", $address_id, $customer_id);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Địa chỉ đã được xóa thành công."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Lỗi khi xóa địa chỉ."]);
        }

        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Lỗi khi chuẩn bị câu lệnh SQL."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Không có ID địa chỉ được cung cấp."]);
}

$conn->close();
?>
