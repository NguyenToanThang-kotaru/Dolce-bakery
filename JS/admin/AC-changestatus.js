
// Thay đổi trạng thái AC
$(document).ready(function() {
    $(".account-status").change(function() {
        let userId = this.getAttribute("data-id");
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





