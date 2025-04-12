<?php
session_start();
unset($_SESSION['adminInfo']);
session_destroy(); 
header("Location: login_admin.php"); 
exit();
?>
