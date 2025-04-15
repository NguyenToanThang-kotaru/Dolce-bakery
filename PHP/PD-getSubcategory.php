<?php
include 'config.php';

// Kiểm tra nếu có truyền subcategory_id (tức là ID của loại sản phẩm)
if (isset($_POST['subcategory_id'])) {
    $categoryId = intval($_POST['subcategory_id']);

    // Truy vấn từ bảng subcategories, vì đó là bảng chứa các chủng loại
    $sql = "SELECT id, name FROM subcategories WHERE subcategory_id = $categoryId";
    $result = $conn->query($sql);

    // Kiểm tra và in ra các option
    if ($result && $result->num_rows > 0) {
        echo "<option value=''>-- Chọn chủng loại --</option>";
        while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['id']}'>{$row['name']}</option>";
        }
    } else {
        echo "<option value=''>Không có chủng loại nào</option>";
    }
} else {
    echo "<option value=''>Vui lòng chọn loại sản phẩm trước</option>";
}
?>
