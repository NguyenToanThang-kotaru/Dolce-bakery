
// Thay đổi trạng thái AC
$(document).ready(function() {
    $(".account-status").change(function() {
        var userId = $(this).data("userid");
        var newStatus = $(this).val();
        console.log('hi');

        $.ajax({
            url: "../../PHP/AC-update_status.php",
            type: "POST",
            data: { id: userId, status: newStatus },
            success: function(response) {
                if (response.trim() === "success") {
                    alert("Trạng thái đã được cập nhật!");
                } else {
                    alert("Lỗi từ server: " + response);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("AJAX Error: " + textStatus + " - " + errorThrown);
            }
        });
    });
});

// $(document).ready(function () {
//     $(document).on('change', '.permission-checkbox', function () {
//       let userId = $(this).data('user');
//       let permission = $(this).val();
//       let checked = $(this).is(':checked');
      

//       $.post('../../PHP/AC-update_permissions_ajax.php', {
//         userId: userId,
//         permission: permission,
//         checked: checked
//       }, function (response) {
//         alert(response);
//       });
//     });
//   });

// Cập nhật quyền
$(document).ready(function() {
    $('input[name="permissions[]"]').on('change', function() {
        let userId = $(this).attr("data-userid");
        let checkedPermissions = [];

        $('input[name="permissions[]"]:checked').each(function() {
            checkedPermissions.push($(this).val());
        });

        console.log("Dữ liệu gửi đi:", { userId, permissions: checkedPermissions });

        $.ajax({
            url: '../../PHP/AC-update_permissions_ajax.php',
            type: 'POST',
            data: { userId: userId, permissions: checkedPermissions },
            success: function(response) {
                console.log("Phản hồi từ server:", response);
                $('#result').html(response);
                
                alert("Cập nhật quyền thành công!");
            },
            error: function(xhr, status, error) {
                console.error("Lỗi AJAX:", status, error);
                console.error("Chi tiết lỗi:", xhr.responseText);
                alert("Có lỗi xảy ra!");
            }
        });
    });
});



