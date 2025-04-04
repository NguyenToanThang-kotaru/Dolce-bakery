<?php
    include '../config.php';
    session_start();

    if(!isset($_SESSION['userInfo']))
    {
        echo "Bạn cần đăng nhập";
        exit();
    }

    $user_id = $_SESSION['userInfo']['userID'];
    $product_id = $_POST['product_id'];

    $sql = "SELECT * FROM cart WHERE user_id = $user_id AND product_id = $product_id";
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $current_quantity = $row['quantity'];

        if ($current_quantity > 1) {
            $conn->query("UPDATE cart SET quantity = quantity - 1 WHERE user_id = $user_id AND product_id = $product_id");
            echo "Giảm số lượng sản phẩm thành công!";
        } else {
            $conn->query("DELETE FROM cart WHERE user_id = $user_id AND product_id = $product_id");
            echo "Sản phẩm đã được xóa khỏi giỏ hàng!";
        }
    } else {
        echo "Sản phẩm không có trong giỏ hàng!";
    }
?>