<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/html; charset=UTF-8');
include '../../PHP/config.php';

// Nhận dữ liệu từ form
$category = $_POST['category'] ?? 'allproduct';
$keyword = trim($_POST['keyword'] ?? "");
$minPrice = (int) ($_POST['min'] ?? 0);
$maxPrice = (int) ($_POST['max'] ?? 1000000);
$subcategory = (int) ($_POST['subcategory'] ?? 0);
$type = (int) ($_POST['type'] ?? 0); // chỉ dùng với allproduct

// Chuẩn bị truy vấn cơ bản
$sql = "SELECT p.*
        FROM products p 
        JOIN subcategories sc ON p.subcategory_id = sc.id 
        JOIN categories c ON sc.category_id = c.id 
        WHERE p.price BETWEEN ? AND ?";

$types = "dd";
$params = [$minPrice, $maxPrice];

// Nếu có từ khóa, thêm điều kiện tìm theo tên
if ($keyword !== "") {
    $sql .= " AND p.pd_name LIKE ?";
    $types .= "s";
    $params[] = "%" . $keyword . "%";
}

// Nếu có chọn chủng loại cụ thể
if ($subcategory > 0) {
    $sql .= " AND sc.id = ?";
    $types .= "i";
    $params[] = $subcategory;
}

// Nếu đang ở allproduct và chọn loại cụ thể
if ($category === "allproduct" && $type > 0) {
    $sql .= " AND c.id = ?";
    $types .= "i";
    $params[] = $type;
}

// Nếu là bread/cake/cookie thì giới hạn loại tương ứng
$categoryMap = [
    "bread" => 1,
    "cake" => 2,
    "cookie" => 3
];
if (isset($categoryMap[$category])) {
    $sql .= " AND c.id = ?";
    $types .= "i";
    $params[] = $categoryMap[$category];
}

// Chuẩn bị & thực thi
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Lỗi SQL: " . $conn->error . "<br>Query: " . $sql);
}

$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

// Hiển thị sản phẩm
// Hiển thị sản phẩm
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Xác định class cho sản phẩm dựa vào danh mục
        $categoryClass = '';
        if ($category === 'bread') {
            $categoryClass = 'bread-product';
        } elseif ($category === 'cake') {
            $categoryClass = 'cake-product';
        } elseif ($category === 'cookie') {
            $categoryClass = 'cookie-product';
        } else {
            $categoryClass = 'product-item'; // Dành cho allproduct
        }

        echo '<div class="' . $categoryClass . '">
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