<?php
include 'config.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        echo "<tr>";
        echo "<td class='img-admin'><img src='" . $row['image'] . "' alt=''></td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['type'] . "</td>";
        echo "<td>" . $row['quantity'] . "</td>";
        echo "<td>" . number_format($row['price'], 0, ',', '.') . " VND</td>";
        echo "<td><div class='fix-product'>
              <i class='fa-solid fa-pen-to-square fix-btn-product' data-id='$id'></i>
              <i class='fa-solid fa-trash delete-btn-product' data-id='$id'></i>
            </div></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td style= 'text-align: center;'  colspan='6'>Không có sản phẩm nào</td></tr>";
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

<script>
    document.querySelectorAll('.delete-btn-product').forEach(button => {
        button.addEventListener('click', function() {
            let productId = this.getAttribute('data-id');
            let deleteOverlay = document.getElementById('delete-overlay-product');
            deleteOverlay.style.display = 'block';
            document.getElementById('delete-acp-product').onclick = function() {
                window.location.href = '../../PHP/PD-delete.php?id=' + productId;
            };
            document.getElementById('cancel-product').onclick = function() {
                deleteOverlay.style.display = 'none';
            };
        });
    });
    document.querySelectorAll('.fix-btn-product').forEach(button =>{
        
        button.addEventListener('click',function(){
            let productId = this.getAttribute('data-id');
            document.getElementById('product-id').value = productId
        })
    });
</script>

<!-- upload product -->