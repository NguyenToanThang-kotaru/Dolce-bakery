 <?php
include 'config.php'; 

$sql = "SELECT 
    p.id AS permission_id,
    p.name AS 'P_NAME', 
    GROUP_CONCAT(DISTINCT f.name ORDER BY f.name SEPARATOR '|') AS 'F_NAME',
    COUNT(DISTINCT u.id) AS 'AC_COUNT',
    GROUP_CONCAT(DISTINCT u.userName ORDER BY u.userName SEPARATOR '|') AS 'USER_LIST'
FROM permissions p
LEFT JOIN permission_function pf ON p.id = pf.permission_id
LEFT JOIN functions f ON pf.function_id = f.id
LEFT JOIN users u ON p.id = u.permission_id
GROUP BY p.id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $permissionId = $row['permission_id'];
        $users = !empty($row['USER_LIST']) ? explode('|', $row['USER_LIST']) : [];

        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['P_NAME']) . "</td>";

        // Chức năng
        echo "<td class='list-role-function'>";
        $functions = explode('|', $row['F_NAME']);
        foreach ($functions as $function) {
            echo "<div class='role-function'>" . htmlspecialchars($function) . "</div>";
        }
        echo "</td>";

        // Số lượng tài khoản
        echo "<td>" . $row['AC_COUNT'] . "</td>";

        // Danh sách người dùng
        echo "<td class='role-account'>";
        echo "<img src='../../assest/Download cloud.png' alt='' class='show-userrole' data-id='$permissionId'>";
        echo "</td>";
        echo "<div id='account-overlay-role'>";
        echo    "<div class='account-role-container' style='display: none;'>";
        echo        "<img src='../../assest/Chevron down.png' alt=''>";
        echo        "<div class='list-user-role' id='account-list-$permissionId' style='display: none;'>";
        if (!empty($users)) {
            foreach ($users as $user) {
                echo"<div class='user-role'>" . htmlspecialchars($user) . "</div>";
            }
        } else {
            echo    "<p class='user-role'>Không có tài khoản nào.</p>";
        }
        echo    "</div>";
        echo "</div>"; 

        // Edit
        echo "<td>
                <div class='fix-role'>
                    <i class='fa-solid fa-pen-to-square fix-btn-role'></i>
                    <i class='fa-solid fa-trash delete-btn-role'></i>
                </div>
              </td>";

        echo "</tr>";
    }
} else {
    echo "<tr><td style='text-align: center;' colspan='5'>Không có dữ liệu</td></tr>";
}


?>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    function attachUserRoleClickEvents() {
        document.querySelectorAll(".show-userrole").forEach(function (img) {
            img.onclick = function (event) {
                event.stopPropagation(); // Ngăn chặn sự kiện click lan ra ngoài

                let permissionId = this.getAttribute("data-id"); // Lấy ID quyền hạn
                let accountContainer = document.getElementById(`account-list-${permissionId}`);


                // Ẩn tất cả danh sách khác trước khi mở danh sách mới
                // document.querySelectorAll(".account-role-container").forEach(function (container) {
                //     if (container !== accountContainer) {
                //         container.style.display = "none";
                //     }
                // });

                // Toggle hiển thị danh sách user
                if (accountContainer) {
                    let parentContainer = accountContainer.closest(".account-role-container");
                    if (parentContainer) {
                        parentContainer.style.display = (parentContainer.style.display === "none") ? "block" : "none";
                    }
                    accountContainer.style.display = (accountContainer.style.display === "none") ? "block" : "none";
                }

            };
        });
    }

    attachUserRoleClickEvents();

    // Ẩn danh sách click ra ngoài
    document.addEventListener("click", function (event) {
        if (!event.target.closest(".account-role-container") && !event.target.classList.contains("show-userrole")) {
            document.querySelectorAll(".account-role-container").forEach(function (container) {
                container.style.display = "none";
            });
        }
    });
});

</script>

 