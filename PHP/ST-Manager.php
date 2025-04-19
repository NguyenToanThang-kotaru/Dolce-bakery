<?php
    include 'config.php';

    $start_date = $_POST['start_date'] ?? "";
    $end_date = $_POST['end_date'] ?? "";
    $sort = $_POST['sort'] ?? "";

    // kiểm tra đầu vào
    if (empty($start_date) || empty($end_date)) {
        echo "<tr><td colspan='5' style='text-align: center;'>Vui lòng chọn khoảng thời gian</td></tr>";
        return;
    }
    // lọc theo khoảng thời gian
    $where = [];
    if (!empty($start_date)) {
        $where[] = "DATE(orders.orderDate) >= '" . $conn->real_escape_string($start_date) . "'";
    }
    if (!empty($end_date)) {
        $where[] = "DATE(orders.orderDate) <= '" . $conn->real_escape_string($end_date) . "'";
    }

    $whereSQL = "";
    if (!empty($where)) {
        $whereSQL = "WHERE " . implode(" AND ", $where);
    }

    // lấy top 5 khách có tổng mua cao nhất, đơn hàng phải có trạng thái "đã giao"
    $innerSQL = "
        SELECT 
            customers.id AS customer_id,
            customers.fullName,
            SUM(orders.totalPrice) AS totalAmount
        FROM customers
        LEFT JOIN orders ON orders.customer_id = customers.id
        $whereSQL and orders.status = 4 
        GROUP BY customers.id, customers.fullName
        ORDER BY totalAmount DESC
        LIMIT 5
    ";

    // sắp xếp lại theo yêu cầu người dùng
    $sortSQL = "";
    if ($sort == 1) {
        $sortSQL = "ORDER BY totalAmount ASC";
    } elseif ($sort == 2) {
        $sortSQL = "ORDER BY totalAmount DESC";
    }

    // gộp với phần sắp xếp
    $sql = "SELECT * FROM ($innerSQL) AS top_customers $sortSQL";

    $temp = 0;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cusId = $row['customer_id'];
            echo "<tr data-id='$cusId'>";
            echo "<td>" . ++$temp . "</td>";
            echo "<td>" . htmlspecialchars($row['customer_id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['fullName']) . "</td>";
            echo "<td>" . number_format($row['totalAmount']) . " đ</td>";
            echo "<td style='text-align: center; vertical-align: middle;'>
                    <i class='fa-solid fa-circle-info orders-detail' data-id='$cusId' style='cursor:pointer;'></i>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8' style='text-align: center;'>Không có khách hàng nào</td></tr>";
    }
?>
<script>
 
</script>