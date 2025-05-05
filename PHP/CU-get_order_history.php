<?php
include 'config.php';

$customerId = $_POST['id'] ?? 0;

$sql = "SELECT 
            o.id AS order_id,
            o.orderDate,
            o.totalPrice,
            o.addressDetail,
            os.name AS order_status,
            od.product_id,
            p.pd_name,
            od.quantity,
            od.price,
            c.fullName,
            pv.name AS province_name,
            d.name AS district_name
        FROM `orders` o
        JOIN orderdetail od ON o.id = od.order_id
        JOIN products p ON od.product_id = p.id
        JOIN customers c ON o.customer_id = c.id
        JOIN orderstatus os ON o.status = os.id
        JOIN provinces pv ON o.province_id = pv.id
        JOIN districts d ON o.district_id = d.id
        WHERE c.id = ?
        ORDER BY o.id ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $customerId);
$stmt->execute();
$result = $stmt->get_result();

$customerName = '';
$currentOrderId = 0;
$currentTotalPrice = '';
$currentOrderStatus = '';
$orderDate='';
$hasOrders = false;

echo "<i class='fa-solid fa-rotate-left back-customer2'></i>";

// Duyệt qua kết quả
while ($row = $result->fetch_assoc()) {
    $orderId = $row['order_id'];
    $productName = $row['pd_name'];
    $quantity = $row['quantity'];
    $price = number_format($row['price']);
    $customerName = $row['fullName'];
    $addressDetail = $row['addressDetail'];
    $district_name = $row['district_name'];
    $province_name = $row['province_name'];


    // Khi gặp một đơn hàng mới
    if ($currentOrderId != $orderId) {
        // Nếu không phải là đơn đầu tiên, kết thúc đơn trước
        if ($currentOrderId != 0) {
            echo "</tbody></table>
                  <div class='order-summary'>
                    <p><strong>Tổng tiền:</strong> {$currentTotalPrice} đ</p>
                    <p><strong>Ngày đặt:</strong> {$orderDate}</p>
                    <p><strong>Trạng thái đơn hàng:</strong> {$currentOrderStatus}</p>
                    <br>
                    <p style='margin-top: 5px;'><strong>Địa chỉ giao hàng:</strong> $addressDetail, $district_name, $province_name</p>
                  </div>
                </div>";
        }

        // Gán lại thông tin đơn hàng mới
        $currentOrderId = $orderId;
        $currentTotalPrice = number_format($row['totalPrice']);
        $currentOrderStatus = $row['order_status'];
        $orderDate = $row['orderDate'];

        // Hiển thị tên khách hàng và tiêu đề nếu là đơn đầu tiên
        if (!$hasOrders) {
            echo "<div id='cus-identity'>
                    <span>Khách hàng:</span>
                    <h4>" . htmlspecialchars($customerName) . "</h4>
                  </div>
                  <h3 style='color: #3C8DBC; text-align: center;'>Đơn hàng đã mua</h3>";
            $hasOrders = true;
        }

        // Mở wrapper cho đơn mới
        echo "<div class='history-order-wrapper'>
                <div class='order-id' style='text-align: center;'>Đơn hàng {$orderId}</div>
                <table class='history-order-table'>
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>";
    }

    // Hiển thị sản phẩm của đơn hiện tại
    echo "<tr>
            <td>" . htmlspecialchars($productName) . "</td>
            <td>{$quantity}</td>
            <td>{$price} đ</td>
          </tr>";
}

// Kết thúc đơn cuối cùng
if ($currentOrderId != 0) {
    echo "</tbody></table>
          <div class='order-summary'>
            <p><strong>Tổng tiền:</strong> {$currentTotalPrice} đ</p>
            <p><strong>Ngày đặt:</strong> {$orderDate}</p>
            <p><strong>Trạng thái đơn hàng:</strong> {$currentOrderStatus}</p>
            <br>
            <p style='margin-top: 5px;'><strong>Địa chỉ giao hàng:</strong> $addressDetail, $district_name, $province_name</p>
          </div>
        </div>";
}

// Nếu không có đơn hàng nào
if (!$hasOrders) {
    echo "<p style='text-align:center; color:red;'>Không tìm thấy đơn hàng nào!</p>";
}
?>
