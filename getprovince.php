<?php
            include '../Dolce-bakery/PHP/config.php';
            $sql = "SELECT id, name FROM provinces ORDER BY id ASC";
            $result = $conn->query($sql);
            echo "<select name='order-province' class='orderstatus-select' id='order-province' required>";
            echo "<option value=''>Chọn tỉnh/thành phố</option>";
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['name']}</option>";
              }
            } else {
              echo "<option value=''>Không có trạng thái nào!</option>"; 
            }
            echo "</select>";
?>