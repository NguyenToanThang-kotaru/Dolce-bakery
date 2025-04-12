// Lấy loại theo chủng loại

document.addEventListener("DOMContentLoaded", function () {
    // ----------- Form Thêm Sản Phẩm -----------
    const subcategoryAdd = document.getElementById("product-subcategory");
    const categoryAdd = document.getElementById("product-category");
  
    if (subcategoryAdd && categoryAdd) {
      subcategoryAdd.addEventListener("change", function () {
        const subcategoryId = this.value;
  
        fetch("../../PHP/PD-getCategory.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: "subcategory_id=" + encodeURIComponent(subcategoryId),
        })
          .then((response) => response.text())
          .then((data) => {
            categoryAdd.innerHTML = data;
          })
          .catch((error) => {
            console.error("Lỗi khi tải loại sản phẩm (thêm):", error);
            categoryAdd.innerHTML = "<option value=''>Không thể tải dữ liệu</option>";
          });
      });
    }
  
    // ----------- Form Sửa Sản Phẩm -----------
    const subcategoryFix = document.getElementById("product-subcategoryFIX");
    const categoryFix = document.getElementById("product-categoryFIX");
  
    if (subcategoryFix && categoryFix) {
      subcategoryFix.addEventListener("change", function () {
        const subcategoryId = this.value;
  
        fetch("../../PHP/PD-getCategory.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: "subcategory_id=" + encodeURIComponent(subcategoryId),
        })
          .then((response) => response.text())
          .then((data) => {
            categoryFix.innerHTML = data;
          })
          .catch((error) => {
            console.error("Lỗi khi tải loại sản phẩm (sửa):", error);
            categoryFix.innerHTML = "<option value=''>Không thể tải dữ liệu</option>";
          });
      });
    }
  });