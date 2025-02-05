<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Kiểm tra xem các trường có tồn tại trong mảng $_POST hay không
    $name = isset($_POST['product-name']) ? $_POST['product-name'] : null;
    $type = isset($_POST['product-type']) ? $_POST['product-type'] : null;
    $quantity = isset($_POST['product-quantity']) ? $_POST['product-quantity'] : null;
    $price = isset($_POST['product-price']) ? $_POST['product-price'] : null;

    // Khai báo đường dẫn ảnh mặc định
    $noneIMG = "/Dolce-bakery/assest/PD-Manager/Default.jpg";  // Ảnh mặc định khi không có ảnh tải lên

    // Kiểm tra xem file ảnh có được tải lên hay không
    if (isset($_FILES['product-image']) && $_FILES['product-image']['error'] == UPLOAD_ERR_OK) {
        $image = $_FILES['product-image']['name'];
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/Dolce-bakery/assest/PD-Manager/"; // Thư mục lưu ảnh
        $target_file = $target_dir . basename($image);

        echo "$target_file";
        // Tải ảnh lên
        if (move_uploaded_file($_FILES['product-image']['tmp_name'], $target_file)) {
            echo "Ảnh đã được tải lên thành công.";
            $target_file = "/Dolce-bakery/assest/PD-Manager/".basename($image);
        } else {
            echo "Lỗi khi tải ảnh lên.";
            echo "Mã lỗi: " . $_FILES['product-image']['error'];
            $target_file = $noneIMG; // Sử dụng ảnh mặc định khi tải ảnh không thành công
        }
    } else {
        // Nếu không có ảnh, sử dụng ảnh mặc định
        $target_file = $noneIMG;
    }

    // Thực hiện câu lệnh SQL để thêm sản phẩm vào cơ sở dữ liệu
    $sql = "INSERT INTO products (name, type, quantity, price, image) VALUES ('$name', '$type', '$quantity', '$price', '$target_file')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../HTML/admin/admin.php");
        echo "Sản phẩm đã được thêm thành công!";
        exit();

    } else {
        echo "Lỗi: " . $conn->error;
    }

    // Đóng kết nối
    $conn->close();
}
?>
