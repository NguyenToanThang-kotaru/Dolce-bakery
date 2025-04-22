<?php
include 'config.php';

// Lấy id và name từ query string
$selectId = isset($_GET['id']) ? $_GET['id'] : 'product-subcategory';
$selectName = isset($_GET['name']) ? $_GET['name'] : 'product-subcategory';

$sql = "SELECT id, name FROM subcategories";
$result = $conn->query($sql);

// Bắt đầu thẻ select
echo "<select name='{$selectName}' class='form-select' id='{$selectId}' required>";
echo "  <option value=''>-- Chọn chủng loại sản phẩm --</option>";

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<option value='{$row['id']}'>{$row['name']}</option>";
    }
} else {
    echo "<option value=''>Không có chủng loại nào!</option>";
}

echo "</select>";
?>
