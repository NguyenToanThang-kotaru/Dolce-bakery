<?php
include 'config.php';

$response = []; // Mảng chứa phản hồi

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['product-name'] ?? null;
    $type = $_POST['product-type'] ?? null;
    $quantity = $_POST['product-quantity'] ?? null;
    $price = $_POST['product-price'] ?? null;

    $noneIMG = "/Dolce-bakery/assest/PD-Manager/Default.jpg";

    if (isset($_FILES['product-image']) && $_FILES['product-image']['error'] == UPLOAD_ERR_OK) {
        $image = $_FILES['product-image']['name'];
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/Dolce-bakery/assest/PD-Manager/";
        $target_file = $target_dir . basename($image);

        if (move_uploaded_file($_FILES['product-image']['tmp_name'], $target_file)) {
            $target_file = "/Dolce-bakery/assest/PD-Manager/" . basename($image);
        } else {
            $target_file = $noneIMG;
        }
    } else {
        $target_file = $noneIMG;
    }

    $sql = "INSERT INTO products (name, type, quantity, price, image) 
            VALUES ('$name', '$type', '$quantity', '$price', '$target_file')";

    if ($conn->query($sql) === TRUE) {
        $response = [
            "success" => true,
            "message" => "Sản phẩm đã được thêm thành công!",
            "product" => [
                "id" => $conn->insert_id,
                "image" => $target_file,
                "name" => $name,
                "type" => $type,
                "quantity" => $quantity,
                "price" => number_format($price, 0, ',', '.') . " VND"
            ]
        ];
    } else {
        $response = ["success" => false, "message" => "Lỗi: " . $conn->error];
    }

    // Đóng kết nối và trả kết quả JSON
    $conn->close();
    echo json_encode($response);
    exit();
}
?>