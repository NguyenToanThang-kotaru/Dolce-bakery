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
        $conn->query("UPDATE cart SET quantity = quantity + 1 WHERE user_id = $user_id AND product_id = $product_id");
    } else {
        $conn->query("INSERT INTO cart (user_id, product_id, quantity) VALUES ($user_id, $product_id, 1)");
    }
    
    // echo "Thêm vào giỏ hàng thành công!";
    $total_sql = "SELECT SUM(quantity) AS total FROM cart WHERE user_id = $user_id";
    $total_result = $conn->query($total_sql);
    $row = $total_result->fetch_assoc();

    echo $row['total']; // gửi về số lượng để JS hiển thị
?>