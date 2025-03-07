<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chuyển Trang (Query Parameters)</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
</head>
<body>
  


  <!-- <form id="permissionForm">
    <input type="checkbox" name="permissions[]" value="1" data-user="1"> Xem dữ liệu <br>
    <input type="checkbox" name="permissions[]" value="2" data-user="1"> Chỉnh sửa dữ liệu <br>
    <input type="checkbox" name="permissions[]" value="3" data-user="1"> Xóa dữ liệu <br>
</form>
<div id="result"></div> -->

<div id="role-popup">
    <label for="role-select">Chọn quyền:</label>
    <select id="role-select" class="permission-select" multiple data-userid="<?= $userId ?>">
        <option value="5">Quản lí sản phẩm</option>
        <option value="4">Quản lí khách hàng</option>
        <option value="3">Quản lí nhà cung cấp</option>
        <option value="2">Quản lí người dùng</option>
        <option value="1">None</option>
    </select>
    <div class="popup-arrow"></div>
</div>

<script>
$(document).ready(function() {
  $('input[name="permissions[]"]').on('change', function() {
      let userId = $(this).data('user');  // Lấy ID người dùng
      let checkedPermissions = [];

      $('input[name="permissions[]"]:checked').each(function() {
          checkedPermissions.push($(this).val()); // Lưu danh sách quyền đã chọn
      });

      $.ajax({
          url: 'update_permissions.php',  // Server xử lý quyền
          type: 'POST',
          data: { userId: userId, permissions: checkedPermissions },
          success: function(response) {
              $('#result').html(response); // Hiển thị kết quả
          },
          error: function() {
              alert("Có lỗi xảy ra!");
          }
      });
  });
});

</script>
</body>
</html>
