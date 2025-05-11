<?php
session_start();
include '../config.php';
$customer_id = $_SESSION['userInfo']['userID']; 

$query = "
            SELECT 
                ca.id, 
                ca.addressDetail, 
                ca.default_id, 
                ca.district_id, 
                ca.province_id,
                d.name AS district_name,
                p.name AS province_name
            FROM 
                customeraddress ca
            LEFT JOIN 
                districts d ON ca.district_id = d.id
            LEFT JOIN 
                provinces p ON ca.province_id = p.id
            WHERE 
                ca.customer_id = ?
            ";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();

$addresses = [];
while ($row = $result->fetch_assoc()) {
    // Nối địa chỉ đầy đủ
    $row['fullAddress'] = $row['addressDetail'] . ', ' . $row['district_name'] . ', ' . $row['province_name'];
    $addresses[] = [
        'id' => $row['id'],
        'addressDetail' => $row['addressDetail'],
        'district_id' => $row['district_id'],
        'province_id' => $row['province_id'],
        'fullAddress' => $row['fullAddress'],
        'default_id' => $row['default_id'],
    ];
}

echo json_encode([
    "status" => "success",
    "data" => $addresses
]);

$stmt->close();
$conn->close();
?>
