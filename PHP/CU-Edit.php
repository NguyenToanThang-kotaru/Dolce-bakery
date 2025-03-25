<?php
include 'config.php';

$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['customer-id']; 
    $fullName = $_POST['customer-name'];
    $phoneNumber = $_POST['customer-phone'];
    $email = $_POST['customer-email'];
    $address = $_POST['customer-address'];
    $status = 1;

    
    // Cập nhật database
    $sql = "UPDATE customers SET email = ?, fullName = ?, address = ?, phoneNumber = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $email, $fullName, $address, $phoneNumber, $id);


    if ($stmt->execute()) {
        $response = [
            "success" => true,
            "message" => "Cập nhật sản phẩm thành công!",
            "customer" => [
                "id" => $id,
                "fullName" => $fullName,
                "status" => $status,
                "address" => $address,
                "phoneNumber" => $phoneNumber,
                "email" => $email
            ]
        ];
    } else {
        $response = ["success" => false, "message" => "Lỗi cập nhật: " . $conn->error];
    }

    $stmt->close();
    $conn->close();

    // Trả về JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}
?>
