<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../PHP/config.php';
$query = "SELECT * FROM products";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo '<div class="product-container">';
    while ($row = $result->fetch_assoc()) {
        echo '
            "<div class="product-item">
                <div class="product-img">
                    <img class="img-effect" src="../assets/images/' . (!empty($row['image']) ? $row['image'] : 'default.png') . '" alt="' . htmlspecialchars($row['name']) . '">
                </div>
                <div class="product-name">' . htmlspecialchars($row['name']) . '</div>
                <div class="product-end">
                    <div class="price">' . number_format($row['price'], 0, ',', '.') . ' đ</div>
                    <div class="add-cart">
                        <img src="../assets/cart.png" alt="Add to cart">
                    </div>
                </div>
            </div>
        ';
    }
    echo '</div>';
} else {
    echo '<p>Không có sản phẩm nào.</p>';
}

$conn->close(); // Đóng kết nối
?>