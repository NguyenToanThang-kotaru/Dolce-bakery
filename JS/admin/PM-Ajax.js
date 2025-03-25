//Thêm

document.querySelector(".add-form-role").addEventListener("submit", function(e) {
    e.preventDefault(); // Ngăn form load lại trang

    let formData = new FormData(this);

    fetch('../../PHP/PM-Add.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        let tableBody = document.querySelector("#role-table-body");
        if (data.success) {
            alert(data.message);

            // Tạo hàng mới trong bảng
            let newRow = document.createElement("tr");
            newRow.setAttribute("data-id", data.role.id); 
            newRow.innerHTML = `
                <td>${data.role.name}</td>
                <td></td>
                <td>0</td>
                <td class='role-account'><img src='../../assest/Download cloud.png' alt='' class='show-userrole' data-id='$permissionId'></td>
                <td><div class='fix-role'>
                    <i class='fa-solid fa-pen-to-square fix-btn-role' data-id='${data.role.id}'></i>
                    <i class='fa-solid fa-trash delete-btn-role' data-id='${data.role.id}'></i>
                </div></td>
            `;

            tableBody.appendChild(newRow);

            // Xóa dữ liệu trong form
            document.querySelector(".add-form-role").reset();
        } else {
            alert("Lỗi: " + data.message);
        }
    })
});


//Xóa

document.querySelectorAll('.delete-btn-role').forEach(button => {
    button.addEventListener('click', function() {
        let permissionId = this.getAttribute('data-id');
        let deleteOverlay = document.getElementById('delete-overlay-role');
        deleteOverlay.style.display = 'block';
        document.getElementById('delete-acp-role').onclick = function () {
            fetch('../../PHP/PM-Delete.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'id=' + permissionId
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.querySelector(`.delete-btn-role[data-id='${permissionId}']`).closest('tr').remove();
                } else {
                    alert('Xóa sản phẩm thất bại!');
                }
                deleteOverlay.style.display = 'none';
            })}
    });
});


// Sửa
document.addEventListener("click", function (event) {
if (event.target.classList.contains("fix-btn-role")) {
    let permissionId = event.target.getAttribute("data-id");
    
    console.log("Permission ID:", permissionId);
    fetch(`../../PHP/PM-getPM.php?id=${permissionId}`)
        .then(response => response.json())
        .then(data => {
            if (!data.error) {
                document.getElementById("role-id-f").value = data.id;
                document.getElementById("role-name-f").value = data.name;
                
                // Kiểm tra nếu data.functions 
                if (Array.isArray(data.functions)) {
                    document.querySelectorAll(".permission-checkbox").forEach(checkbox => {
                        checkbox.checked = data.functions.includes(parseInt(checkbox.value));
                    });
                    console.log(data.functions);
                } else {
                    console.error("Lỗi: Dữ liệu functions không hợp lệ!", data.functions);
                }

                // Ẩn bảng quyền và nút thêm
                document.querySelector(".role-table").style.display = "none";
                document.getElementById("role-plus").style.display = "none";

                // Hiển thị form sửa quyền
                document.querySelector(".fix-form-role").style.display = "block";
            } else {
                alert("Không tìm thấy quyền!");
            }
        })
        .catch(error => console.error("Lỗi:", error));
}
});

document.getElementById("fix-form-role").addEventListener("submit", function (event) {
event.preventDefault(); 

let formData = new FormData(this);

fetch(this.action, {
    method: "POST",
    body: formData
})
.then(response => response.json())
.then(data => {
    if (data.success) {
        alert("Cập nhật quyền thành công!");
        // Cập nhật giao diện người dùng 
        document.querySelector(".fix-form-role").style.display = "none";
        document.querySelector(".role-table").removeAttribute("style");
        document.getElementById("role-plus").style.display = "block";
        document.getElementById("fix-form-role").reset();// Reset lại form
        updateRoleTable();// Cập nhật lại dữ liệu bảng quyền 
    } else {
        alert("Có lỗi xảy ra: " + data.error);
    }
})
.catch(error => console.error("Lỗi:", error));
});

function updateRoleTable() { //Hàm cập nhật trục tiếp
fetch('../../PHP/PM-Manager.php')
    .then(response => response.text())
    .then(html => {
        document.querySelector(".role-table tbody").innerHTML = html;
        document.querySelector(".role-table").style.width = "100%";
    })
    .catch(error => console.error("Lỗi:", error));
}
