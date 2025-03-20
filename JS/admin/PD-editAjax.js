document.querySelectorAll('.fix-btn-product').forEach(button => {
    button.addEventListener('click', function() {
        let productId = this.getAttribute('data-id');
        console.log(productId);
        // Gửi yêu cầu lấy dữ liệu sản phẩm
        fetch(`../../PHP/PD-getPD.php?id=${productId}`)
            .then(response => response.json())
            .then(data => {
                if (!data.error) {
                    // Điền dữ liệu vào form sửa
                    console.log(data);  
                    document.getElementById("preview-image").src = data.image;
                    document.getElementById('product-id').value = data.id;
                    document.getElementById('product-nameFIX').value = data.name;
                    document.getElementById('product-typeFIX').value = data.type;
                    document.getElementById('product-quantityFIX').value = data.quantity;
                    document.getElementById('product-priceFIX').value = data.price;

                    // Hiển thị form sửa
                    document.querySelector('.fix-form-product').style.display = 'block';
                } else {
                    alert("Không tìm thấy sản phẩm!");
                }
            })
            .catch(error => console.error('Lỗi:', error));
    });
});