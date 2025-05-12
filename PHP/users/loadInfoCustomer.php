<?php
include '../config.php';
session_start();

function LoadInfoCustomer($conn, $row) {
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
        $addressDetail = '';
        $address = "Chưa có";
        $addressData['province_id'] = null;
        $addressData['district_id'] = null;
    }

    if (isset($_SESSION['userInfo'])) {
        $_SESSION['userInfo']['address'] = $address;
        $_SESSION['userInfo']['addressDetail'] = $addressDetail;
        $_SESSION['userInfo']['province_id'] = $addressData['province_id'];
        $_SESSION['userInfo']['district_id'] = $addressData['district_id'];
    }
}

if (isset($_GET['customer_id'])) {
    $row = ['id' => $_GET['customer_id']];
    LoadInfoCustomer($conn, $row); // Sửa lại từ $user thành $row
    echo json_encode(['status' => 'success', 'customer' => $_SESSION['userInfo']]);
}
?>
