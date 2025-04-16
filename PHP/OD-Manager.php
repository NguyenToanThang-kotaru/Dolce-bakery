<?php
include 'config.php';

$sql = "SELECT 
            orders.id AS order_id,
            DATE_FORMAT(orders.orderDate, '%d/%m/%Y') AS orderDate, -- chuyển về dd/mm/yyyy
            orders.totalPrice,
            orders.status,
            customers.fullName,
            customers.id AS customer_id
        FROM orders
        JOIN customers ON orders.customer_id = customers.id
        ORDER BY order_id ASC";

$result = $conn->query($sql);
if ($result->num_rows > 0){
    $temp = 0;
    while ($row = $result->fetch_assoc()) {
        $orderId =  $row['order_id'];
        echo "<tr data-id='$orderId'>";
        echo "<td>" . ++$temp . "</td>";
        echo "<td>" . htmlspecialchars($row['order_id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['customer_id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['fullName']) . "</td>";
        echo "<td>" . number_format($row['totalPrice']) . " đ</td>";
        echo "<td>" . htmlspecialchars($row['orderDate']) . "</td>";
        echo "<td style='text-align: center; vertical-align: middle;'>
                <i class='fa-solid fa-circle-info order-detail' data-id='$orderId' style='cursor:pointer;'></i>
              </td>";
        echo "<td>
                <select class='order-status' data-id='$orderId'>
                    <option value='1' " . ($row['status'] == 1 ? "selected" : "") . ">Chờ xử lí</option>
                    <option value='2' " . ($row['status'] == 2 ? "selected" : "") . ">Đã xử lí</option>
                    <option value='3' " . ($row['status'] == 3 ? "selected" : "") . ">Đang giao</option>
                    <option value='4' " . ($row['status'] == 4 ? "selected" : "") . ">Đã giao</option>
                    <option value='5' " . ($row['status'] == 5 ? "selected" : "") . ">Đã hủy</option>
                </select>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='8' style='text-align: center;'>Không có đơn hàng nào</td></tr>";
}
?>
<script>

    // Dùng ajax xem chi tiết theo từng đơn hàng
    document.addEventListener("DOMContentLoaded", function () {
        const table = document.querySelector(".order-table");
        const detailContainer = document.querySelector(".order-detail-container");

        document.addEventListener("click", function (event) {
            let target = event.target;

            if (target.classList.contains("order-detail")) {
                const orderId = target.getAttribute("data-id");

                table.style.display = "none";

                fetch("../../PHP/OD-get_order_detail.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: `id=${orderId}`
                })
                .then(response => response.text())
                .then(html => {
                    detailContainer.innerHTML = html;
                    detailContainer.style.display = "block";
                })
                .catch(error => console.error("Lỗi khi tải chi tiết đơn hàng:", error));
            }

            if (target.classList.contains("back-orderdetail")) {
                    detailContainer.style.display = "none";
                    table.style.display = "table";
                }
        });
    });

    // Thay đổi trạng thái
    document.addEventListener("DOMContentLoaded", function() {
        document.addEventListener("change", function (event) {
            if (event.target.classList.contains("order-status")) {
                let orderId = event.target.getAttribute("data-id");
                let newStatus = event.target.value;

                fetch("../../PHP/OD-update_status.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: `id=${orderId}&status=${newStatus}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(`Trạng thái của tài khoản ${orderId} đã được cập nhật!`);
                    } else {
                        alert("Lỗi khi cập nhật trạng thái: " + data.message);
                    }
                })
                .catch(error => console.error("Lỗi:", error));
            }
        });
    });

    // Màu sắc cho các select trạng thái
    document.addEventListener("DOMContentLoaded", function() {
        const statusElements = document.querySelectorAll(".order-status");
        function ChangeStatus(event) {
            let select = event.target;
            let value = select.value;

            switch (value) {
                case "1": // Chờ xử lý
                    select.style.boxShadow = "0 0 5px 1px #ff9800 ";
                    break;
                case "2": // Đã xử lý
                    select.style.boxShadow = "0 0 5px 1px #90EE90 ";
                    break;
                case "3": // Đang giao
                    select.style.boxShadow = "0 0 5px 1px #2196f3 ";
                    break;
                case "4": // Đã giao
                    select.style.boxShadow = "0 0 5px 1px #006400 ";
                    break;
                case "5": // Đã hủy
                    select.style.boxShadow = "0 0 5px 1px #f44336 ";
                    break;
                default:
                    select.style.boxShadow = "none";
            }
        }

        statusElements.forEach(select => {
        select.addEventListener("change",ChangeStatus);
        ChangeStatus({target: select });
        })
    });
</script>




