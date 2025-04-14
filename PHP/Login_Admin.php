<?php
require_once './config.php';
session_start();

if (isset($_POST['admin-login'])) {
    $userName = $_POST['admin-username'];
    $passwd = $_POST['admin-password'];

    $userName = mysqli_real_escape_string($conn, $userName);

    $sql = "SELECT * FROM users WHERE userName = '$userName'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($passwd, $row['password'])) {
            $_SESSION['adminInfo'] = [
                'adminID' => $row['id'],
                'userName' => $row['userName'],
                'email' => $row['email'],
                'permission_id' => $row['permission_id'],
                'fullName' => $row['fullName']
            ];

            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Sai mật khẩu']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Không tồn tại tài khoản admin']);
    }

    exit();
}
?>
