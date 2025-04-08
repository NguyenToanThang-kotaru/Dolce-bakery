<?php
    include '../config.php';
    session_start();
    if(!isset($_SESSION['userInfo'])){
        echo json_encode(['status' => 'error']);
        exit();
    }

    $userID = $_SESSION['userInfo']['userID'];
    $sql = "SELECT products.id, products.image, products.name, products.price, cart.quantity 
            FROM cart 
            JOIN products ON cart.product_id = products.id
            WHERE cart.user_id = $userID";
    
    $result = $conn->query($sql);
    $cart = [];

    while($row = $result->fetch_assoc()){
        $cart[] = $row;
    }

    echo json_encode($cart);
?>