
<?php
include 'config.php';

if (isset($_POST['subcategory_id'])) {
    $subcategory_id = intval($_POST['subcategory_id']);

    $sql = "SELECT id, name FROM categories WHERE subcategory_id = $subcategory_id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        echo "<option value=''>-- Chọn loại sản phẩm --</option>";
        while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['id']}'>{$row['name']}</option>";
        }
    } else {
        echo "<option value=''>Không có loại sản phẩm nào</option>";
    }
} else {
    echo "<option value=''>Vui lòng chọn chủng loại trước</option>";
}
?>

