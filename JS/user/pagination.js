const product = 8;

let product_frame1 = document.querySelectorAll(".bread-product");
let pagination1 = document.querySelector(".bread-pagination");
let totalPage1 = Math.ceil(product_frame1.length / product);

let product_frame2 = document.querySelectorAll(".cake-product");
let pagination2 = document.querySelector(".cake-pagination");
let totalPage2 = Math.ceil(product_frame2.length / product);

let product_frame3 = document.querySelectorAll(".cookie-product");
let pagination3 = document.querySelector(".cookie-pagination");
let totalPage3 = Math.ceil(product_frame3.length / product);


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
const minPrice_bread = document.getElementById("min-price-bread");
const maxPrice_bread = document.getElementById("max-price-bread");

const minPrice_cake = document.getElementById("min-price-cake");
const maxPrice_cake = document.getElementById("max-price-cake");

const minPrice_cookie = document.getElementById("min-price-cookie");
const maxPrice_cookie = document.getElementById("max-price-cookie");

const minValueDisplay_bread = document.getElementById("min-value-bread");
const maxValueDisplay_bread = document.getElementById("max-value-bread");

const minValueDisplay_cake = document.getElementById("min-value-cake");
const maxValueDisplay_cake = document.getElementById("max-value-cake");

const minValueDisplay_cookie = document.getElementById("min-value-cookie");
const maxValueDisplay_cookie = document.getElementById("max-value-cookie");
const filterbtn = document.querySelector(".acp-filter");


// const originalProducts = Array.from(document.querySelectorAll(".cookie-product"));

minPrice_bread.addEventListener("input", updateDisplayBreadSlider);
maxPrice_bread.addEventListener("input", updateDisplayBreadSlider);

minPrice_cake.addEventListener("input", updateDisplayCakeSlider);
maxPrice_cake.addEventListener("input", updateDisplayCakeSlider);

minPrice_cookie.addEventListener("input", updateDisplayCookieSlider);
maxPrice_cookie.addEventListener("input", updateDisplayCookieSlider);

function updateDisplayBreadSlider() {
  let minVal = parseInt(minPrice_bread.value);
  let maxVal = parseInt(maxPrice_bread.value);

  if (minVal > maxVal - 50000) {
    minPrice_bread.value = maxVal - 50000;
    minVal = parseInt(minPrice_bread.value);
  }

  if (maxVal < minVal + 50000) {
    maxPrice_bread.value = minVal + 50000;
    maxVal = parseInt(maxPrice_bread.value);
  }

  minValueDisplay_bread.textContent = minVal.toLocaleString("vi-VN") + "đ";
  maxValueDisplay_bread.textContent = maxVal.toLocaleString("vi-VN") + "đ";
}

// ------------------------


function updateDisplayCakeSlider() {
  let minVal = parseInt(minPrice_cake.value);
  let maxVal = parseInt(maxPrice_cake.value);

  if (minVal > maxVal - 50000) {
    minPrice_cake.value = maxVal - 50000;
    minVal = parseInt(minPrice_cake.value);
  }

  if (maxVal < minVal + 50000) {
    maxPrice_cake.value = minVal + 50000;
    maxVal = parseInt(maxPrice_cake.value);
  }

  minValueDisplay_cake.textContent = minVal.toLocaleString("vi-VN") + "đ";
  maxValueDisplay_cake.textContent = maxVal.toLocaleString("vi-VN") + "đ";
}

// -----------------------------


function updateDisplayCookieSlider() {
  let minVal = parseInt(minPrice_cookie.value);
  let maxVal = parseInt(maxPrice_cookie.value);

  if (minVal > maxVal - 20000) {
    minPrice_cookie.value = maxVal - 20000;
    minVal = parseInt(minPrice_cookie.value);
  }

  if (maxVal < minVal + 20000) {
    maxPrice_cookie.value = minVal + 20000;
    maxVal = parseInt(maxPrice_cookie.value);
  }

  minValueDisplay_cookie.textContent = minVal.toLocaleString("vi-VN") + "đ";
  maxValueDisplay_cookie.textContent = maxVal.toLocaleString("vi-VN") + "đ";
}

function render_filter() {  
  let minVal, maxVal;
  let activeCategory = "";

  if (document.querySelector(".cake-catelouge-container").style.display === "flex") {
    activeCategory = "cake";
    minVal = parseInt(minPrice_cake.value);
    maxVal = parseInt(maxPrice_cake.value);
  } else if (document.querySelector(".bread-catelouge-container").style.display === "flex") {
    activeCategory = "bread";
    minVal = parseInt(minPrice_bread.value);
    maxVal = parseInt(maxPrice_bread.value);
  } else {
    activeCategory = "cookie"; 
    minVal = parseInt(minPrice_cookie.value);
    maxVal = parseInt(maxPrice_cookie.value);
  }

  filterProductByPrice(minVal, maxVal, activeCategory);
}


const originalProductLists = {
  bread: Array.from(document.querySelectorAll(".bread-product")),
  cake: Array.from(document.querySelectorAll(".cake-product")),
  cookie: Array.from(document.querySelectorAll(".cookie-product"))
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

  const product_container = document.querySelector(containerSelector);
  const originalProducts = originalProductLists[category];


  const filteredProducts = originalProducts.filter(product => {
    let priceText = product.querySelector(".price").textContent.trim();
    let price = parseInt(priceText.replace(/\D/g, ""), 10);
    return price >= minVal && price <= maxVal;
  });

  updateProduct(filteredProducts, product_container);
}


function updateProduct(products, product_container) {
  // Xóa tất cả sản phẩm cũ
  while (product_container.firstChild) {
    product_container.removeChild(product_container.firstChild);
  }

  // Thêm sản phẩm đã lọc vào container
  products.forEach(product => {
    let clone = product.cloneNode(true);
    clone.style.display = "flex";
    product_container.appendChild(clone);
  });

  // Xác định category đang hiển thị dựa vào display: flex
  let category = "";
  if (product_container.id === "bread-container") {
    category = "bread";
  } else if (product_container.id === "cake-container") {
    category = "cake";
  } else if (product_container.id === "cookie-container") {
    category = "cookie";
  }

  console.log(category);

  // Cập nhật lại danh sách sản phẩm & số trang sau khi lọc
  if (category === "bread") {
    product_frame1 = document.querySelectorAll(".bread-product"); // Cập nhật danh sách sau lọc
    totalPage1 = Math.ceil(product_frame1.length / product);
    showPage1(1, product_frame1);
  } else if (category === "cake") {
    product_frame2 = document.querySelectorAll(".cake-product");
    totalPage2 = Math.ceil(product_frame2.length / product);
    showPage2(1, product_frame2);
  } else if (category === "cookie") {
    product_frame3 = document.querySelectorAll(".cookie-product");
    totalPage3 = Math.ceil(product_frame3.length / product);
    showPage3(1, product_frame3);
  }
}


// check box
document.querySelectorAll(".option-price input[type='checkbox']").forEach(checkbox => {
  checkbox.addEventListener("change", render_filter_by_price);
});

function render_filter_by_price() {
  let activeCategory = "";

  if (document.querySelector(".cake-catelouge-container").style.display === "flex") {
      activeCategory = "cake";
  } else if (document.querySelector(".bread-catelouge-container").style.display === "flex") {
      activeCategory = "bread";
  } else {
      activeCategory = "cookie";
  }

  // Lấy danh sách khoảng giá đã chọn
  let selectedRanges = Array.from(document.querySelectorAll(".option-price input[type='checkbox']:checked"))
      .map(checkbox => {
          let [min, max] = checkbox.value.split("-").map(Number);
          return { min, max };
      });

  filterProductByPriceRange(selectedRanges, activeCategory);
}


function filterProductByPriceRange(priceRanges, category) {
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

  const product_container = document.querySelector(containerSelector);
  const originalProducts = originalProductLists[category];

  const filteredProducts = Array.from(originalProducts).filter(product => {
      let priceText = product.querySelector(".price").textContent.trim();
      let price = parseInt(priceText.replace(/\D/g, ""), 10);

      return priceRanges.some(range => price >= range.min && price <= range.max);
  });

  updateProduct(filteredProducts, product_container);
}

//arange impession
document.querySelectorAll(".arrange-sl").forEach(select => {
  select.addEventListener("change", function () {
      const selectedValue = this.value;
      console.log("Lựa chọn: ", selectedValue);

      let productSelector = "";
      let containerSelector = "";

      if (document.querySelector(".bread-catelouge-container")?.style.display === "flex") {
          productSelector = ".bread-product";
          containerSelector = "#bread-container";
      } else if (document.querySelector(".cake-catelouge-container")?.style.display === "flex") {
          productSelector = ".cake-product";
          containerSelector = "#cake-container";
      } else if (document.querySelector(".cake-catelouge-container")?.style.display === "flex") {
          productSelector = ".cookie-product";
          containerSelector = "#cookie-container";
      }

      if (!productSelector) {
          console.log("Không xác định danh mục nào đang hiển thị!");
          return; 
      }

      let product_container = document.querySelector(containerSelector);
      let productList = Array.from(document.querySelectorAll(productSelector))
          .filter(product => product.style.display !== "none"); // Lọc sản phẩm hiển thị

      console.log("Danh sách sản phẩm trước khi sắp xếp:", productList);

      let sortedProducts = productList.sort((a, b) => {
          let priceA = parseInt(a.querySelector(".price").textContent.replace(/\D/g, ""), 10);
          let priceB = parseInt(b.querySelector(".price").textContent.replace(/\D/g, ""), 10);
          return selectedValue === "up" ? priceB - priceA : priceA - priceB;
      });

      console.log("Danh sách sản phẩm sau khi sắp xếp:", sortedProducts);

      updateProduct(sortedProducts, product_container);
  });
});

// search oninput
document.getElementById("search").addEventListener("input", function () {
  let keyword = this.value.trim().toLowerCase();
  let activeCategory = "";

  // Xác định danh mục nào đang hiển thị
  if (document.querySelector(".cake-catelouge-container").style.display === "flex") {
      activeCategory = "cake";
  } else if (document.querySelector(".bread-catelouge-container").style.display === "flex") {
      activeCategory = "bread";
  } else {
      activeCategory = "cookie";
  }

  // Chọn tất cả sản phẩm trong danh mục đang hiển thị
  let productSelector = `.${activeCategory}-product`;
  let products = document.querySelectorAll(productSelector);
  let hasResult = false;

  products.forEach(product => {
      let productName = product.querySelector(".product-name").textContent.trim().toLowerCase();
      if (productName.includes(keyword)) {
          product.style.display = "flex"; // Hiển thị sản phẩm phù hợp
          hasResult = true;
      } else {
          product.style.display = "none"; // Ẩn sản phẩm không phù hợp
      }
  });

  // Hiển thị thông báo nếu không có sản phẩm nào phù hợp
  let containerSelector = `#${activeCategory}-container`;
  let container = document.querySelector(containerSelector);
  let noResultMsg = container.querySelector(".no-result-msg");

  if (!hasResult) {
      if (!noResultMsg) {
          noResultMsg = document.createElement("p");
          noResultMsg.className = "no-result-msg";
          noResultMsg.textContent = "Không có sản phẩm nào phù hợp.";
          noResultMsg.style.textAlign = "center";
          container.appendChild(noResultMsg);
      }
  } else {
      if (noResultMsg) {
          noResultMsg.remove();
      }
  }
});
