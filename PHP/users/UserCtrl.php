<?php
include '../config.php';

function loginUser($conn, $row) {
    $customer_id = $row["id"];

    $sqlAddress = "SELECT ca.addressDetail, ca.district_id, ca.province_id, 
                          d.name AS district_name, p.name AS province_name
                   FROM customeraddress ca
                   JOIN districts d ON ca.district_id = d.id
                   JOIN provinces p ON ca.province_id = p.id
                   WHERE ca.customer_id = ? AND ca.default_id = 1
                   LIMIT 1";

    $stmt = $conn->prepare($sqlAddress);
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $addressData = $result->fetch_assoc();
    $stmt->close();

    if ($addressData) {
        $province_name = $addressData["province_name"] ?? '';
        $district_name = $addressData["district_name"] ?? '';
        $addressDetail = $addressData["addressDetail"] ?? '';
        $address = $addressDetail . ", " . $district_name . ", " . $province_name;
        if (empty($addressDetail)) $address = "Chưa có";
    } else {
        $province_name = $district_name = $addressDetail = '';
        $address = "Chưa có";
    }

    session_start();
    $_SESSION['userInfo'] = [
        'userID' => $row['id'],
        'userName' => $row['userName'],
        'email' => $row['email'],
        'fullName' => $row['fullName'],
        'phoneNumber' => $row['phoneNumber'],
        'address' => $address,
        'addressDetail' => $addressDetail,
        'province_id' => $addressData['province_id'] ?? null,
        'district_id' => $addressData['district_id'] ?? null,
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
