<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/html; charset=UTF-8');

include '../../PHP/config.php';

// Nhận dữ liệu từ AJAX
$category = $_POST['category'];
$keyword = "%" . $_POST['keyword'] . "%";
$type = $_POST['type'];
$minPrice = $_POST['min'];
$maxPrice = $_POST['max'];

// Tạo câu truy vấn cơ bản JOIN với categories
$sql = "SELECT p.pd_name, p.image, p.price 
        FROM products p 
        JOIN categories c ON p.category_id = c.id 
        WHERE p.pd_name LIKE ? 
          AND p.price BETWEEN ? AND ?";

// Chuẩn bị mảng tham số truyền vào
$params = [];
$types = "sii"; // s = string (keyword), i = int (min), i = int (max)
$params[] = $keyword;
$params[] = $minPrice;
$params[] = $maxPrice;

// Nếu là allproduct và có chọn loại, thêm điều kiện lọc theo tên loại
if ($category === "allproduct" && !empty($type)) {
    $sql .= " AND c.name = ?";
    $params[] = $type;
    $types .= "s";
}

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

// Trả về kết quả HTML sản phẩm
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="product-item">
                <div class="product-img">
                    <div class="img-effect"><img src="' . htmlspecialchars($row['image']) . '" alt=""></div>
                </div>
                <div class="product-name">' . htmlspecialchars($row['pd_name']) . '</div>    
                <div class="product-end">
                    <div class="price">' . number_format($row['price'], 0, ',', '.') . ' đ</div>
                    <div class="add-cartmain"><img src="../../assest/cart.png" alt=""></div>
                </div>
              </div>';
    }
} else {
    echo '<p>Không tìm thấy sản phẩm phù hợp.</p>';
}

$stmt->close();
$conn->close();
?>
