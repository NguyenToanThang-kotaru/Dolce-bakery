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
    $product_id = $_POST['product_id'];
    $quantityCheck = $_POST['quantityCheck'];
    $quantity = $_POST['quantity'];
    // Lấy thông tin số lượng sản phẩm còn lại trong kho
    $product_sql = "SELECT COUNT(*) AS quantity
FROM inventory
WHERE product_id = $product_id AND is_deleted = 0;";
    $product_result = $conn->query($product_sql);
    $product_row = $product_result->fetch_assoc();

    // Nếu không tìm thấy sản phẩm hoặc số lượng yêu cầu vượt quá kho
    if (!$product_row || $product_row['quantity'] <= $quantityCheck) {
        echo "Số lượng sản phẩm vượt quá số lượng có sẵn trong kho!";
        exit();
    }

    // Kiểm tra giỏ hàng của người dùng
    $sql = "SELECT * FROM cart WHERE user_id = $user_id AND product_id = $product_id";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $conn->query("UPDATE cart SET quantity = quantity + $quantity WHERE user_id = $user_id AND product_id = $product_id");
    } else {
        $conn->query("INSERT INTO cart (user_id, product_id, quantity) VALUES ($user_id, $product_id, $quantity)");
    }

    // Tính lại tổng số lượng trong giỏ hàng
    $total_sql = "SELECT SUM(quantity) AS total FROM cart WHERE user_id = $user_id";
    $total_result = $conn->query($total_sql);
    $row = $total_result->fetch_assoc();

    echo $row['total']; // gửi về số lượng để JS hiển thị
?>