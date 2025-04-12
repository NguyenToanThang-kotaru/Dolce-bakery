<?php
include '../config.php';
session_start();
$user_id = $_SESSION['userInfo']['userID'];
$userName = $_POST['userName'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$note = $_POST['note'];
$paymentDate = date('Y-m-d', strtotime($_POST['paymentDate']));
$paymentMethod = $_POST['paymentMethod'];
$totalAmount = $_POST['totalAmount'];
$orderItems = $_POST['orderItems'];

$insertQuery = "INSERT INTO paid_orders (userName, phoneNumber, email, address, orderDate, orderItem, totalAmount, notes, paymentMethod) 
                VALUES ('$userName', '$phone', '$email', '$address', '$paymentDate', '$orderItems', '$totalAmount', '$note', '$paymentMethod')";

if ($conn->query($insertQuery) === TRUE) {
    // Xoá giỏ hàng của người dùng sau khi thanh toán
    $deleteCart = "DELETE FROM cart WHERE user_id = '$user_id'";
    $conn->query($deleteCart);

    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => $conn->error]);
}

$conn->close();
?>
