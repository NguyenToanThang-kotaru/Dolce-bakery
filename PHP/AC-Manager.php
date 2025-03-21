<?php
include 'config.php';

$sql = "SELECT users.*, permissions.name as p_name
        FROM users 
        LEFT JOIN permissions ON users.permission_id = permissions.id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $status = $row['status'];  
        $userId = $row['id'];
        $permission_id = $row['permission_id'];
        $permission_name = $row['p_name'];
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['userName']) . "</td>";
        echo "<td>" . htmlspecialchars($row['password']) . "</td>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
        echo "<td>
                <select class='account-status' data-userid='" . $row['id'] . "'>
                    <option value='1' " . ($status == 1 ? "selected" : "") . ">Đang hoạt động</option>
                    <option value='2' " . ($status == 2 ? "selected" : "") . ">Đã khóa</option>
                </select>
              </td>";
         echo "<td>
         <div style = 'display: flex;'>
            <span style='margin-left: 10px; font-weight: bold;'>" . htmlspecialchars($permission_name) . "</span>
         </div>
    
         </td>";
         echo "<td>
         <div class='fix-account'>
             <i class='fa-solid fa-pen-to-square fix-btn-account' data-id='$userId'></i>
             <i class='fa-solid fa-trash delete-btn-account' data-id='$userId'></i>
         </div>
         </td>";
         echo "</tr>";
         echo "<div id='role-popup'>  
                    
               <div class='popup-arrow'></div>
               </div>";
    }
} else {
    echo "<tr><td colspan='4'>Không có tài khoản nào</td></tr>";
}
?>
    <!-- hop thoai xoa AC -->
    <div id="delete-overlay-account">
        <div class="delete-container">
          <span>Bạn muốn xóa tài khoản này?</span>
          <button id="delete-acp-account">Xác nhận</button>
          <button id="cancel-account">Hủy</button>  
        </div>
    </div>


<script>
    
    //Delete
    document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.delete-btn-account').forEach(button => {
        button.addEventListener('click', function() {
            let accountId = this.getAttribute('data-id');
            let deleteOverlay = document.getElementById('delete-overlay-account');
            deleteOverlay.style.display = 'block';
            document.getElementById('delete-acp-account').setAttribute('data-id', accountId);
        });
    });

    document.getElementById('delete-acp-account').addEventListener('click', function() {
        let accountId = this.getAttribute('data-id');
        console.log(accountId);
        
        window.location.href = '../../PHP/AC-Delete.php?id=' + accountId;
    });

    document.getElementById('cancel-account').addEventListener('click', function() {
        document.getElementById('delete-overlay-account').style.display = 'none';
    });
    });
    
    //Edit
    document.querySelectorAll('.fix-btn-account').forEach(button => {
    button.addEventListener('click', function() {
        let accountId = this.getAttribute('data-id'); 
        document.getElementById('account-id').value = accountId; 
    });
});


</script>




