<?php
session_start();
include '../config/database.php';
include '../config/functions.php';

// Kiểm tra đăng nhập
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Kiểm tra ID phiếu nhập
if (!isset($_GET['id'])) {
    header("Location: import.php");
    exit();
}

$import_id = $_GET['id'];

// Lấy thông tin phiếu nhập
$sql = "SELECT i.*, s.name as supplier_name, s.phone as supplier_phone, s.address as supplier_address
        FROM imports i 
        LEFT JOIN suppliers s ON i.supplier_id = s.id 
        WHERE i.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $import_id);
$stmt->execute();
$result = $stmt->get_result();
$import = $result->fetch_assoc();

if (!$import) {
    header("Location: import.php");
    exit();
}

// Lấy chi tiết các sản phẩm trong phiếu nhập
$sql = "SELECT id.*, p.name as product_name, p.unit
        FROM import_details id
        LEFT JOIN products p ON id.product_id = p.id
        WHERE id.import_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $import_id);
$stmt->execute();
$details = $stmt->get_result();

// Tính tổng tiền
$total_amount = 0;
$details_array = [];
while($detail = $details->fetch_assoc()) {
    $detail['subtotal'] = $detail['quantity'] * $detail['price'];
    $total_amount += $detail['subtotal'];
    $details_array[] = $detail;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết phiếu nhập - Dolce Bakery</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Chi tiết phiếu nhập #<?php echo $import['code']; ?></h2>
            <a href="import.php" class="btn btn-secondary">Quay lại</a>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Thông tin phiếu nhập</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Mã phiếu:</strong> <?php echo $import['code']; ?></p>
                        <p><strong>Ngày nhập:</strong> <?php echo date('d/m/Y H:i', strtotime($import['created_at'])); ?></p>
                        <p><strong>Trạng thái:</strong> 
                            <?php if($import['status'] == 1): ?>
                                <span class="badge bg-success">Hoàn thành</span>
                            <?php else: ?>
                                <span class="badge bg-warning">Đang xử lý</span>
                            <?php endif; ?>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Nhà cung cấp:</strong> <?php echo $import['supplier_name']; ?></p>
                        <p><strong>Điện thoại:</strong> <?php echo $import['supplier_phone']; ?></p>
                        <p><strong>Địa chỉ:</strong> <?php echo $import['supplier_address']; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Chi tiết sản phẩm</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn vị</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $stt = 1;
                            foreach($details_array as $detail): 
                            ?>
                            <tr>
                                <td><?php echo $stt++; ?></td>
                                <td><?php echo $detail['product_name']; ?></td>
                                <td><?php echo number_format($detail['quantity']); ?></td>
                                <td><?php echo $detail['unit']; ?></td>
                                <td><?php echo number_format($detail['price']); ?> VNĐ</td>
                                <td><?php echo number_format($detail['subtotal']); ?> VNĐ</td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-end"><strong>Tổng tiền:</strong></td>
                                <td><strong><?php echo number_format($total_amount); ?> VNĐ</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 