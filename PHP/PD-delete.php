<?php
    include 'config.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $drop_IMGPD = ("SELECT image FROM products where id =$id");
        $drop_IMGPD = $conn->query($drop_IMGPD);
        $row = $drop_IMGPD->fetch_assoc();
        $imagePath = $_SERVER['DOCUMENT_ROOT'] . $row['image'];
        $PD_delete=("DELETE FROM products where id = $id");
        if ($conn->query($PD_delete) === TRUE) {
            if ($row['image'] != "/Dolce-bakery/assest/PD-Manager/Default.jpg") {
                unlink($imagePath);
            }            
            header("Location: ../HTML/admin/admin.php");
            echo "Sản phẩm đã được xóa thành công!";
            exit();
    
        } else {
            echo "Lỗi: " . $conn->error; 
        }
    }

?>