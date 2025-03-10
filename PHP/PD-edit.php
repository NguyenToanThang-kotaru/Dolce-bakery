<?php
// include 'config.php';

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $id = $_POST['id']; // Lấy ID sản phẩm từ form
//     $name = $_POST['product-name'];
//     $type = $_POST['product-type'];
//     $quantity = $_POST['product-quantity'];
//     $price = $_POST['product-price'];
//     $image = $_FILES['product-image']['name'];
//     $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/Dolce-bakery/assest/PD-Manager/"; // Thư mục lưu ảnh
//     $target_file = $target_dir . basename($image);
    
//     echo "$target_file";
//     // Tải ảnh lên
//     if (move_uploaded_file($_FILES['product-image']['tmp_name'], $target_file)) {
//         echo "Ảnh đã được tải lên thành công.";
//         $target_file = "/Dolce-bakery/assest/PD-Manager/".basename($image);
//     } else {
//         $sql = "SELECT image FROM products WHERE id = ?";
//         $stmt = $conn->prepare($sql);
//         $stmt->bind_param("i", $id);
//         $stmt->execute();
//         $stmt->bind_result($old_image);
//         $stmt->fetch();
//         $target_file = $old_image; // Giữ ảnh cũ nếu không có ảnh mới
//         $stmt->close(); // Sử dụng ảnh mặc định khi tải ảnh không thành công
//     }

//     // Cập nhật thông tin sản phẩm trong database
//     $sql = "UPDATE products SET image = ?, name = ?, type = ?, quantity = ?, price = ? WHERE id = ?";
//     $stmt = $conn->prepare($sql);
//     $stmt->bind_param("sssiii",$target_file, $name, $type, $quantity, $price, $id);

//     if ($stmt->execute()) {
//         echo json_encode(["success" => true]);
//     } else {
//         echo json_encode(["success" => false]);
//     }
// }





include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['product-id'];
    $name = $_POST['product-name'];
    $type = $_POST['product-type'];
    $quantity = $_POST['product-quantity'];
    $price = $_POST['product-price'];
    $image_path = null;

    // Nếu có file ảnh, xử lý upload
    if (!empty($_FILES['product-image']['name'])) {
        $image = $_FILES['product-image']['name'];
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/Dolce-bakery/assest/PD-Manager/"; 
        $target_file = $target_dir . basename($image);

        if (move_uploaded_file($_FILES['product-image']['tmp_name'], $target_file)) {
            $image_path = "/Dolce-bakery/assest/PD-Manager/" . basename($image);
        }
    } else {
        // Nếu không có ảnh mới, giữ ảnh cũ
        $sql = "SELECT image FROM products WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($old_image);
        $stmt->fetch();
        $stmt->close();
        $image_path = $old_image;
    }

    // Cập nhật dữ liệu
    $sql = "UPDATE products SET image = ?, name = ?, type = ?, quantity = ?, price = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssiii", $image_path, $name, $type, $quantity, $price, $id);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false]);
    }

    $stmt->close();
    $conn->close();
}

?>
