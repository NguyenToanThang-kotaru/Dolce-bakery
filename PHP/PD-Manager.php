<?php
include 'config.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td class='img-admin'><img src='" . $row['image'] . "' alt=''></td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['type'] . "</td>";
        echo "<td>" . $row['quantity'] . "</td>";
        echo "<td>" . number_format($row['price'], 0, ',', '.') . " VND</td>";
        echo "<td><div class='fix-product'>
              <i class='fa-solid fa-pen-to-square fix-btn-product'></i>
              <i class='fa-solid fa-trash delete-btn-product'></i>
            </div></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td style= 'text-align: center;'  colspan='6'>Không có sản phẩm nào</td></tr>";
}
$conn->close();
?>
