<?php
include '../../PHP/config.php';

// Lấy danh sách loại sản phẩm
$categorySql = "SELECT id, name FROM categories";
$categoryResult = $conn->query($categorySql);

if ($categoryResult && $categoryResult->num_rows > 0) {
    while ($category = $categoryResult->fetch_assoc()) {
        $categoryId = $category['id'];
        $categoryName = htmlspecialchars($category['name']);

        // Thêm thẻ div vào bên trái thẻ li để tạo vùng hover mở rộng
        echo "<li class='item-submenu category-item' data-category='" . strtolower($categoryName) . "'>
                <div class='hover-area'></div> 
                <div class='bipthu' onclick=\"render_filter('all')\">a</div>{$categoryName}";
        echo "  <ul class='submenu-2'>";

        // Lấy danh sách phân loại (subcategory) tương ứng
        $subSql = "SELECT id, name, category_id FROM subcategories WHERE category_id = $categoryId";
        $subResult = $conn->query($subSql);

        if ($subResult && $subResult->num_rows > 0) {
            while ($sub = $subResult->fetch_assoc()) {
                $subName = htmlspecialchars($sub['name']);
                $subId = htmlspecialchars($sub['id']);
                $category_id = htmlspecialchars($sub['category_id']);

                $keySql = "SELECT id, name FROM categories WHERE id = $category_id";
                $keyResult = $conn->query($keySql);
                $key = $keyResult->fetch_assoc();
                $keyName = htmlspecialchars($key['name']);
                echo "<li onclick='render_filter({$subId}, \"{$keyName}\")'>{$subName}</li>";
            }
        } else {
            echo "<li>Không có phân loại</li>";
        }

        echo "  </ul>";
        echo "</li>";
    }
} else {
    echo "<li>Không có loại sản phẩm</li>";
}
?>
