<?php
include 'config.php';

$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['product-id']; // Lấy ID sản phẩm
    $name = $_POST['product-name'];
    $type = $_POST['product-type'];
    $quantity = $_POST['product-quantity'];
    $price = $_POST['product-price'];

    $noneIMG = "/Dolce-bakery/assest/PD-Manager/Default.jpg";  // Ảnh mặc định
    $target_file = $noneIMG;

    // Kiểm tra nếu có ảnh mới
    if (isset($_FILES['product-image']) && $_FILES['product-image']['error'] == UPLOAD_ERR_OK) {
        $image = $_FILES['product-image']['name'];
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/Dolce-bakery/assest/PD-Manager/";
        $target_file = $target_dir . basename($image);

        if (move_uploaded_file($_FILES['product-image']['tmp_name'], $target_file)) {
            $target_file = "/Dolce-bakery/assest/PD-Manager/" . basename($image);
        } else {
            $response = ["success" => false, "message" => "Lỗi khi tải ảnh lên."];
            echo json_encode($response);
            exit();
        }
    } else {
        // Nếu không có ảnh mới, lấy ảnh cũ
        $sql = "SELECT image FROM products WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($old_image);
        $stmt->fetch();
        $target_file = $old_image;
        $stmt->close();
    }

    // Cập nhật database
    $sql = "UPDATE products SET image = ?, name = ?, type = ?, quantity = ?, price = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssiii", $target_file, $name, $type, $quantity, $price, $id);

    if ($stmt->execute()) {
        $response = [
            "success" => true,
            "message" => "Cập nhật sản phẩm thành công!",
            "product" => [
                "id" => $id,
                "image" => $target_file,
                "name" => $name,
                "type" => $type,
                "quantity" => $quantity,
                "price" => number_format($price, 0, ',', '.') . " VND"
            ]
        ];
    } else {
        $response = ["success" => false, "message" => "Lỗi cập nhật: " . $conn->error];
    }

    $stmt->close();
    $conn->close();

    // Trả về JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}
?>
