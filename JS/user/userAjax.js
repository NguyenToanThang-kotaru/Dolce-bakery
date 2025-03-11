// $(document).ready(function () {
//     // Đăng ký
//     $("#register-form-son").submit(function (event) {
//         event.preventDefault(); 

//         var userName = $('.rg-username').val();
//         var email = $('.rg-email').val();
//         var fullName = $('.rg-fullName').val();
//         var phone = $('.rg-phone').val();
//         var passWord = $('.rg-password').val();

//         $.ajax({
//             type: "POST",
//             url: "../../PHP/users/UserCtrl.php",
//             data: {
//                 "register-form-son": true,
//                 "rg-username": userName,
//                 "rg-email": email,
//                 "rg-fullName": fullName,
//                 "rg-phone": phone,
//                 "rg-password": passWord
//             },
//             success: function (response) {
//                 alert(response); 
//                 if (response.includes("Đăng ký thành công")) {
//                     window.location.href = "../../HTML/user/dolce.php"; 

//                 }
//             }
//         });
//     });

//     // Đăng nhập
//     $("#login-form-son").submit(function (event) {
//         event.preventDefault();
//         var userName = $('.lg-username').val();
//         var passWord = $('.lg-password').val();
//         $.ajax({
//             type: "POST",
//             url: "../../PHP/users/UserCtrl.php",
//             data: {
//                 "login-form-son": true,
//                 "lg-username": userName,
//                 "lg-password": passWord
//             },
//             success: function (response) {
//                 alert(response);
//                 if (response.includes("Đăng nhập thành công")) {
//                     window.location.href = "../../HTML/user/dolce.php";
//                 }
//             }
//         });
//     });
// });

$(document).ready(function () {



    // Đăng ký'
    $("#register-form-son").submit(function (event) {
        event.preventDefault();

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
        var fullnameRegex = /^[a-zA-Z\s]+$/;
        // Kiểm tra từng trường
        if (!usernameRegex.test(userName)) {
            alert("Tên đăng nhập không được chứa ký tự đặc biệt.");
            return;
        }
        if (!emailRegex.test(email)) {
            alert("Email không hợp lệ.");
            return;
        }
        if(!fullnameRegex.test(fullName)){
            alert("Tên không hợp lệ.");
            return;
        }
        if (!phoneRegex.test(phone)) {
            alert("Số điện thoại không hợp lệ.");
            return;
        }
        if (!passwordRegex.test(passWord)) {
            alert("Mật khẩu phải có ít nhất 8 ký tự.");
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
                alert(response);
                if (response.includes("Đăng ký thành công")) {
                    window.location.href = "../../HTML/user/dolce.php";
                }
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
            success: function (response) {

                // alert(response);


                if (response) {
                    //kiểm tra xem trang login chưa
                    localStorage.setItem("isLoggedIn", "true");
                    checkLoginStatus();
                    // window.location.href = "../../HTML/user/dolce.php";



                }
                let data = JSON.parse(response);
                console.log("Parsed data:", data);
                let html = '';

                html += `
                <div class="row">
                <label for="account" class="Detail">Tài khoản: </label>
                <span>${data.userName}</span>
            </div>
            <div class="row">
                <label for="fullname" class="Detail" >Họ và tên: </label>
                <span>${data.fullName}</span>

            </div>
        
            <div class="row">
                <label for="email" class="Detail" >Email:</label>
                <span>${data.email}</span>

            </div>
            
            <div class="row">
                <label for="phone" class="Detail" >Số điện thoại: </label>
                <span>${data.numberPhone}</span>
            </div>
            `;


                document.querySelector('.InfoUser_Detail').innerHTML = html;


            }

        });
    });

    //ẩn hiện đăng xuất thông tin
    function checkLoginStatus() {
        if (localStorage.getItem("isLoggedIn") === "true") {
            $("#login-btn").hide();
            $("#infor").show();
            $("#log-out").show();
        } else {
            $("#login-btn").show();
            $("#infor").hide();
            $("#log-out").hide();
        }
    }
    //bấm logout thì trả về trạng thái ban đầu
    checkLoginStatus();
    $("#log-out").click(function () {
        localStorage.removeItem("isLoggedIn");
        window.location.href = "../../HTML/user/dolce.php";
        // checkLoginStatus(); 
    });
});
