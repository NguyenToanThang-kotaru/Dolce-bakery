<?php
include 'config.php';

// Nếu được include từ các mục riêng (không có POST mà có $categoryId)
if (!isset($_POST['subcategory_id']) && isset($categoryId)) {
    $categoryId = intval($categoryId);

    // Truy vấn
    $sql = "SELECT id, name FROM subcategories WHERE subcategory_id = $categoryId";
    $result = $conn->query($sql);

    // In cả thẻ select và các option
    echo "<select id='$selectId' name='$selectName' class='form-select'>";
    if ($result && $result->num_rows > 0) {
        echo "<option value='0'>-- Tất cả --</option>";
        while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['id']}'>{$row['name']}</option>";
        }
    } else {
        echo "<option value=''>Không có chủng loại nào</option>";
    }
    echo "</select>";
    return;
}

// Nếu gọi bằng AJAX từ allproduct
if (isset($_POST['subcategory_id'])) {
    $categoryId = intval($_POST['subcategory_id']);

    $sql = "SELECT id, name FROM subcategories WHERE subcategory_id = $categoryId";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        echo "<option value=''>-- Chọn chủng loại --</option>";
        while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['id']}'>{$row['name']}</option>";
        }
    } else {
        echo "<option value=''>Không có chủng loại nào</option>";
    }
    return;
}

// Trường hợp không truyền gì
echo "<option value=''>Vui lòng chọn loại sản phẩm trước</option>";
?>
