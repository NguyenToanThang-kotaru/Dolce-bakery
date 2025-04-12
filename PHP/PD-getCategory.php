<?php
include 'config.php';
$sql = "SELECT id, name FROM categories";
$result = $conn->query($sql);
    echo"  <select name='product-type' class='form-select' id='product-typeFIX' required>";
    echo"    <option value=''>-- Chọn chủng loại sản phẩm --</option>";
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['name']}</option>";
            }
        } else {
            echo "<option value=''>Không có loại sản phẩm nào!</option>";
        } 
    echo" </select>";
   

?>
