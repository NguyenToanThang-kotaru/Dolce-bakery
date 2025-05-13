function showError(inputElement, message) {
    let errorDiv = inputElement.parentNode.querySelector(".error-msg");
    if (!errorDiv) {
        errorDiv = document.createElement("div");
        errorDiv.className = "error-msg show";
        inputElement.parentNode.appendChild(errorDiv);
    }
    errorDiv.innerHTML = `<i class="fa-solid fa-circle-xmark"></i> ${message}`;
    inputElement.focus();
}

function clearErrors(form) {
    form.querySelectorAll(".error-msg").forEach((error) => {
        error.remove();
    });
}

document.addEventListener("click", function (event) {
    if (event.target.classList.contains("fix-btn-product")) {
        let productId = event.target.getAttribute("data-id");
        console.log("Product ID:", productId);
        fetch(`../../PHP/PD-getPD.php?id=${productId}`)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (!data.error) {
                    
                    document.getElementById("preview-image").src = data.image;
                    document.getElementById("product-id").value = data.id;
                    document.getElementById("product-nameFIX").value = data.pd_name;
                    document.getElementById("product-categoryFIX").value = data.category_id;
                    document.getElementById("product-subcategoryFIX").value = data.subcategory_id;
                    document.getElementById("product-supplierFIX").value = data.supplier_id;
                    document.getElementById("product-priceFIX").value = data.price;
                    document.getElementById("product-shelflifeFIX").value = data.shelfLife;

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

function uploadImg(inputElement) {
    const preview = document.getElementById("preview-image"); // Tìm ảnh xem trước
    const fileSelected = inputElement.files;

    if (fileSelected.length > 0) {
        const fileToLoad = fileSelected[0];
        const fileReader = new FileReader();

        fileReader.onload = function(event) {
            if (preview) {
                preview.src = event.target.result; // Gán ảnh mới
                preview.style.display = "block"; // Hiển thị ảnh nếu nó đang bị ẩn
            } else {
                console.error("Không tìm thấy thẻ img để hiển thị ảnh xem trước!");
            }
        };

        fileReader.readAsDataURL(fileToLoad);
    }
}

document.getElementById("product-image").onchange = function(event) {
    const file = event.target.files[0]; // Lấy file ảnh được chọn
    if (file) {
        console.log("da cap nhat")
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById("preview-image").src = e.target.result; // Cập nhật ảnh preview
        };
        reader.readAsDataURL(file);
    }
};

document.querySelector(".product-table").addEventListener("click", function (event) {
    if (event.target.classList.contains("delete-btn-product")) {
        let productId = event.target.getAttribute("data-id");
        let deleteOverlay = document.getElementById("delete-overlay-product");
        deleteOverlay.style.display = "block";
        console.log("Product ID:", productId);
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
                        alert("Xóa sản phẩm thành công");
                        event.target.closest("tr").remove();
                    } else {
                        alert(data.message);
                    }
                    deleteOverlay.style.display = "none";
                });
        };
    }
});

document.querySelector(".add-form-product").addEventListener("submit", function(e) {
    e.preventDefault(); // Ngăn form load lại trang

    clearErrors(this);

    let productName = document.getElementById("product-name").value;

    let productNameRegex = /^[a-zA-ZÀ-Ỹà-ỹ\s]+$/;
   
    if (!productNameRegex.test(productName)) {
        showError(document.getElementById("product-name"), "Tên sản phẩm không hợp lệ.");
        return;
    }

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
            newRow.setAttribute("data-id", data.product.id); 
            newRow.innerHTML = `
                <td class='img-admin'><img src="${data.product.image}" alt='' width='50'></td>
                <td>${data.product.name}</td>
                <td>${data.product.category_name}</td>
                <td>${data.product.subcategory_name}</td>
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
});

document.getElementById("update-form-product").addEventListener("submit", function (event) {
    event.preventDefault(); // Ngăn form gửi theo cách mặc định

    clearErrors(this);

    let productName = document.getElementById("product-nameFIX").value;

    let productNameRegex = /^[a-zA-ZÀ-Ỹà-ỹ\s]+$/;
   
    if (!productNameRegex.test(productName)) {
        showError(document.getElementById("product-nameFIX"), "Tên sản phẩm không hợp lệ.");
        return;
    }

    let formData = new FormData(this); // Lấy dữ liệu form
    let productId = document.getElementById("product-id").value;
    console.log("ID sản phẩm:", productId);
    fetch("../../PHP/PD-edit.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json()) // Chuyển phản hồi thành JSON
    .then(data => {
        if (data.success) {
            alert(data.message); // Hiển thị thông báo thành công            
            console.log(data.product);
            let priceStr = data.product.price.replace(/\./g, '').replace(' VND', ''); 
            let priceNumber = parseInt(priceStr, 10);
            // Cập nhật dòng sản phẩm trên bảng nếu có
            let row = document.querySelector(`tr[data-id='${data.product.id}']`);
            if (row) {
                row.innerHTML = `
                    <td class='img-admin'><img src="${data.product.image}" alt="" width="50"></td>
                    <td>${data.product.name}</td>
                    <td>${data.product.category_name}</td>
                    <td>${data.product.subcategory_name}</td>
                    <td>${data.product.quantity}</td>
                    <td>${priceNumber.toLocaleString('vi-VN')} VND</td>
                    <td>
                        <div class='fix-product'>
                            <i class='fa-solid fa-pen-to-square fix-btn-product' data-id="${data.product.id}"></i>
                            <i class='fa-solid fa-trash delete-btn-product' data-id="${data.product.id}"></i>
                        </div>
                    </td>
                `;
                console.log("Cập nhật thành công!");
                fetch("../../PHP/PD-Manager.php")
                .then(response => response.text())
                .then(html => {
                    // Cập nhật lại nội dung bảng
                    document.querySelector("#product-table-body").innerHTML = html; 
                })
            }
            
            else
                console.log("Không tìm thấy sản phẩm cần cập nhật!");
        } else {
            alert("Lỗi: " + data.message);
        }
    })
    .catch(error => console.error("Lỗi:", error));
});
