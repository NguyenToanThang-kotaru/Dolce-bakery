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

    if($result->num_rows > 0){
        $conn->query("DELETE FROM cart WHERE user_id = $user_id AND product_id = $product_id");
    } 

    echo "Sản phẩm đã được xóa khỏi giỏ hàng!";
?>