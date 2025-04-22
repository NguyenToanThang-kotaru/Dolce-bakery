<?php
session_start();
include '../config.php';

$addressDetail = $_POST['addressDetail'];
$provinceId = $_POST['province'];      // province_id
$districtId = $_POST['district'];      // district_id

$userId = $_SESSION['userInfo']['userID']; 

// Cập nhật vào bảng customers
$query = "UPDATE customers SET addressDetail = ?, province_id = ?, district_id = ? WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("sssi", $addressDetail, $provinceId, $districtId, $userId);

if ($stmt->execute()) {
    // Lấy tên tỉnh và quận từ ID
    $sqlAddress = "SELECT 
                        p.name AS province_name, 
                        d.name AS district_name 
                   FROM districts d
                   JOIN provinces p ON d.province_id = p.id
                   WHERE d.id = ?";
    $stmt2 = $conn->prepare($sqlAddress);
    $stmt2->bind_param("i", $districtId);
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    if ($row = $result2->fetch_assoc()) {
        $provinceName = $row['province_name'];
        $districtName = $row['district_name'];

        // Cập nhật lại session
        if (isset($_SESSION['userInfo'])) {
            $_SESSION['userInfo']['addressDetail'] = $addressDetail;
            $_SESSION['userInfo']['province'] = $provinceId;
            $_SESSION['userInfo']['district'] = $districtId;
            $_SESSION['userInfo']['address'] = $addressDetail . ', ' . $districtName . ', ' . $provinceName;
        }

        echo json_encode([
            "status" => "success",
            "user" => $_SESSION['userInfo']
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Không tìm thấy tên tỉnh hoặc quận."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Cập nhật địa chỉ thất bại."]);
}
?>
