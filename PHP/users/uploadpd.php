<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../PHP/config.php';

if (!isset($type)) {
    die("Lỗi: Không xác định loại sản phẩm.");
}
    
$sql = "SELECT * FROM products WHERE type = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $type);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='" . $type . "-product'>
                <div class='product-img'>
                    <div class='img-effect'><img src='" . $row['image'] . "' alt=''></div>
                </div>
                <div class='product-name'>" . $row['name'] . "</div>    
                <div class='product-end'>
                    <div class='price'>" . number_format($row['price'], 0, ',', '.') . " đ</div>
                    <div class='add-cart'><img src='../../assest/cart.png' alt=''></div>
                </div>
              </div>";
    }
} else {
    echo "<p style='text-align: center;'>Không có sản phẩm nào</p>";
}

$stmt->close();
$conn->close();
?>
