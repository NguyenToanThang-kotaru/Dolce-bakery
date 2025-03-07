<?php
    include '../config.php';

    if(isset($_POST['register-form-son'])){
        $userName = $_POST['rg-username'];
        $email = $_POST['rg-email'];
        $fullName = $_POST['rg-fullName'];
        $phone = $_POST['rg-phone'];
        $passwd = $_POST['rg-password'];
    
        // Kiểm tra bằng RegEx
        if (!preg_match("/^[a-zA-Z0-9_]+$/", $userName)) {
            // echo "Tên đăng nhập không hợp lệ!";
            exit();
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // echo "Email không hợp lệ!";
            exit();
        }

        if (!preg_match("/^0\d{9}$/", $phone)) {
            // echo "Số điện thoại không hợp lệ!";
            exit();
        }
        if (!preg_match("/^.{8,}$/", $passwd)) {
            // echo "Mật khẩu không hợp lệ!";
            exit();
        }
    
        // Kiểm tra email đã tồn tại
        $checkEmail = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($checkEmail);
        
        if ($result->num_rows > 0) {
            echo "Email đã tồn tại!";
        } else {
            $insertQuery = "INSERT INTO users (userName, email, fullName, numberPhone, password) 
                            VALUES ('$userName', '$email', '$fullName', '$phone', '$passwd')";
            if ($conn->query($insertQuery) === TRUE) {
                echo "Đăng ký thành công";
            } else {
                echo "Lỗi: " . $conn->error;
            }
        }
        exit();
    }
    


    if (isset($_POST['login-form-son'])) {
        $userName = $_POST['lg-username'];
        $passwd = $_POST['lg-password'];
    
        $sql = "SELECT * FROM users WHERE userName = '$userName' and password = '$passwd'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            session_start();
            $row = $result->fetch_assoc();
            $_SESSION['userName'] = $row['userName'];
            $_SESSION['role'] = $row['role'];
    
            echo "Đăng nhập thành công";
        } else {
            echo "Sai tài khoản hoặc mật khẩu!";
        }
        exit();
    }


?>
