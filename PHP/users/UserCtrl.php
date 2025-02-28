<?php
    include '../config.php';

    if(isset($_POST['register-form-son'])){
        $userName = $_POST['rg-username'];
        $email = $_POST['rg-email'];
        $fullName = $_POST['rg-fullName'];
        $phone = $_POST['rg-phone'];
        $passwd = $_POST['rg-password'];

        // Kiểm tra số điện thoại
        if (!ctype_digit($phone) || strlen($phone) != 10) {
            echo "Số điện thoại không hợp lệ! Vui lòng nhập lại số điện thoại.";
            exit();
        }
    
    
        // Kiểm tra email đã tồn tại chưa
        $checkEmail = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($checkEmail);
    
        if($result->num_rows > 0){
            echo "Địa chỉ email đã tồn tại!";
        } else {
            // Chèn dữ liệu vào bảng users 
            $insertQuery = "INSERT INTO users (userName, email, fullName, numberPhone, password) 
                            VALUES ('$userName', '$email', '$fullName', '$phone', '$passwd')";
    
            if($conn->query($insertQuery) === TRUE){
                header("Location: ../../HTML/user/dolce.php");
            } else {
                echo "Lỗi: " . $conn->error;
            }
        }
    }
    else{
        echo "Lỗi: khong post" ;
    }


    if(isset($_POST['login-form-son']))
    {
        $userName = $_POST['lg-username'];
        $passwd = $_POST['lg-password'];

        $sql = "SELECT * FROM users WHERE userName = '$userName' and password = '$passwd'";
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
            session_start();
            $row = $result->fetch_assoc();
            $_SESSION['userName'] = $row['userName'];
            $_SESSION['role'] = $row['role'];
    
            if($row['role'] == 2) {
                header("Location: ../../HTML/admin/admin.php");
            } else {
                header("Location: ../../HTML/user/dolce.php#logined"); 
            }
            exit();
        } else {
            echo "Không tìm thấy tài khoản hoặc sai mật khẩu";
        }
        
    }


?>
