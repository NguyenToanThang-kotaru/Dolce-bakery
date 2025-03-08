const product = 8;

const product_frame1 = document.querySelectorAll(".bread-product");
const pagination1 = document.querySelector(".bread-pagination");
const totalPage1 = Math.ceil(product_frame1.length / product);

const product_frame2 = document.querySelectorAll(".cake-product");
const pagination2 = document.querySelector(".cake-pagination");
const totalPage2 = Math.ceil(product_frame2.length / product);

const product_frame3 = document.querySelectorAll(".cookie-product");
const pagination3 = document.querySelector(".cookie-pagination");
const totalPage3 = Math.ceil(product_frame3.length / product);


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
  window.scrollTo({ top: 0, behavior: "smooth" });

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
  window.scrollTo({ top: 0, behavior: "smooth" });

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
  window.scrollTo({ top: 0, behavior: "smooth" });
}

function AddPagination1(activePage) {
  if (totalPage1 > 1) {
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
  console.log("da phan trang");
  if (totalPage2 > 1) {
    pagination2.innerHTML = "";
    for (let i = 1; i <= totalPage2; i++) {
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
  if (totalPage3 > 1) {
    pagination3.innerHTML = "";
    for (let i = 1; i <= totalPage3; i++) {
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

function showBread() {
  bread_catelouge.style.display = "flex";
  slide.style.display = "none";
  mainmenu.style.display = "none";
  brandstory.style.display = "none";
}

function showCookie() {
  cookie_catelouge.style.display = "flex";
  slide.style.display = "none";
  mainmenu.style.display = "none";
  brandstory.style.display = "none";
}

function showCake() {
  cake_catelouge.style.display = "flex";
  slide.style.display = "none";
  mainmenu.style.display = "none";
  brandstory.style.display = "none";
}

function returnShop() {
  bread_catelouge.style.display = "none";
  cake_catelouge.style.display = "none";
  cookie_catelouge.style.display = "none";
  cart_shop.style.display = "none"
  slide.style.display = "flex";
  mainmenu.style.display = "flex";
  brandstory.style.display = "flex";
}

bread.addEventListener("click", showBread);
cake.addEventListener("click", showCake);
cookie.addEventListener("click", showCookie);

return_mainshop.addEventListener("click", returnShop);

//filter
function toggleFilter(category) {
  let filterSidebar = null;
  let productFilter = null;
  let filterShow = null;

  if (category === "bread") {
    filterSidebar = document.querySelector(".bread-catelouge-container .filter");
    productFilter = document.querySelector(".bread-catelouge-container .product-filter");
    filterShow = document.querySelector(".bread-catelouge-container .filtershow");
  } else if (category === "cake") {
    filterSidebar = document.querySelector(".cake-catelouge-container .filter");
    productFilter = document.querySelector(".cake-catelouge-container .product-filter");
    filterShow = document.querySelector(".cake-catelouge-container .filtershow");
  } else if (category === "cookie") {
    filterSidebar = document.querySelector(".cookie-catelouge-container .filter");
    productFilter = document.querySelector(".cookie-catelouge-container .product-filter");
    filterShow = document.querySelector(".cookie-catelouge-container .filtershow");
  }

  if (!filterSidebar || !productFilter || !filterShow) {
    console.error(`Không tìm thấy filter cho ${category}`);
    return;
  }

  // Toggle class active
  filterSidebar.classList.toggle("active");

  if (filterSidebar.classList.contains("active")) {
    productFilter.style.marginLeft = "300px";
    filterShow.style.opacity = "0";
  } else {
    productFilter.style.marginLeft = "0px";
    filterShow.style.opacity = "1";
  }
}




//slider-value
const minPrice = document.getElementById("min-price");
const maxPrice = document.getElementById("max-price");
// const minPrice_bread = document.getElementById("min-price");
// const maxPrice_bread = document.getElementById("max-price");
// const minPrice_cake = document.getElementById("min-price");
// const maxPrice_cake = document.getElementById("max-price");
// const minPrice_cookie = document.getElementById("min-price");
// const maxPrice_cookie = document.getElementById("max-price");
const minValueDisplay = document.getElementById("min-value");
const maxValueDisplay = document.getElementById("max-value");
const filterbtn = document.querySelector(".acp-filter");


// const originalProducts = Array.from(document.querySelectorAll(".cookie-product"));

minPrice.addEventListener("input", updateDisplay);
maxPrice.addEventListener("input", updateDisplay);

function updateDisplay() {
  let minVal = parseInt(minPrice.value);
  let maxVal = parseInt(maxPrice.value);

  if (minVal > maxVal - 50000) {
    minPrice.value = maxVal - 50000;
    minVal = parseInt(minPrice.value);
  }

  if (maxVal < minVal + 50000) {
    maxPrice.value = minVal + 50000;
    maxVal = parseInt(maxPrice.value);
  }

  minValueDisplay.textContent = minVal.toLocaleString("vi-VN") + "đ";
  maxValueDisplay.textContent = maxVal.toLocaleString("vi-VN") + "đ";
  console.log("abc")
}

function render_filter() {
  console.log("1")
  let minVal = parseInt(minPrice.value);
  let maxVal = parseInt(maxPrice.value);

  // Kiểm tra danh mục đang hiển thị
  let activeCategory = "";
  if (document.querySelector(".cake-catelouge-container").style.display === "flex") {
    activeCategory = "cake";
  }
  else if (document.querySelector(".bread-catelouge-container").style.display === "flex") {
    activeCategory = "bread";
  }

  else {
    activeCategory = "cookie"; // Mặc định là cookie nếu không xác định được
  }

  console.log("Danh mục đang được lọc:", activeCategory);
  filterProductByPrice(minVal, maxVal, activeCategory);
};


function filterProductByPrice(minVal, maxVal, category) {
  let productSelector = "";
  let containerSelector = "";

  if (category === "bread") {
    productSelector = ".bread-product";
    containerSelector = "#bread-container";
  } else if (category === "cake") {
    productSelector = ".cake-product";
    containerSelector = "#cake-container";
  } else if (category === "cookie") {
    productSelector = ".cookie-product";
    containerSelector = "#cookie-container";
  }
  console.log(productSelector)
  console.log(containerSelector)
  const product_container = document.querySelector(containerSelector);
  const originalProducts = Array.from(document.querySelectorAll(productSelector));


  const filteredProducts = originalProducts.filter(product => {
    let priceText = product.querySelector(".price").textContent.trim();
    let price = parseInt(priceText.replace(/\D/g, ""), 10);
    return price >= minVal && price <= maxVal;
  });

  console.log("Số sản phẩm sau khi lọc:", filteredProducts.length);
  updateProduct(filteredProducts, product_container);
}


function updateProduct(products, product_container) {
  console.log("Container sản phẩm trước khi xóa:", product_container.innerHTML);

  // Xóa tất cả sản phẩm cũ
  while (product_container.firstChild) {
    product_container.removeChild(product_container.firstChild);
  }

  // Thêm sản phẩm đã lọc vào
  products.forEach(product => {
    let clone = product.cloneNode(true);
    clone.style.display = "flex";
    product_container.appendChild(clone);
  });

  console.log("Container sản phẩm sau khi cập nhật:", product_container.innerHTML);
}

