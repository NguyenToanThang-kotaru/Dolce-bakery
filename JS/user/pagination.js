const product = 8; 

    const product_frame1 = document.querySelectorAll(".bread-product");
    const pagination1 = document.querySelector(".bread-pagination");
    const totalPage1 =  Math.ceil(product_frame1.length/ product);
    
    const product_frame2 = document.querySelectorAll(".cake-product");
    const pagination2 = document.querySelector(".cake-pagination");
    const totalPage2 =  Math.ceil(product_frame2.length/ product);
    
    const product_frame3 = document.querySelectorAll(".cookie-product");
    const pagination3 = document.querySelector(".cookie-pagination");
    const totalPage3 =  Math.ceil(product_frame3.length/ product); 
   
  
    function showPage1(pageNumber) {
      const start = (pageNumber - 1) * product;
      const end = start + product;
  
      product_frame1.forEach((frame, index) => {
        if (index >= start && index < end) {  
          frame.style.display = "flex";
        } else {
          frame.style.display = "none";
        }
      });
  
      AddPagination1(pageNumber);
    }

    function showPage2(pageNumber) {
      const start = (pageNumber - 1) * product;
      const end = start + product;
  
      product_frame2.forEach((frame, index) => {
        if (index >= start && index < end) {  
          frame.style.display = "flex";
        } else {
          frame.style.display = "none";
        }
      });
  
      AddPagination2(pageNumber);
    }

    function showPage3(pageNumber) {
      const start = (pageNumber - 1) * product;
      const end = start + product;
  
      product_frame3.forEach((frame, index) => {
        if (index >= start && index < end) {  
          frame.style.display = "flex";
        } else {
          frame.style.display = "none";
        }
      });
  
      AddPagination3(pageNumber);
    }
  
    function AddPagination1(activePage) {
      if(totalPage1 > 1){
      pagination1.innerHTML = "";
      for (let i = 1; i <= totalPage1; i++) {
        const page_btn = document.createElement("div");
        page_btn.classList.add("page");
        page_btn.textContent = i;
  
        if (i === activePage) {
          page_btn.classList.add("active");
        }
        
        page_btn.addEventListener("click", function () {
          showPage1(i);
        });
  
        pagination1.appendChild(page_btn);
      }
    }
    }
  
    showPage1(1);

    function AddPagination2(activePage) {
      if(totalPage2 > 1){
      pagination2.innerHTML = "";
      for (let i = 1; i <= totalPage1; i++) {
        const page_btn = document.createElement("div");
        page_btn.classList.add("page");
        page_btn.textContent = i;
  
        if (i === activePage) {
          page_btn.classList.add("active");
        }
        
        page_btn.addEventListener("click", function () {
          showPage2(i);
        });
  
        pagination2.appendChild(page_btn);
      }
    }
    }
  
    showPage2(1);

    function AddPagination3(activePage) {
      if(totalPage3 > 1){
      pagination3.innerHTML = "";
      for (let i = 1; i <= totalPage1; i++) {
        const page_btn = document.createElement("div");
        page_btn.classList.add("page");
        page_btn.textContent = i;
  
        if (i === activePage) {
          page_btn.classList.add("active");
        }
        
        page_btn.addEventListener("click", function () {
          showPage3(i);
        });
  
        pagination3.appendChild(page_btn);
      }
    }
    }
  
    showPage3(1);

    // block catelouge
    const bread_catelouge = document.querySelector(".bread-catelouge-container");
    const cake_catelouge = document.querySelector(".cake-catelouge-container");
    const cookie_catelouge = document.querySelector(".cookie-catelouge-container");
    const cart_shop = document.querySelector("#shopcart-container");

    const bread = document.querySelector("#bread-part");
    const cake = document.querySelector("#cake-part");
    const cookie = document.querySelector("#cookie-part");

    const slide = document.querySelector("#slideshow");
    const mainmenu = document.querySelector("#mainMenu");
    const brandstory = document.querySelector("#brandStory");

    const return_mainshop = document.querySelector("#return-mainshop"); 

    function showBread(){
        bread_catelouge.style.display = "flex";
        slide.style.display = "none";
        mainmenu.style.display = "none";
        brandstory.style.display = "none";
    }

    function showCookie(){
      cookie_catelouge.style.display = "flex";
      slide.style.display = "none";
      mainmenu.style.display = "none";
      brandstory.style.display = "none";
  }

  function showCake(){
    cake_catelouge.style.display = "flex";
    slide.style.display = "none";
    mainmenu.style.display = "none";
    brandstory.style.display = "none";
}

    function returnShop(){
      bread_catelouge.style.display = "none";
      cake_catelouge.style.display = "none";  
      cookie_catelouge.style.display = "none";
      cart_shop.style.display = "none"
      slide.style.display = "flex";
      mainmenu.style.display = "flex";
      brandstory.style.display = "flex";
    }

    bread.addEventListener("click",showBread);
    cake.addEventListener("click",showCake);
    cookie.addEventListener("click",showCookie);

    return_mainshop.addEventListener("click",returnShop);
  
//filter
function togglePopup(event) {
  let popup = document.getElementById("filter-popup");
  let icon = event.target;

  let rect = icon.getBoundingClientRect();
  let top = rect.bottom + window.scrollY + 8;
  let left = rect.left + window.scrollX;

  popup.style.top = `${top}px`;
  popup.style.left = `${left}px`;
  popup.style.display = popup.style.display === "block" ? "none" : "block";

  document.addEventListener("click", function hidePopup(e) {
      if (!popup.contains(e.target) && e.target !== icon) {
          popup.style.display = "none";
          document.removeEventListener("click", hidePopup);
      }
  });
} 