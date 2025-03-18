<?php
    include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['account-id']; 
    $usernName = $_POST['account-name'];
    $password = $_POST['account-pass'];
    $email = $_POST['account-email'];


    $sql = "UPDATE users SET userName = ?, password = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $usernName, $password, $email, $id);

    if ($stmt->execute()) {
        header("Location: ../HTML/admin/admin.php");
    } else {
        echo "Lỗi cập nhật: " . $conn->error;
    }

}
?>