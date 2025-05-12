<?php
include 'config.php';

$sql = "SELECT products.*, subcategories.name AS subcategory_name, categories.name AS category_name
        FROM products 
        INNER JOIN subcategories ON products.subcategory_id = subcategories.id
        INNER JOIN categories ON subcategories.category_id = categories.id
        WHERE products.is_deleted = 0
        ORDER BY products.id ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($product = $result->fetch_assoc()) {
        $id = $product['id'];

        // Truy vấn số lượng sản phẩm từ bảng inventory
        $sql_inventory = "SELECT COUNT(*) AS quantity
                          FROM inventory
                          WHERE product_id = ? ";
        $stmt = $conn->prepare($sql_inventory);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $inventory_result = $stmt->get_result();
        $quantity = 0; // Mặc định là 0

        if ($inventory_row = $inventory_result->fetch_assoc()) {
            $quantity = $inventory_row["quantity"];
        }
        $stmt->close();

        $sql = "UPDATE products SET quantity = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $quantity, $id);
        $stmt->execute();
        $stmt->close();


        // Hiển thị thông tin sản phẩm
        echo "<tr data-id='$id'>";
        echo "<td class='img-admin'><img src='" . $product['image'] . "' alt=''></td>";
        echo "<td>" . $product['pd_name'] . "</td>";
        echo "<td>" . $product['category_name'] . "</td>";
        echo "<td>" . $product['subcategory_name'] . "</td>";
        echo "<td>" . $quantity . "</td>";
        echo "<td>" . number_format($product['price'], 0, ',', '.') . " VND</td>";
        echo "<td><div class='fix-product'>
              <i class='fa-solid fa-pen-to-square fix-btn-product' data-id='$id'></i>
              <i class='fa-solid fa-trash delete-btn-product' data-id='$id'></i>
            </div></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td style='text-align: center;' colspan='6'>Không có sản phẩm nào</td></tr>";
}

$conn->close();
?>
<div id='delete-overlay-product'>
    <div class='delete-container'>
        <span>Bạn muốn xóa sản phẩm này?</span>
        <button id='delete-acp-product'>Xác nhận</button>
        <button id='cancel-product'>Hủy</button>
    </div>
</div>
