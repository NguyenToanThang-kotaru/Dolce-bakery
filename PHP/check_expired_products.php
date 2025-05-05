<?php
include 'config.php';

$currentDate = new DateTime();

// Truy vấn inventory kèm theo importDate và shelfLife
$sql = "
    SELECT inventory.id AS inventory_id, inventory.product_id, importreceipts.importDate, products.shelfLife
    FROM inventory
    INNER JOIN importreceipts ON inventory.importID = importreceipts.id
    INNER JOIN products ON inventory.product_id = products.id
";

$result = $conn->query($sql);
$deletedCount = 0;

while ($row = $result->fetch_assoc()) {
    $importDate = new DateTime($row['importDate']);
    $shelfLifeDays = (int)$row['shelfLife'];
    $inventory_id = (int)$row['inventory_id'];
    $product_id = (int)$row['product_id'];

    // Tính số ngày kể từ ngày nhập hàng
    $interval = $importDate->diff($currentDate)->days;

    if ($interval > $shelfLifeDays) {
        // Xóa khỏi bảng inventory
        $delete = $conn->prepare("DELETE FROM inventory WHERE id = ?");
        $delete->bind_param("i", $inventory_id);
        $delete->execute();
        $delete->close();

        // Giảm 1 đơn vị khỏi bảng products
        $update = $conn->prepare("UPDATE products SET quantity = quantity - 1 WHERE id = ?");
        $update->bind_param("i", $product_id);
        $update->execute();
        $update->close();

        $deletedCount++;
    }
}

$conn->close();

?>
