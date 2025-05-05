<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../PHP/config.php';
$query = 'SELECT * FROM products';
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="product-item">
        <div class="product-img">
            <div class="img-effect">
                <img src="' . $row['image'] . '" alt="">
                <div class="product-quantity">Còn lại: ' . $row['quantity'] . ' sản phẩm</div>
            </div>
        </div>
        <div class="product-name">' . $row['pd_name'] . '</div>   
        <div class="product-end">
            <div class="price">' . number_format($row['price'], 0, ',', '.') . ' đ</div>
            <div class="add-cartmain" onclick="addToCart(\'' . $row['id'] . '\')"><img src="../../assest/cart.png" alt=""></div>
        </div>
    </div>';

    }
} else {
    echo "<p style='text-align: center;'>Không có sản phẩm nào</p>";
}

$conn->close();
// Đóng kết nối
?>