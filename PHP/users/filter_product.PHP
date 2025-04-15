<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/html; charset=UTF-8');

include '../../PHP/config.php';

$category = $_POST['category'];
$keyword = "%" . $_POST['keyword'] . "%"; // bỏ khoảng trắng thừa
$minPrice = $_POST['min'];
$maxPrice = $_POST['max'];
$subcategory = (int)($_POST['subcategory'] ?? 0); // đề phòng không có thì = 0

$types = "dddi";
$params = [$keyword, $minPrice, $maxPrice, $subcategory];

// JOIN thêm bảng categories để lọc theo loại
$sql = "SELECT p.*
        FROM products p 
        JOIN subcategories sc ON p.subcategory_id = sc.id 
        JOIN categories c ON sc.subcategory_id = c.id 
        WHERE p.pd_name LIKE ?
          AND p.price BETWEEN ? AND ? AND sc.id = ?;";

$params = [];
$types = "sddi";
$params[] = $keyword;
$params[] = $minPrice;
$params[] = $maxPrice;
$params[] = $subcategory;
// if ($category === "allproduct" && !empty($type)) {
//     $sql .= " AND c.name = ?";
//     $params[] = $type;
//     $types .= "s";
// }

// if (!empty($subcategory)) {
//     $sql .= " AND sc.id = ?";
//     $params[] = $subcategory;
//     $types .= "i";
// }

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Lỗi SQL: " . $conn->error . "<br>Query: " . $sql);
}

$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

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