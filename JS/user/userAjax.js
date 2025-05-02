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
            data: {
                "register-form-son": true,
                "rg-username": userName,
                "rg-email": email,
                "rg-fullName": fullName,
                "rg-phone": phone,
                "rg-password": passWord
            },
            success: function (response) {
                if (response.includes("success")) {
                    localStorage.setItem("isLoggedIn", "true");
                    checkLoginStatus();
                    location.reload();
                }
                else if (response.includes("Tên đăng nhập đã tồn tại")) {
                    showError(rgUserName, response);
                    rgUserName.focus();
                }
                else if (response.includes("Email đã tồn tại")) {
                    showError(rgEmail, response);
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
                location.reload();
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
        localStorage.removeItem("isLoggedIn");
        window.location.href = "../../HTML/user/dolce.php";
        // checkLoginStatus(); 
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
            <div class="row">
                <!-- Phần 1: Tên khung -->
                <label for="address" class="Detail titleAddressInfo">Địa chỉ:</label>

                <!-- Phần 2: Nội dung + chữ thay đổi -->
                <div class="value-wrapper">
                    <span class="content no-margin">${address}</span>
                    <span class="changed no-margin" onclick = "OnUpdateAddress()">Cập nhật</span>
                </div>
            </div>

            <div id="Buy-history">
                        <div class="History" onclick = "openOrderHistory()">Lịch sử mua hàng</div>
            </div>
        `;

        document.querySelector('.InfoUser_Detail').innerHTML = html;
    }


    $("#log-out").click(function () {
        $.ajax({
            type: "POST",
            url: "../../PHP/users/Logout.php",
            success: function () {
                window.location.href = "../../HTML/user/dolce.php";
            }
        });
    });


    function saveAddress() {
        var dc = $('.overlayAddress .address').val();
        var tinh = $('.overlayAddress .province').val();
        var quan = $('.overlayAddress .district').val();
        if (!dc || !tinh || !quan) {
            showToast("Vui lòng nhập đầy đủ thông tin!", false);
            return;
        }

    
        $.ajax({
            type: "POST",
            url: "../../PHP/users/saveAddress.php",  
            data: {
                "addressDetail": dc,
                "province": tinh,
                "district": quan
            },
            success: function (response) {
                const res = JSON.parse(response);
                if (res.status === "success") {
                    sessionStorage.setItem("userInfo", JSON.stringify(res.user));
                    showToast("Đã cập nhật địa chỉ thành công", true);
                    $('.address').val('');
                    $('.province').val('');
                    $('.district').val('');
                    loadUserInfo();
                    setUserInfoPayment();
                    document.querySelector(".overlayAddress").style.display = "none";
                    document.getElementById("overlayInfo").style.display = "block";
                    document.querySelector(".overlayInfoAddress").style.display = "none";
                } else {
                    alert("Lỗi: " + res.message);
                }
            }
        });
    }
function changeAddress()
{
    var dc = $('.overlayAddressPayment .address').val();
    var tinh = $('.overlayAddressPayment .province').val();
    var quan = $('.overlayAddressPayment .district').val();
    if (!dc || !tinh || !quan) {
        showToast("Vui lòng nhập đầy đủ thông tin!", false);
        return;
    }
    $.ajax({
        type: "POST",
        url: "../../PHP/users/getAddressName.php",  
        data: {
            "addressDetail": dc,
            "province": tinh,
            "district": quan
        },
        success: function (response) {
            const res = JSON.parse(response);
            if (res.status === "success") {
                showToast("Đã thay đổi địa chỉ thành công", true);
                $('.address').val('');
                $('.province').val('');
                $('.district').val('');
                document.querySelector(".overlayAddressPayment").style.display = "none";
                document.querySelector(".overlayInfoAddress").style.display = "none";

                let provinceName = res.provinceName;
                let districtName = res.districtName;
                let address = dc + ", " + districtName + ", " + provinceName;

                document.querySelector(".payment-customer-address").textContent = address;
            } else {
                alert("Lỗi: " + res.message);
            }
        }
    });
    let address = dc + ", " + quan + ", " + tinh;
    document.querySelector(".payment-customer-address").textContent = address;
    localStorage.setItem("userAddress", JSON.stringify({
        addressDetail: dc,
        province: tinh,
        district: quan
    }));
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


function setUserInfoPayment() {
    let userSession = sessionStorage.getItem("userInfo");
    userSession = JSON.parse(userSession);
    document.querySelector(".payment-customer-name").textContent = userSession.fullName;
    document.querySelector(".payment-customer-email").textContent = userSession.email;
    document.querySelector(".payment-customer-phone").textContent = userSession.phoneNumber + "";
    document.querySelector(".payment-customer-address").textContent = userSession.address;
}