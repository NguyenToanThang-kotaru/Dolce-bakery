$(document).ready(function () {
    // Đăng ký
    $("#register-form-son").submit(function (event) {
        event.preventDefault(); 

        var userName = $('.rg-username').val();
        var email = $('.rg-email').val();
        var fullName = $('.rg-fullName').val();
        var phone = $('.rg-phone').val();
        var passWord = $('.rg-password').val();

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
                alert(response);
                if (response.includes("Đăng nhập thành công")) {
                    window.location.href = "../../HTML/user/dolce.php";
                }
            }
        });
    });
});
