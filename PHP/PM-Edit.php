<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['role-id'])) {
    $id = intval($_POST['role-id']);
    $name = trim($_POST['role-name']);
    $permissions = isset($_POST['permissions']) ? $_POST['permissions'] : [];

    $sql = "UPDATE permissions SET name = ? WHERE id = ?"; // cập nhật tên quyền
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $name, $id);
    $updateSuccess = $stmt->execute();
    $stmt->close();

    if ($updateSuccess) {
        $conn->query("DELETE FROM permission_function WHERE permission_id = $id"); //Xóa CN cũ
        $stmt = $conn->prepare("INSERT INTO permission_function (permission_id, function_id) VALUES (?, ?)");
        foreach ($permissions as $functionId) {
            $stmt->bind_param("ii", $id, $functionId);
            $stmt->execute();
        }
        $stmt->close();

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}

$conn->close();
?>
