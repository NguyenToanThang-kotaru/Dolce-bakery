document.addEventListener("click", function (event) {
    if (event.target.classList.contains("fix-btn-product")) {
        let productId = event.target.getAttribute("data-id");
        console.log("Product ID:", productId);
        fetch(`../../PHP/PD-getPD.php?id=${productId}`)
            .then(response => response.json())
            .then(data => {
                if (!data.error) {
                    document.getElementById("preview-image").src = data.image;
                    document.getElementById("product-id").value = data.id;
                    document.getElementById("product-nameFIX").value = data.name;
                    document.getElementById("product-typeFIX").value = data.type;
                    document.getElementById("product-quantityFIX").value = data.quantity;
                    document.getElementById("product-priceFIX").value = data.price;

                    // Ẩn bảng sản phẩm và nút thêm
                    document.querySelector(".product-table").style.display = "none";
                    document.getElementById("product-plus").style.display = "none";

                    // Hiển thị form sửa sản phẩm
                    document.querySelector(".fix-form-product").style.display = "block";
                } else {
                    alert("Không tìm thấy sản phẩm!");
                }
            })
            .catch(error => console.error("Lỗi:", error));
    }
});


document.querySelector(".product-table").addEventListener("click", function (event) {
    if (event.target.classList.contains("delete-btn-product")) {
        let productId = event.target.getAttribute("data-id");
        let deleteOverlay = document.getElementById("delete-overlay-product");
        deleteOverlay.style.display = "block";

        document.getElementById("delete-acp-product").onclick = function () {
            fetch("../../PHP/PD-delete.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: "id=" + productId,
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        event.target.closest("tr").remove();
                    } else {
                        alert("Xóa sản phẩm thất bại!");
                    }
                    deleteOverlay.style.display = "none";
                });
        };
    }
});

document.querySelector(".add-form-product").addEventListener("submit", function(e) {
    e.preventDefault(); // Ngăn form load lại trang

    let formData = new FormData(this);

    fetch('../../PHP/PD-Add.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        let tableBody = document.querySelector("#product-table-body");
        if (data.success) {
            alert(data.message);

            // Tạo hàng mới trong bảng
            let newRow = document.createElement("tr");
            newRow.innerHTML = `
                <td class='img-admin'><img src="${data.product.image}" alt='' width='50'></td>
                <td>${data.product.name}</td>
                <td>${data.product.type}</td>
                <td>${data.product.quantity}</td>
                <td>${data.product.price}</td>
                <td><div class='fix-product'>
                    <i class='fa-solid fa-pen-to-square fix-btn-product' data-id='${data.product.id}'></i>
                    <i class='fa-solid fa-trash delete-btn-product' data-id='${data.product.id}'></i>
                </div></td>
            `;

            // Thêm vào bảng sản phẩm
            tableBody.appendChild(newRow);

            // Xóa dữ liệu trong form
            document.querySelector(".add-form-product").reset();
        } else {
            alert("Lỗi: " + data.message);
        }
    })
    .catch(error => console.error('Lỗi:', error));
});

document.getElementById("update-form-product").addEventListener("submit", function (event) {
    event.preventDefault(); // Ngăn form gửi theo cách mặc định

    let formData = new FormData(this); // Lấy dữ liệu form

    fetch("../../PHP/PD-edit.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json()) // Chuyển phản hồi thành JSON
    .then(data => {
        if (data.success) {
            alert(data.message); // Hiển thị thông báo thành công
            event.preventDefault(); // Ngăn form gửi theo cách mặc định
            console.log(data.product);
            let priceStr = data.product.price.replace(/\./g, '').replace(' VND', ''); 
            let priceNumber = parseInt(priceStr, 10);
            // Cập nhật dòng sản phẩm trên bảng nếu có
            let row = document.querySelector(`tr[data-id='${data.product.id}']`);
            if (row) {
                row.innerHTML = `
                    <td class='img-admin'><img src="${data.product.image}" alt="" width="50"></td>
                    <td>${data.product.name}</td>
                    <td>${data.product.type}</td>
                    <td>${data.product.quantity}</td>
                    <td>${priceNumber.toLocaleString('vi-VN')} VND</td>
                    <td>
                        <div class='fix-product'>
                            <i class='fa-solid fa-pen-to-square fix-btn-product' data-id="${data.product.id}"></i>
                            <i class='fa-solid fa-trash delete-btn-product' data-id="${data.product.id}"></i>
                        </div>
                    </td>
                `;
            }
        } else {
            alert("Lỗi: " + data.message);
        }
    })
    .catch(error => console.error("Lỗi:", error));
});
