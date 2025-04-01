<?php
include 'config.php';

$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['customer-id']; 
    $fullName = $_POST['customer-name'];
    $phoneNumber = $_POST['customer-phone'];
    $email = $_POST['customer-email'];
    $address = $_POST['customer-address'];
    $userName = $_POST['customer-uname'];
    $password = $_POST['customer-pass'];
    $status = 1;

    
    // Cập nhật database
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT); 
    $sql = "UPDATE customers SET userName = ?, email = ?, fullName = ?, address = ?, phoneNumber = ?, password = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi",$userName, $email, $fullName, $address, $phoneNumber, $hashedPassword, $id);


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
                "email" => $email,
                "password" => $password,
                "userName" => $userName
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
