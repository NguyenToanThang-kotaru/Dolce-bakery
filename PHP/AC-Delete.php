<?php
    include 'config.php';
    if($_SERVER['REQUEST_METHOD'] === 'POST'&&isset($_POST['id'])){
        $id = $_POST['id'];
        $stmt_permission = $conn->prepare("SELECT name FROM permissions p JOIN employeeaccount e ON p.id = e.permission_id WHERE e.id = ?");
        $stmt_permission->bind_param("i", $id);

        $stmt_permission->execute();
        $result_permission = $stmt_permission->get_result();
        $permission_name = "";
        if ($row = $result_permission->fetch_assoc()) {
            $permission_name = $row['name'];
        }
        if ($permission_name == "Admin") {
            echo json_encode(["success" => false, "message" => "Không thể xóa tài khoản Admin!"]);
            exit();
        }

        $AC_delete=("DELETE FROM employeeaccount where id = $id");
        if ($conn->query($AC_delete) === TRUE) {
            echo json_encode(["success" => true]);
            
        } else {
            echo json_encode(["success" => false]); 
        }
        $conn->close();
        exit;
    }

?>