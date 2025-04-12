$(".logout-btn-admin").click(function () {
    $.ajax({
      type: "POST",
      url: "../../PHP/Logout_Admin.php",
      success: function () {
        window.location.href = "login_admin.php"; 
      }
    });
  });