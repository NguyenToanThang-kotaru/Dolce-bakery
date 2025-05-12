$(document).ready(function () {
    checkLoginStatus();
    // Đăng ký'
    $("#register-form-son").submit(function (event) {
        event.preventDefault();
        var registerForm = document.querySelector("#register-form-son");
        clearErrors(registerForm);
        var userName = $('.rg-username').val();
        var email = $('.rg-email').val();
        var fullName = $('.rg-fullName').val();
        var phone = $('.rg-phone').val();
        var passWord = $('.rg-password').val();

        // Biểu thức chính quy
        var usernameRegex = /^[a-zA-Z0-9_]+$/;
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        var phoneRegex = /^0\d{9}$/;
        var passwordRegex = /^.{8,}$/;
        var fullnameRegex = /^[a-zA-ZÀ-Ỹà-ỹ\s]+$/;

        var rgUserName = document.querySelector(".rg-username");
        var rgEmail = document.querySelector(".rg-email");
        var rgFullName = document.querySelector(".rg-fullName");
        var rgPhone = document.querySelector(".rg-phone");
        var rgPassword = document.querySelector(".rg-password");
        var rgConfirmPassword = document.querySelector(".rg-confirm-password");
        // Kiểm tra từng trường
        // let newMsg;

        if (!usernameRegex.test(userName)) {
            showError(rgUserName, "Tên đăng nhập không được chứa ký tự đặc biệt.");
            rgUserName.focus();
            return;
        }
        if (!emailRegex.test(email)) {
            showError(rgEmail, "Email không hợp lệ.");
            rgEmail.focus();
            return;
        }
        if (!fullnameRegex.test(fullName)) {
            showError(rgFullName, "Tên không hợp lệ.");
            rgFullName.focus();
            return;
        }
        if (!phoneRegex.test(phone)) {
            showError(rgPhone, "Số điện thoại không hợp lệ.");
            rgPhone.focus();
            return;
        }
        if (!passwordRegex.test(passWord)) {
            showError(rgPassword, "Mật khẩu phải có ít nhất 8 ký tự.");
            rgPassword.focus();
            return;
        }
        if (rgConfirmPassword.value !== rgPassword.value) {
            showError(rgConfirmPassword, "Mật khẩu nhập lại không khớp.");
            rgConfirmPassword.focus();
            return;
        }



        // Nếu tất cả hợp lệ, gửi dữ liệu qua AJAX
        $.ajax({
            type: "POST",
            url: "../../PHP/users/UserCtrl.php",
            dataType: "json",
            data: {
                "register-form-son": true,
                "rg-username": userName,
                "rg-email": email,
                "rg-fullName": fullName,
                "rg-phone": phone,
                "rg-password": passWord
            },
            success: function (response) {
                if (response.status === 'success') {
                    localStorage.setItem("isLoggedIn", "true");
                    checkLoginStatus();
                    const timeShown = showToast("Đăng kí thành công.", true, 1000);
                    setTimeout(() => {
                        location.reload();
                    }, timeShown); 
                }
                else if (response.message === 'Tên đăng nhập đã tồn tại.') {
                    showError(rgUserName, response.message);
                    rgUserName.focus();
                }
                else if (response.message === 'Email đã tồn tại.') {
                    showError(rgEmail, response.message);
                    rgEmail.focus();
                }
                console.log(response);
            }
        });
    });

    // Đăng nhập
    $("#login-form-son").submit(function (event) {
        event.preventDefault();
        var userName = $('.lg-username').val();
        var passWord = $('.lg-password').val();

        $.ajax({
            type: "POST",
            url: "../../PHP/users/UserCtrl.php",
            data: {
                "login-form-son": true,
                "lg-username": userName,
                "lg-password": passWord
            },
            dataType: "json",
            success: function (response) {
                var loginForm = document.querySelector("#login-form-son");
                clearErrors(loginForm);
                console.log(response);
                if (response.status === "error") {
                    if (response.message === "Không tồn tại người dùng") {
                        var username = document.querySelector(".lg-username");
                        showError(username, "Không tồn tại người dùng")
                        username.focus();
                        return;
                    }
                    else if (response.message === "Tài khoản đã bị khóa") {
                        console.log(response);
                        showToast("Tai khoan bi khoa", false);
                    }
                    else if (response.message === "Sai mật khẩu") {
                        console.log(response);
                        var pwdContainer = document.querySelector(".password-container");
                        var passWord = document.querySelector(".lg-password");
                        showError(pwdContainer, "Sai mật khẩu")
                        passWord.focus();
                    }
                    return;
                }
                localStorage.setItem("isLoggedIn", "true");
                checkLoginStatus();
                const timeShown = showToast("Đăng nhập thành công.", true, 1000);
                setTimeout(() => {
                    location.reload();
                }, timeShown);               
            }

        });
    });

    //ẩn hiện đăng xuất thông tin
    function checkLoginStatus() {
        $.ajax({
            type: "POST",
            url: "../../PHP/users/sessionCheck.php",
            dataType: "json",
            success: function (data) {
                if (data.loggedIn) {
                    // Lưu vào Session Storage
                    sessionStorage.setItem("userInfo", JSON.stringify(data.user));

                    $("#login-btn").hide();
                    $("#infor").show();
                    $("#log-out").show();

                    loadUserInfo();
                } else {
                    sessionStorage.removeItem("userInfo");

                    $("#login-btn").show();
                    $("#infor").hide();
                    $("#log-out").hide();
                }
            }
        });

    }
    //bấm logout thì trả về trạng thái ban đầu
    checkLoginStatus();
    $("#log-out").click(function () {
        $.ajax({
            type: "POST",
            url: "../../PHP/users/Logout.php",
            success: function () {
                localStorage.removeItem("isLoggedIn");
                const timeShown = showToast("Đang đăng xuất.......", false, 1000);
                    setTimeout(() => {
                        window.location.href = "../../HTML/user/dolce.php";
                    }, timeShown); 
                
            }
        });
    });
});

// Notification of regist and signin
function showError(input, message) {
    var errorDiv = input.parentNode.querySelector(".error-msg");
    var symbolError = '<i class="fa-solid fa-circle-xmark"></i>';
    errorDiv.innerHTML = symbolError + " " + message;
    errorDiv.classList.add("show");
}

function clearErrors(form) {
    form.querySelectorAll(".error-msg").forEach((errorDiv) => {
        errorDiv.innerHTML = "";
        errorDiv.classList.remove("show");
    });
}

    function loadUserInfo() {
        let userData = sessionStorage.getItem("userInfo");

        if (!userData) {
            console.log("No user info found");
            return;
        }

        let data = JSON.parse(userData);
        console.log("User info loaded from Session Storage:", data);
        let address;
        if(data.address == null) address = "Chưa có";
        else address = data.address;
        let html = `
            <div class="row">
                <label for="account" class="Detail">Tài khoản: </label>
                <span>${data.userName}</span>
            </div>
            <div class="row">
                <label for="fullname" class="Detail">Họ và tên: </label>
                <span>${data.fullName}</span>
            </div>
            <div class="row">
                <label for="email" class="Detail">Email:</label>
                <span>${data.email}</span>
            </div>
            <div class="row">
                <label for="phone" class="Detail">Số điện thoại: </label>
                <span>${data.phoneNumber}</span>
            </div>
            

            <div id="Buy-history">
                        <div class="History" onclick = "openOrderHistory()">Lịch sử mua hàng</div>
            </div>
        `;

        document.querySelector('.InfoUser_Detail').innerHTML = html;
    }


function showToast(message, isSuccess, duration = 2000) {
    const toast = document.createElement("div");
    toast.className = "toast";
    toast.textContent = message;
    toast.style.backgroundColor = isSuccess ? "#4caf50" : "#f44336";

    document.body.appendChild(toast);

    setTimeout(() => {
        toast.style.animation = "fadeout 0.3s ease forwards";
        setTimeout(() => toast.remove(), 300);
    }, duration);

    return duration + 300; 
}

function loadCustomerAddressToSessionStorageAndThen(callback) {
    const customerInfo = JSON.parse(sessionStorage.getItem('userInfo'));
    const customerId = customerInfo.userID;

    $.ajax({
        url: '../../PHP/users/loadInfoCustomer.php',
        type: 'GET',
        dataType: 'json',
        data: {
            customer_id: customerId
        },
        success: function(response) {
            if (response) {
                const customer = response.customer;
                customerInfo.address = customer.address;
                customerInfo.addressDetail = customer.addressDetail;
                customerInfo.province_id = customer.province_id;
                customerInfo.district_id = customer.district_id;

                sessionStorage.setItem('userInfo', JSON.stringify(customerInfo));
                console.log("Địa chỉ đã được cập nhật vào sessionStorage.");

                if (callback) callback(); // Gọi callback sau khi cập nhật xong
            } else {
                console.error("Không có dữ liệu địa chỉ.");
            }
        },
        error: function() {
            console.error("Lỗi khi lấy địa chỉ từ server.");
        }
    });
}


