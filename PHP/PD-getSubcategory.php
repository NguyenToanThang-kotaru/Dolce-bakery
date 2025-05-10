<?php
include 'config.php';

if (isset($_POST['category_id'])) {
    $categoryId = intval($_POST['category_id']);
} elseif (isset($categoryId)) {
    $categoryId = intval($categoryId); // Được gán từ bên ngoài trước khi include
} else {
    
    return;
}

$selectId = isset($selectId) ? htmlspecialchars($selectId) : 'subcategory-select';
$selectName = isset($selectName) ? htmlspecialchars($selectName) : 'subcategory';

$sql = "SELECT id, name FROM subcategories WHERE category_id = $categoryId";
$result = $conn->query($sql);

echo "<select name='$selectName' class='form-select' id='$selectId' required>";
echo "  <option value='0'>-- Chọn phân loại sản phẩm --</option>";

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<option value='{$row['id']}'>{$row['name']}</option>";
    }
} else {
    echo "<option value=''>Không có phân loại</option>";
}

echo "</select>";
?>