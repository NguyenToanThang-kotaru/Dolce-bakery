<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ép kiểu về số nguyên 
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {           
        header("Location: ../HTML/admin/admin.php");
        exit(); 
    } else {
        echo "Lỗi: " . $stmt->error; 
    }

    $stmt->close();
}

$conn->close();
?>
