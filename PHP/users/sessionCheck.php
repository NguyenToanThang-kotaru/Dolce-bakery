<?php
session_start();

if (isset($_SESSION['userInfo'])) {
    echo json_encode([
        "loggedIn" => true,
        "user" => $_SESSION['userInfo']
    ]);
} else {
    echo json_encode(["loggedIn" => false]);
}
exit();
