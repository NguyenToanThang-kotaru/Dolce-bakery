<?php
    include '../config.php';

    if(isset($_POST['register-form-son'])){
        $userName = $_POST['rg-username'];
        $email = $_POST['rg-email'];
        $fullName = $_POST['rg-fullName'];
        $phone = $_POST['rg-phone'];
        $passwd = $_POST['rg-password'];
        // // Kiểm tra bằng RegEx
        // if (!preg_match("/^[a-zA-Z0-9_]+$/", $userName)) {
        //     // echo "Tên đăng nhập không hợp lệ!";
        //     exit();
        // }
        // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //     // echo "Email không hợp lệ!";
        //     exit();
        // }

        // if (!preg_match("/^0\d{9}$/", $phone)) {
        //     // echo "Số điện thoại không hợp lệ!";
        //     exit();
        // }
        // if (!preg_match("/^.{8,}$/", $passwd)) {
        //     // echo "Mật khẩu không hợp lệ!";
        //     exit();
        // }
        
        // Kiểm tra email đã tồn tại
        $checkEmail = "SELECT * FROM users WHERE (email = '$email' OR userName= '$userName')";
        $result = $conn->query($checkEmail);
        if($result->num_rows>0){
            $row = $result->fetch_assoc();
    
            if ($row['email'] == $email) {
                echo "Email đã tồn tại!";
                exit();
            }
        
            if ($row['userName'] == $userName) {
                echo "Tên đăng nhập đã tồn tại!";
                exit();
            }
        }
        else {
            $hasshedPassword = passWord_hash($passwd, PASSWORD_BCRYPT); 
            $insertQuery = "INSERT INTO users (userName, email, fullName, numberPhone, password) 
                VALUES ('$userName', '$email', '$fullName', '$phone', '$hasshedPassword')";
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
    
        $sql = "SELECT * FROM users WHERE userName = '$userName' OR email = '$userName'";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            // Kiểm tra mật khẩu
            $hasshedPassword = $row['password'];
            if (password_verify($passwd, $hasshedPassword)) { 
                session_start();
                $_SESSION['userInfo'] = [
                    'userID' => $row['id'],
                    'userName' => $row['userName'],
                    'email' => $row['email'],
                    'fullName' => $row['fullName'],
                    'numberPhone' => $row['numberPhone'],
                    'role' => $row['role'],
                ];
                echo json_encode(['status' => 'success', 'user' => $_SESSION['userInfo']]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Sai mật khẩu']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Không tồn tại người dùng']);
        }
        exit();
    }


?>
