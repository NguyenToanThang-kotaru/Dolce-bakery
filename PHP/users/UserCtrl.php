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
        $checkEmail = "SELECT * FROM customers WHERE (email = '$email' OR userName= '$userName')";
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
            $hasshedPassword = password_hash($passwd, PASSWORD_BCRYPT); 
            $insertQuery = "INSERT INTO customers (userName, email, fullName, phoneNumber, password) 
                VALUES ('$userName', '$email', '$fullName', '$phone', '$hasshedPassword')";
            if ($conn->query($insertQuery) === TRUE) {
                session_start();    
                $_SESSION['userInfo'] = [
                    'userID' => $conn->insert_id,
                    'userName' => $userName,
                    'email' => $email,
                    'fullName' => $fullName,
                    'phoneNumber' => $phone,
                    'status' => 'active'
                ];
                echo "success";
            } else {
                echo "Lỗi: " . $conn->error;
            }
        }
        exit();
    }
    

    if (isset($_POST['login-form-son'])) {
        $userName = $_POST['lg-username'];
        $passwd = $_POST['lg-password'];
    
        $sql = "SELECT * FROM customers WHERE userName = '$userName' OR email = '$userName'";
        $result = $conn->query($sql);
        // $hasshedPassword1 = passWord_hash($passwd, PASSWORD_BCRYPT);
        // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        if ($result->num_rows > 0) { 
            $row = $result->fetch_assoc();
            $district_id=$row["district_id"];
            // Kiểm tra mật khẩu
            $hasshedPasswordnew = $row['password'];
            if (password_verify($passwd, $hasshedPasswordnew)) { 
                $sqlAddress = "SELECT provinces.name AS province_name, districts.name AS district_name
                FROM provinces
                INNER JOIN districts ON districts.province_id = provinces.id
                WHERE districts.id = ?";
                $stmt = $conn->prepare($sqlAddress);
                $stmt->bind_param("i", $district_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $rowAddress;
                if ($rowAddress = $result->fetch_assoc()) {
                $province_name = $rowAddress["province_name"];
                $district_name = $rowAddress["district_name"];
                }

                $address = $row['addressDetail'] . ", " . $province_name . ", " . $district_name;
                $stmt->close();

                session_start();
                $_SESSION['userInfo'] = [
                    'userID' => $row['id'],
                    'userName' => $row['userName'],
                    'email' => $row['email'],
                    'fullName' => $row['fullName'],
                    'phoneNumber' => $row['phoneNumber'],
                    'address' => $address,
                    'addressDetail' => $row['addressDetail'],
                    'province_name' => $province_name,
                    'district_name' => $district_name,
                    'province_id' => $row['province_id'],
                    'district_id' => $row['district_id'],
                    'status' => $row['status'],
                ];
                echo json_encode(['status' => 'success', 'user' => $_SESSION['userInfo']]);
            } else {
                echo json_encode([
                    'status' => 'error', 
                    'message' => 'Sai mật khẩu',
                    'debug_info' => [
                        'input_password_______' => $concac = password_verify($passwd, $hasshedPasswordnew),
                        'hashed_password_in_db' => $hasshedPasswordnew
                    ]
                ]);
            }
            
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Không tồn tại người dùng']);
        }
        exit();
    }
?>
