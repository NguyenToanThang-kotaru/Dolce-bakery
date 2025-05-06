<?php
include '../config.php';

function loginUser($conn, $row) {
    $district_id = $row["district_id"];
    
    $sqlAddress = "SELECT provinces.name AS province_name, districts.name AS district_name
                   FROM provinces
                   INNER JOIN districts ON districts.province_id = provinces.id
                   WHERE districts.id = ?";
    $stmt = $conn->prepare($sqlAddress);
    $stmt->bind_param("i", $district_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $rowAddress = $result->fetch_assoc();
    $stmt->close();

    $province_name = $rowAddress["province_name"] ?? '';
    $district_name = $rowAddress["district_name"] ?? '';
    $address = $row['addressDetail'] . ", " . $province_name . ", " . $district_name;
    if($row['addressDetail'] == null) $address = "Chưa có";

    session_start();
    $_SESSION['userInfo'] = [
        'userID' => $row['id'],
        'userName' => $row['userName'],
        'email' => $row['email'],
        'fullName' => $row['fullName'],
        'phoneNumber' => $row['phoneNumber'],
        'address' => $address,
        'addressDetail' => $row['addressDetail'],
        'province_id' => $row['province_id'],
        'district_id' => $row['district_id'],
        'status' => $row['status'],
    ];

    return $_SESSION['userInfo'];
}

// --- ĐĂNG KÝ ---
if(isset($_POST['register-form-son'])){
    $userName = $_POST['rg-username'];
    $email = $_POST['rg-email'];
    $fullName = $_POST['rg-fullName'];
    $phone = $_POST['rg-phone'];
    $passwd = $_POST['rg-password'];
    
    $checkEmail = "SELECT * FROM customers WHERE (email = '$email' OR userName= '$userName')";
    $result = $conn->query($checkEmail);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        if ($row['userName'] == $userName) {
            echo json_encode(['status' => 'error', 'message' => 'Tên đăng nhập đã tồn tại.']);
            exit();
        }
        if ($row['email'] == $email) {
            echo json_encode(['status' => 'error', 'message' => 'Email đã tồn tại.']);
            exit();
        }
    } else {
        $hasshedPassword = password_hash($passwd, PASSWORD_BCRYPT); 
        $insertQuery = "INSERT INTO customers (userName, email, fullName, phoneNumber, password) 
                        VALUES ('$userName', '$email', '$fullName', '$phone', '$hasshedPassword')";
        if ($conn->query($insertQuery) === TRUE) {
            $userID = $conn->insert_id;
            $result = $conn->query("SELECT * FROM customers WHERE id = $userID");
            $user = $result->fetch_assoc();
            $userSession = loginUser($conn, $user);
            echo json_encode(['status' => 'success', 'user' => $userSession]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Lỗi: ' . $conn->error]);
        }
    }
    exit();
}

// --- ĐĂNG NHẬP ---
if (isset($_POST['login-form-son'])) {
    $userName = $_POST['lg-username'];
    $passwd = $_POST['lg-password'];

    $sql = "SELECT * FROM customers WHERE userName = '$userName' OR email = '$userName'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) { 
        $row = $result->fetch_assoc();
        $hashedPasswordInDB = $row['password'];
        if (password_verify($passwd, $hashedPasswordInDB)) { 
            if ($row['status'] == 2){
                echo json_encode(['status' => 'error', 'message' => 'Tài khoản đã bị khóa']);
                exit();
            }
            $userSession = loginUser($conn, $row);
            echo json_encode(['status' => 'success', 'user' => $userSession]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Sai mật khẩu']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Không tồn tại người dùng']);
    }
    exit();
}
?>
