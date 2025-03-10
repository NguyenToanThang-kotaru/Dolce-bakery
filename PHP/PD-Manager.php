<?php
include 'config.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        echo "<tr>";
        echo "<td class='img-admin'><img id='product-image-" . $row['id'] . "' src='" . $row['image'] . "' alt=''></td>";
        echo "<td id='product-name-" . $row['id'] . "'>" . $row['name'] . "</td>";
        echo "<td id='product-type-" . $row['id'] . "'>" . $row['type'] . "</td>";
        echo "<td id='product-quantity-" . $row['id'] . "'>" . $row['quantity'] . "</td>";
        echo "<td id='product-price-" . $row['id'] . "'>" . number_format($row['price'], 0, ',', '.') . " VND</td>";
        echo "<td>
                <div class='fix-product'>
                    <i class='fa-solid fa-pen-to-square fix-btn-product' data-id='" . $row['id'] . "'></i>
                    <i class='fa-solid fa-trash delete-btn-product' data-id='" . $row['id'] . "'></i>
                </div>
              </td>";
        echo "</tr>";
        
        echo "<div class='fix-form-product' action='../../PHP/PD-edit.php' method='POST' enctype='multipart/form-data'>";
        echo "<input type='hidden' id='product-id' name='product-id' value='".$row['id']."'>";
        echo "<i class='fa-solid fa-rotate-left back-product'></i>";
        echo "<div class='form-group'>";
        echo "<label for='product-image' class='form-label'>*Ảnh sản phẩm</label>";
        echo "<input type='file' id='product-image' name='product-image' class='form-input' />";
        echo "</div>";
        
        echo "<div class='form-group'>";
        echo "<label for='product-name' class='form-label'>*Tên sản phẩm</label>";
        echo "<input type='text' id='product-name' name='product-name' value='".$row['name']."' class='form-input' />";
        echo "</div>";
        
        echo "<div class='form-group'>";
        echo "<label for='product-type' class='form-label'>*Loại sản phẩm</label>";
        echo "<select id='product-type' name='product-type' class='form-select'>";
        echo "<option value='cake' ".($row['type'] == 'cake' ? 'selected' : '').">Bánh kem</option>";
        echo "<option value='bread' ".($row['type'] == 'bread' ? 'selected' : '').">Bánh mì</option>";
        echo "<option value='cookie' ".($row['type'] == 'cookie' ? 'selected' : '').">Cookies</option>";
        echo "</select>";
        echo "</div>";
        
        echo "<div class='form-group'>";
        echo "<label for='product-quantity' class='form-label'>*Số Lượng</label>";
        echo "<input type='number' id='product-quantity' name='product-quantity' value='".$row['quantity']."' class='form-input' />";
        echo "</div>";
        
        echo "<div class='form-group'>";
        echo "<label for='product-price' class='form-label'>*Giá Tiền (VNĐ)</label>";
        echo "<input type='number' id='product-price' name='product-price' value='".$row['price']."' class='form-input' />";
        echo "</div>";
        
        echo "<div class='form-group text-center'>";
        echo "<button type='submit' id='accept-fixPD' class='form-button'>Hoàn tất</button>";
        echo "</div>";
        echo "</div>";
        
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
            document.getElementById('delete-acp-product').onclick = function () {
                fetch('../../PHP/PD-delete.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'id=' + productId
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // alert('Xóa sản phẩm thành công!');
                        document.querySelector(`.delete-btn-product[data-id='${productId}']`).closest('tr').remove();
                    } else {
                        alert('Xóa sản phẩm thất bại!');
                    }
                    deleteOverlay.style.display = 'none';
                })}
        });
    });
    document.querySelectorAll('.form-button').forEach(button => {
    button.addEventListener('click', function() {
        let productId = this.getAttribute('data-id');
        let formData = new FormData();
        let productImage = document.querySelector(`#product-image-${productId}`).files[0];

        formData.append("product-id", productId);
        formData.append("product-name", document.querySelector(`#product-name-${productId}`).value);
        formData.append("product-type", document.querySelector(`#product-type-${productId}`).value);
        formData.append("product-quantity", document.querySelector(`#product-quantity-${productId}`).value);
        formData.append("product-price", document.querySelector(`#product-price-${productId}`).value);

        if (productImage) {
            formData.append("product-image", productImage);
        }

        fetch('../../PHP/PD-edit.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Sửa sản phẩm thành công!');

                // Cập nhật thông tin trên giao diện
                document.querySelector(`#product-name-${productId}`).innerText = document.querySelector(`#product-name-${productId}`).value;
                document.querySelector(`#product-type-${productId}`).innerText = document.querySelector(`#product-type-${productId}`).value;
                document.querySelector(`#product-quantity-${productId}`).innerText = document.querySelector(`#product-quantity-${productId}`).value;
                document.querySelector(`#product-price-${productId}`).innerText = document.querySelector(`#product-price-${productId}`).value;

                // Cập nhật ảnh nếu có thay đổi
                if (productImage) {
                    let imageURL = URL.createObjectURL(productImage);
                    document.querySelector(`#product-image-${productId}`).src = imageURL;
                }

                // Ẩn form chỉnh sửa
                document.querySelector(`#edit-form-${productId}`).style.display = 'none';
            } else {
                alert('Sửa sản phẩm thất bại!');
            }
        });
    });
});





const add_form_1 = document.querySelector(".add-form-product");
const plus_1 = document.querySelector("#product-plus");
const product_table = document.querySelector(".product-table");
const back_1 = document.querySelectorAll(".back-product");
const fix_form_1 = document.querySelector(".form-button");
const fix_btn_1 = document.querySelectorAll(".fix-btn-product");
const delete_btn_1 = document.querySelectorAll(".delete-btn-product");
const delete_acp_1 = document.querySelector("#delete-acp-product");
const delete_ovl_1 = document.querySelector("#delete-overlay-product");
const cancel_btn_1 = document.querySelector("#cancel-product");




function returnProduct(){
    product_table.removeAttribute("style");
    plus_1.style.display = "block";
    document.querySelector(".fix-form-product").style.removeProperty("display");
    delete_ovl_1.style.display = "none";

}



document.querySelectorAll('.fix-btn-product').forEach(button => {
    button.addEventListener('click', function() {
        let productId = this.getAttribute('data-id');

        // Ẩn tất cả form khác
        document.querySelectorAll('.fix-form-product').forEach(form => {
            form.style.display = 'none';
        });

        // Hiện form chỉnh sửa đúng sản phẩm
        document.querySelector(`#edit-form-${productId}`).style.display = 'block';
    });
});




</script>

<!-- upload product -->