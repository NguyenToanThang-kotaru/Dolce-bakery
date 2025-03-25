//Xóa
document.querySelector(".customer-table").addEventListener("click", function (event) {
    if (event.target.classList.contains("delete-btn-customer")) {
        let cusId = event.target.getAttribute("data-id");
        console.log("customer ID:", cusId);
        let deleteOverlay = document.getElementById('delete-overlay-customer');
        deleteOverlay.style.display = 'block';
        document.getElementById('delete-acp-customer').onclick = function () {
            fetch('../../PHP/CU-Delete.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'id=' + cusId,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log("da xoa");
                    event.target.closest("tr").remove();
                } else {
                    alert('Xóa khách hàng phẩm thất bại!');
                }
                deleteOverlay.style.display = 'none';
            })};
    };
});

//Sửa
document.getElementById("fix-form-customer").addEventListener("submit", function (event) {
    event.preventDefault(); 

    let formData = new FormData(this); // Lấy dữ liệu form
    let customerId = document.getElementById("customer-id").value;
    console.log("ID khách hàng:", customerId);

    fetch("../../PHP/CU-Edit.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message); 
            console.log(data.customer.id);

            // Cập nhật dòng khách hàng trên bảng nếu có
            let row = document.querySelector(`tr[data-id='${data.customer.id}']`);
            if (row) {
                row.innerHTML = `
                    <td>${data.customer.id}</td>
                    <td>${data.customer.fullName}</td>
                    <td>
                        <select class='customer-status' data-id="${data.customer.id}">
                            <option value='1' " . ($status == 1 ? "selected" : "") . ">Đang hoạt động</option>
                            <option value='2' " . ($status == 2 ? "selected" : "") . ">Đã khóa</option>
                        </select>
                    </td>
                    <td><img src='../../assest/ACdetail.png' class='customer-detail' data-id="${data.customer.id}" alt='Xem chi tiết'></td>
                    <td>
                        <div class='fix-customer'>
                            <i class='fa-solid fa-pen-to-square fix-btn-customer' data-id="${data.customer.id}"></i>
                            <i class='fa-solid fa-trash delete-btn-customer' data-id="${data.customer.id}"></i>
                        </div>
                    </td>
                `;
                console.log("Cập nhật thành công!");
            }
            else
                console.log("Không tìm thấy khách hàng cần cập nhật!");
        } else {
            alert("Lỗi: " + data.message);
        }
    })
    .catch(error => console.error("Lỗi:", error));
});

document.addEventListener("click", function (event) {
    if (event.target.classList.contains("fix-btn-customer")) {
        let customerId = event.target.getAttribute("data-id");
        console.log("customer ID:", customerId);
        fetch(`../../PHP/CU-getCU.php?id=${customerId}`)
            .then(response => response.json())
            .then(data => {
                if (!data.error) {
                    console.log(data);
                    document.getElementById("customer-id").value = data.id;
                    document.getElementById("customer-name-f").value = data.fullName;
                    document.getElementById("customer-phone-f").value = data.phoneNumber;
                    document.getElementById("customer-email-f").value = data.email;
                    document.getElementById("customer-address-f").value = data.address;

                    // Ẩn bảng khách hàng và nút thêm
                    document.querySelector(".customer-table").style.display = "none";

                    // Hiển thị form sửa khách hàng
                    document.querySelector(".fix-form-customer").style.display = "block";
                } else {
                    alert("Không tìm thấy khách hàng!");
                }
            })
            .catch(error => console.error("Lỗi:", error));
    }
});
