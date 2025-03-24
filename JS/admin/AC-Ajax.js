//Xóa
document.querySelectorAll('.delete-btn-account').forEach(button => {
    button.addEventListener('click', function() {
        let userId = this.getAttribute('data-id');
        let deleteOverlay = document.getElementById('delete-overlay-account');
        deleteOverlay.style.display = 'block';
        document.getElementById('delete-acp-account').onclick = function () {
            fetch('../../PHP/AC-Delete.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'id=' + userId
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.querySelector(`.delete-btn-account[data-id='${userId}']`).closest('tr').remove();
                } else {
                    alert('Xóa tài khoản phẩm thất bại!');
                }
                deleteOverlay.style.display = 'none';
            })}
    });
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
                    document.getElementById("account-pass-f").value = data.password;
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

document.getElementById("fix-form-account").addEventListener("submit", function (event) {
    event.preventDefault(); 

    let formData = new FormData(this);

    fetch(this.action, {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Cập nhật tài khoản thành công!");
            // Cập nhật giao diện người dùng 
            document.querySelector(".fix-form-account").style.display = "none";
            document.querySelector(".account-table").removeAttribute("style");
            document.getElementById("account-plus").style.display = "block";
            document.getElementById("fix-form-account").reset(); 
            updateAccountTable(); // Cập nhật lại dữ liệu không load
        } else {
            alert("Có lỗi xảy ra: " + data.error);
        }
    })
    .catch(error => console.error("Lỗi:", error));
});

function updateAccountTable() {
    fetch('../../PHP/AC-Manager.php')
        .then(response => response.text())
        .then(html => {
            document.querySelector(".account-table tbody").innerHTML = html;
            document.querySelector(".account-table").style.width = "100%";
        })
        .catch(error => console.error("Lỗi:", error));
}
