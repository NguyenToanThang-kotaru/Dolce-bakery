// document.querySelector(".add-form-account").addEventListener("submit", function(e) {
//     e.preventDefault(); // Ngăn form load lại trang

//     let formData = new FormData(this);

//     fetch('../../PHP/AC-Add.php', {
//         method: 'POST',
//         body: formData
//     })
//     .then(response => response.json())
//     .then(data => {
//         let tableBody = document.querySelector("#account-table-body");
//         if (data.success) {
//             alert(data.message);
//             console.log(data.account);
//             // Tạo hàng mới trong bảng
//             let newRow = document.createElement("tr");
//             newRow.setAttribute("data-id", data.account.id); 
//             newRow.innerHTML = `
//                 <td>${data.account.username}</td>
//                 <td>${data.account.hasshedPassword}</td>
//                 <td>${data.account.email}</td>
//                 <td>
//                     <select class='account-status' >
//                         <option value='1' " . ($status == 1 ? "selected" : "") . ">Đang hoạt động</option>
//                         <option value='2' " . ($status == 2 ? "selected" : "") . ">Đã khóa</option>
//                     </select>
//                 </td>
//                 <td>
//                     <div style = 'display: flex;'>
//                         <span style='margin-left: 10px;'> ${data.account.permission_name}</span>
//                     </div>
//                 </td>
                
//                 <td><div class='fix-account'>
//                     <i class='fa-solid fa-pen-to-square fix-btn-account' data-id='${data.account.id}'></i>
//                     <i class='fa-solid fa-trash delete-btn-account' data-id='${data.account.id}'></i>
//                 </div></td>
//             `;

//             tableBody.appendChild(newRow);

//             // Xóa dữ liệu trong form
//             document.querySelector(".add-form-account").reset();
//         } else {
//             alert("Lỗi: " + data.message);
//         }
//     })
// });

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

//Thêm
document.querySelector(".add-form-account").addEventListener("submit", function (event) {
    event.preventDefault();
    clearErrors(this);

    let username = document.getElementById("account-name").value;
    let email = document.getElementById("account-email").value;
    let password = document.getElementById("account-pass").value;
    let permission = document.getElementById("permissionSelect").value;

    let usernameRegex = /^[a-zA-Z0-9_]+$/;
    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    let passwordRegex = /^.{8,}$/;

    if (!usernameRegex.test(username)) {
        showError(document.getElementById("account-name"), "Tên đăng nhập không hợp lệ.");
        return;
    }
    if (!emailRegex.test(email)) {
        showError(document.getElementById("account-email"), "Email không hợp lệ.");
        return;
    }
    if (!passwordRegex.test(password)) {
        showError(document.getElementById("account-pass"), "Mật khẩu phải từ 8 ký tự trở lên.");
        return;
    }
    if (!permission) {
        showError(document.getElementById("permissionSelect"), "Vui lòng chọn quyền.");
        return;
    }

    let formData = new FormData(this);
    fetch('../../PHP/AC-Add.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) throw new Error("Server trả về lỗi");
        return response.json();
    })
    .then(data => {
        let tableBody = document.querySelector("#account-table-body");
        if (data.success) {
            alert(data.message);

            let newRow = document.createElement("tr");
            newRow.setAttribute("data-id", data.account.id); 
            newRow.innerHTML = `
                <td>${data.account.username}</td>
                <td>${data.account.hasshedPassword}</td>
                <td>${data.account.email}</td>
                <td>
                    <select class='account-status'>
                        <option value='1' ${data.account.status == 1 ? 'selected' : ''}>Đang hoạt động</option>
                        <option value='2' ${data.account.status == 2 ? 'selected' : ''}>Đã khóa</option>
                    </select>
                </td>
                <td>
                    <div style='display: flex;'>
                        <span style='margin-left: 10px;'>${data.account.permission_name}</span>
                    </div>
                </td>
                <td>
                    <div class='fix-account'>
                        <i class='fa-solid fa-pen-to-square fix-btn-account' data-id='${data.account.id}'></i>
                        <i class='fa-solid fa-trash delete-btn-account' data-id='${data.account.id}'></i>
                    </div>
                </td>
            `;
            tableBody.appendChild(newRow);
            document.querySelector(".add-form-account").reset();
        } else {
            alert("Lỗi: " + data.message);
        }
    })
    .catch(error => {
        console.error('Fetch Error:', error);
        alert('Đã xảy ra lỗi trong quá trình xử lý. Xem console để biết thêm chi tiết.');
    });
});



//Xóa
document.querySelector(".account-table").addEventListener("click", function (event) {
    if (event.target.classList.contains("delete-btn-account")) {
        let userId = event.target.getAttribute("data-id");
        console.log("Account ID:", userId);
        let deleteOverlay = document.getElementById('delete-overlay-account');
        deleteOverlay.style.display = 'block';
        document.getElementById('delete-acp-account').onclick = function () {
            fetch('../../PHP/AC-Delete.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'id=' + userId,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log("da xoa");
                    event.target.closest("tr").remove();
                } else {
                    alert('Xóa tài khoản phẩm thất bại!');
                }
                deleteOverlay.style.display = 'none';
            })};
    };
});

//Sửa
document.addEventListener("click", function (event) {
    if (event.target.classList.contains("fix-btn-account")) {
        let userId = event.target.getAttribute("data-id");
        
        console.log("Account ID:", userId);
        fetch(`../../PHP/AC-getAC.php?id=${userId}`)
            .then(response => response.json())
            .then(data => {
                if (!data.error) {
                    // Điền thông tin vào form
                    document.getElementById("account-id-f").value = data.id;
                    document.getElementById("account-name-f").value = data.userName;
                    // document.getElementById("account-pass-f").value = data.password;
                    document.getElementById("account-email-f").value = data.email;

                    // Cập nhật quyền 
                    if (data.permission_id) {
                        document.getElementById("permissionSelect-f").value = data.permission_id;
                    }

                    // Ẩn bảng tài khoản và nút thêm
                    document.querySelector(".account-table").style.display = "none";
                    document.getElementById("account-plus").style.display = "none";

                    // Hiển thị form sửa tài khoản
                    document.querySelector(".fix-form-account").style.display = "block";
                } else {
                    alert("Không tìm thấy tài khoản!");
                }
            })
            .catch(error => console.error("Lỗi:", error));
    }
});

// document.getElementById("fix-form-account").addEventListener("submit", function (event) {
//     event.preventDefault(); 

//     let formData = new FormData(this);

//     fetch("../../PHP/AC-Edit.php", {
//         method: "POST",
//         body: formData
//     })
//     .then(response => response.json())
//     .then(data => {
//         if (data.success) {
//             alert(data.message);
//             console.log(data.user);
//             // Cập nhật giao diện người dùng 
//             let row = document.querySelector(`tr[data-id='${data.user.id}']`);
//             if (row) {
//                 row.innerHTML = `
//                     <td>${data.user.userName}</td>
//                     <td>${data.user.password}</td>
//                     <td>${data.user.email}</td>
//                     <td>
//                         <select class='account-status' data-id="${data.user.id}">
//                             <option value='1' ${data.user.status == 1 ? "selected" : ""}>Đang hoạt động</option>
//                             <option value='2' ${data.user.status == 2 ? "selected" : ""}>Đã khóa</option>
//                         </select>
//                     </td>
//                     <td>
//                         <div style = 'display: flex;'>
//                         <span style='margin-left: 10px; font-weight: bold;'>${data.user.permission_name}</span>
//                         </div>
//                     </td>
//                     <td>
//                         <div class='fix-account'>
//                             <i class='fa-solid fa-pen-to-square fix-btn-account' data-id="${data.user.id}"></i>
//                             <i class='fa-solid fa-trash delete-btn-account' data-id="${data.user.id}"></i>
//                         </div>
//                     </td>
//                 `;

//                 let statusSelect = row.querySelector(".account-status");
//                 updateStatusColor(statusSelect);// Lấy lại màu trạng thái sau khi cập nhật

//                 console.log("Cập nhật thành công!");
//             }
//             else
//                 console.log("Không tìm thấy tài khoản cần cập nhật!");
//         } else {
//             alert("Lỗi: " + data.message);
//         }
//     })
//     .catch(error => console.error("Lỗi:", error));
// });


document.getElementById("fix-form-account").addEventListener("submit", function (event) {
    event.preventDefault();

    clearErrors(this); // Xóa lỗi cũ

    let username = document.getElementById("account-name-f").value.trim();
    let email = document.getElementById("account-email-f").value.trim();
    let permission = document.getElementById("permissionSelect-f").value;
    let password = document.getElementById("account-pass-f").value;

    // Regex
    let usernameRegex = /^[a-zA-Z0-9_]+$/;
    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    let passwordRegex = /^.{8,}$/;

    if (!usernameRegex.test(username)) {
        showError(document.getElementById("account-name-f"), "Tên đăng nhập không hợp lệ.");
        return;
    }

    if (!emailRegex.test(email)) {
        showError(document.getElementById("account-email-f"), "Email không hợp lệ.");
        return;
    }

    if (!permission) {
        showError(document.getElementById("permissionSelect-f"), "Vui lòng chọn quyền.");
        return;
    }

    if (!passwordRegex.test(password)) {
        showError(document.getElementById("account-pass-f"), "Mật khẩu phải từ 8 ký tự trở lên.");
        return;
    }

    let formData = new FormData(this);
    fetch("../../PHP/AC-Edit.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            console.log(data.user);
            // Cập nhật giao diện người dùng 
            let row = document.querySelector(`tr[data-id='${data.user.id}']`);
            if (row) {
                row.innerHTML = `
                    <td>${data.user.userName}</td>
                    <td>${data.user.password}</td>
                    <td>${data.user.email}</td>
                    <td>
                        <select class='account-status' data-id="${data.user.id}">
                            <option value='1' ${data.user.status == 1 ? "selected" : ""}>Đang hoạt động</option>
                            <option value='2' ${data.user.status == 2 ? "selected" : ""}>Đã khóa</option>
                        </select>
                    </td>
                    <td>
                        <div style = 'display: flex;'>
                        <span style='margin-left: 10px; font-weight: bold;'>${data.user.permission_name}</span>
                        </div>
                    </td>
                    <td>
                        <div class='fix-account'>
                            <i class='fa-solid fa-pen-to-square fix-btn-account' data-id="${data.user.id}"></i>
                            <i class='fa-solid fa-trash delete-btn-account' data-id="${data.user.id}"></i>
                        </div>
                    </td>
                `;

                let statusSelect = row.querySelector(".account-status");
                updateStatusColor(statusSelect);// Lấy lại màu trạng thái sau khi cập nhật

                console.log("Cập nhật thành công!");
            }
            else
                console.log("Không tìm thấy tài khoản cần cập nhật!");
        } else {
            alert("Lỗi: " + data.message);
        }
    })
    .catch(error => console.error("Lỗi:", error));
  });



    function updateStatusColor(select) {
        if(select.value == "2"){
            select.style.boxShadow = "0 0 5px 1px red";
        }
        else{
            select.style.boxShadow = "0 0 5px 1px rgb(47, 218, 70)";
        }
    }

    



