<?php
include 'config.php';

$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['product-id'];
    $name = $_POST['product-name'];
    $subcategory_id = $_POST['product-subcategory'];
    $price = $_POST['product-price'];
    $supplier_id = $_POST['product-supplier'];
    $shelflife = $_POST['product-shelflife'];

    $noneIMG = "/Dolce-bakery/assest/PD-Manager/Default.jpg";
    $target_file = $noneIMG;

    if (isset($_FILES['product-image']) && $_FILES['product-image']['error'] == UPLOAD_ERR_OK) {
        $image = $_FILES['product-image']['name'];
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/Dolce-bakery/assest/PD-Manager/";
        $target_file = $target_dir . basename($image);

        if (move_uploaded_file($_FILES['product-image']['tmp_name'], $target_file)) {
            $target_file = "/Dolce-bakery/assest/PD-Manager/" . basename($image);
        } else {
            echo json_encode(["success" => false, "message" => "Lỗi khi tải ảnh lên."]);
            exit();
        }
    } else {
        // Lấy ảnh cũ nếu không upload mới
        $stmt = $conn->prepare("SELECT image FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($old_image);
        $stmt->fetch();
        $target_file = $old_image;
        $stmt->close();
    }

    // Lấy tên loại và danh mục
    $stmt = $conn->prepare("SELECT subcategories.name AS subcategory_name, categories.name AS category_name
                            FROM subcategories 
                            INNER JOIN categories ON subcategories.category_id = categories.id 
                            WHERE subcategories.id = ?");
    $stmt->bind_param("i", $subcategory_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $subcategory_name = "";
    $category_name = "";
    if ($row = $result->fetch_assoc()) {
        $subcategory_name = $row["subcategory_name"];
        $category_name = $row["category_name"];
    }
    $stmt->close();

    // Lấy quantity hiện tại
    $stmt = $conn->prepare("SELECT quantity FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($currentquantity);
    $stmt->fetch();
    $stmt->close();

    // Cập nhật sản phẩm
    $stmt = $conn->prepare("UPDATE products SET image = ?, pd_name = ?, subcategory_id = ?, supplier_id = ?, price = ?, shelfLife = ? WHERE id = ?");
    $stmt->bind_param("ssiiiii", $target_file, $name, $subcategory_id, $supplier_id, $price, $shelflife, $id);

    if ($stmt->execute()) {
        $response = [
            "success" => true,
            "message" => "Cập nhật sản phẩm thành công!",
            "product" => [
                "id" => $id,
                "image" => $target_file,
                "name" => $name,
                "category_name" => $category_name,
                "subcategory_name" => $subcategory_name,
                "quantity" => $currentquantity,
                "price" => number_format($price, 0, ',', '.') . " VND"
            ]
        ];
    } else {
        $response = ["success" => false, "message" => "Lỗi cập nhật: " . $conn->error];
    }

    $stmt->close();
    $conn->close();

    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
