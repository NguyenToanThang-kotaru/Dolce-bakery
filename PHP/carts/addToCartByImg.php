<?php
    include '../config.php';
    session_start();

    if(!isset($_SESSION['userInfo']))
    {
        echo "Bạn cần đăng nhập";
        exit();
    }

    $user_id = $_SESSION['userInfo']['userID'];
    $email = $_SESSION['userInfo']['email'];
    $image_url = $_POST['image_url'];

    $sqlImg = "SELECT id FROM products WHERE image = ?";
    $stmt = $conn->prepare($sqlImg);
    $stmt->bind_param("s", $image_url);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        echo $row["id"];
    }
    else echo "not_found";
?>