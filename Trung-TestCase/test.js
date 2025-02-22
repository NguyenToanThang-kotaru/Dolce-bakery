

    const product = 8; 
    const product_frame = document.querySelectorAll(".product-frame");
    const pagination = document.querySelector(".pagination");

    const totalPage =  Math.ceil(product_frame.length * 4 / product); 
   
  
    function showPage(pageNumber) {
      const start = (pageNumber - 1) * product;
      const end = start + product;
  
      product_frame.forEach((frame, index) => {
        if (index * 4 >= start && index * 4 < end) {  
          frame.style.display = "flex";
        } else {
          frame.style.display = "none";
        }
      });
  
      AddPagination(pageNumber);
    }
  
    function AddPagination(activePage) {
      pagination.innerHTML = "";
      for (let i = 1; i <= totalPage; i++) {
        const page_btn = document.createElement("div");
        page_btn.classList.add("page");
        page_btn.textContent = i;
  
        if (i === activePage) {
          page_btn.classList.add("active");
        }
  
        page_btn.addEventListener("click", function () {
          showPage(i);
        });
  
        pagination.appendChild(page_btn);
      }
    }
  
    showPage(1);