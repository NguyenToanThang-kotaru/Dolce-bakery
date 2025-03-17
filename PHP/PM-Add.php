<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Kiểm tra xem các trường có tồn tại trong mảng $_POST hay không
    $name = isset($_POST['role-name']) ? $_POST['role-name'] : null;
 
    
}
?>
