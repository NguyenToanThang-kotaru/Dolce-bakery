const allPD = 12;


let main_container = document.querySelector(".main-containerPD");
let product_frame = document.querySelectorAll(".product-item");
let pagination = document.querySelector(".allPD-pagination");
let totalPage = Math.ceil(product_frame.length / allPD);

function showPage(pageNumber) {
  const start = (pageNumber - 1) * allPD;
  const end = start + allPD;

  product_frame.forEach((frame, index) => {
    if (index >= start && index < end) {
      frame.style.display = "flex";
    } else {
      frame.style.display = "none";
    }
  });

  AddPagination(pageNumber);
  main_container.scrollIntoView({ behavior: "smooth", block: "start" });

}

function AddPagination(activePage) {
  if (totalPage > 1) {
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
}

showPage(1);


//phần phân trang cho riêng từng mục


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
const back_mainicon = document.querySelectorAll(".backtomain");

function showBread() {
  bread_catelouge.style.display = "flex";
  slide.style.display = "none";
  mainmenu.style.display = "none";
  brandstory.style.display = "none";
  main_container.style.display = "none";
}

function showCookie() {
  cookie_catelouge.style.display = "flex";
  slide.style.display = "none";
  mainmenu.style.display = "none";
  brandstory.style.display = "none";
  main_container.style.display = "none";
}

function showCake() {
  cake_catelouge.style.display = "flex";
  slide.style.display = "none";
  mainmenu.style.display = "none";
  brandstory.style.display = "none";
  main_container.style.display = "none";
}

// let filter = document.querySelector(".main-containerPD .filter");
// let PDfilter = document.querySelector(".main-containerPD .product-filter");

function returnShop() {
  bread_catelouge.style.display = "none";
  cake_catelouge.style.display = "none";
  cookie_catelouge.style.display = "none";
  cart_shop.style.display = "none"
  slide.style.display = "flex";
  mainmenu.style.display = "flex";
  brandstory.style.display = "flex";
  infoproduct.style.display = "none";
  main_container.style.display = "flex";
  // filter.style.left = "-600px";
  // PDfilter.style.marginLeft = "0px";
}

bread.addEventListener("click", showBread);
cake.addEventListener("click", showCake);
cookie.addEventListener("click", showCookie);

return_mainshop.addEventListener("click", returnShop);
back_mainicon.forEach(button => {
  button.addEventListener("click", returnShop);
})


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
  } else if (category === "allproduct") {
    filterSidebar = document.querySelector(".main-containerPD .filter");
    productFilter = document.querySelector(".main-containerPD .product-filter");
    filterShow = document.querySelector(".main-containerPD .filtershow");
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

const minPrice_allproduct = document.getElementById("min-price-allproduct");
const maxPrice_allproduct = document.getElementById("max-price-allproduct");

const minValueDisplay_allproduct = document.getElementById("min-value-allproduct");
const maxValueDisplay_allproduct = document.getElementById("max-value-allproduct");

const filterbtn = document.querySelector(".acp-filter");


// const originalProducts = Array.from(document.querySelectorAll(".cookie-product"));

minPrice_bread.addEventListener("input", updateDisplayBreadSlider);
maxPrice_bread.addEventListener("input", updateDisplayBreadSlider);

minPrice_cake.addEventListener("input", updateDisplayCakeSlider);
maxPrice_cake.addEventListener("input", updateDisplayCakeSlider);

minPrice_cookie.addEventListener("input", updateDisplayCookieSlider);
maxPrice_cookie.addEventListener("input", updateDisplayCookieSlider);

minPrice_allproduct.addEventListener("input", updateDisplayAllproductSlider);
maxPrice_allproduct.addEventListener("input", updateDisplayAllproductSlider);

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

//---------------------------------------------------------------------------

function updateDisplayAllproductSlider() {
  let minVal = parseInt(minPrice_allproduct.value);
  let maxVal = parseInt(maxPrice_allproduct.value);

  if (minVal > maxVal - 50000) {
    minPrice_allproduct.value = maxVal - 50000;
    minVal = parseInt(minPrice_allproduct.value);
  }

  if (maxVal < minVal + 50000) {
    maxPrice_allproduct.value = minVal + 50000;
    maxVal = parseInt(maxPrice_allproduct.value);
  }
  minValueDisplay_allproduct.textContent = minVal.toLocaleString("vi-VN") + "đ";
  maxValueDisplay_allproduct.textContent = maxVal.toLocaleString("vi-VN") + "đ";
}


function render_filter() {
  // Xác định danh mục hiện tại
  let activeCategory = "allproduct";
  if (document.querySelector(".bread-catelouge-container").style.display === "flex") {
    activeCategory = "bread";
  } else if (document.querySelector(".cake-catelouge-container").style.display === "flex") {
    activeCategory = "cake";
  } else if (document.querySelector(".cookie-catelouge-container").style.display === "flex") {
    activeCategory = "cookie";
  }

  // Lấy keyword từ input tương ứng
  const keywordInput = document.getElementById(`product-name-${activeCategory}`);
  const keyword = keywordInput?.value?.trim() || "";

  // Lấy giá min/max theo danh mục
  const minVal = document.getElementById(`min-price-${activeCategory}`)?.value || 0;
  const maxVal = document.getElementById(`max-price-${activeCategory}`)?.value || 1000000;

  // Lấy subcategory tương ứng
  const subcategory = document.getElementById(`product-subcategory-${activeCategory}`)?.value || "";

  // Lấy loại nếu là allproduct
  const type = activeCategory === "allproduct"
    ? document.getElementById("product-category")?.value || 0
    : 0;

  // Chuẩn bị dữ liệu gửi
  const data = `category=${activeCategory}&keyword=${encodeURIComponent(keyword)}&min=${minVal}&max=${maxVal}&subcategory=${subcategory}&type=${type}`;
  console.log("📤 Dữ liệu gửi:", data);

  // Gửi AJAX
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "../../PHP/users/filter_product.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    if (xhr.status === 200) {
      const container = document.getElementById(`${activeCategory}-container`);
      if (container) {
        container.innerHTML = xhr.responseText;

        // ✅ Phân trang lại sau khi cập nhật HTML
        if (activeCategory === "bread") {
          product_frame1 = document.querySelectorAll(".bread-product");
          totalPage1 = Math.ceil(product_frame1.length / product);
          if (totalPage1 <= 1) pagination1.innerHTML = "";
          showPage1(1);
        } else if (activeCategory === "cake") {
          product_frame2 = document.querySelectorAll(".cake-product");
          totalPage2 = Math.ceil(product_frame2.length / product);
          if (totalPage2 <= 1) pagination2.innerHTML = "";
          showPage2(1);
        } else if (activeCategory === "cookie") {
          product_frame3 = document.querySelectorAll(".cookie-product");
          totalPage3 = Math.ceil(product_frame3.length / product);
          if (totalPage3 <= 1) pagination3.innerHTML = "";
          showPage3(1);
        } else if (activeCategory === "allproduct") {
          product_frame = document.querySelectorAll(".product-item");
          totalPage = Math.ceil(product_frame.length / allPD);
          if (totalPage <= 1) pagination.innerHTML = "";
          showPage(1);
        }

      } else {
        console.error("❌ Không tìm thấy container tương ứng.");
      }
    } else {
      console.error("❌ Lỗi khi gọi filter_product.php");
    }
  };

  // Reset sắp xếp về mặc định sau khi lọc
  const arrangeSelect = document.querySelector(`.${activeCategory}-catelouge-container .product-filter .arrange-sl`)
    || document.querySelector(".main-containerPD .product-filter .arrange-sl");
  if (arrangeSelect) {
    arrangeSelect.value = ""; // hoặc "all" tùy theo option bạn đặt trong HTML
  }



  xhr.send(data);
}


const originalProductLists = {
  bread: Array.from(document.querySelectorAll(".bread-product")),
  cake: Array.from(document.querySelectorAll(".cake-product")),
  cookie: Array.from(document.querySelectorAll(".cookie-product")),
  allproduct: Array.from(document.querySelectorAll(".product-item"))
};

// function filterProductByPrice(minVal, maxVal, category) {
//   let containerSelector = "";

//   if (category === "bread") {
//     productSelector = ".bread-product";
//     containerSelector = "#bread-container";
//   } else if (category === "cake") {
//     productSelector = ".cake-product";
//     containerSelector = "#cake-container";
//   } else if (category === "cookie") {
//     productSelector = ".cookie-product";
//     containerSelector = "#cookie-container";
//   } else if (category === "allproduct") {
//     productSelector = ".product-item";
//     containerSelector = "#allproduct-container";
//   }

//   const product_container = document.querySelector(containerSelector);
//   const originalProducts = originalProductLists[category];


//   const filteredProducts = originalProducts.filter(product => {
//     let priceText = product.querySelector(".price").textContent.trim();
//     let price = parseInt(priceText.replace(/\D/g, ""), 10);
//     return price >= minVal && price <= maxVal;
//   });

//   updateProduct(filteredProducts, product_container);
// }


function updateProduct(products, product_container) {

  if (!product_container) {
    console.error("Lỗi: product_container không tồn tại.");
    return;
  }
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
  } else if (product_container.id === "allproduct-container") {
    category = "allproduct";
  }

  // console.log(category);

  // Cập nhật lại danh sách sản phẩm & số trang sau khi lọc
  if (category === "bread") {
    product_frame1 = document.querySelectorAll(".bread-product"); // Cập nhật danh sách sau lọc
    totalPage1 = Math.ceil(product_frame1.length / product);
    if (totalPage1 <= 1) pagination1.innerHTML = "";
    showPage1(1);
  } else if (category === "cake") {
    product_frame2 = document.querySelectorAll(".cake-product");
    totalPage2 = Math.ceil(product_frame2.length / product);
    if (totalPage2 <= 1) pagination2.innerHTML = "";
    showPage2(1);
  } else if (category === "cookie") {
    product_frame3 = document.querySelectorAll(".cookie-product");
    totalPage3 = Math.ceil(product_frame3.length / product);
    if (totalPage3 <= 1) pagination3.innerHTML = "";
    showPage3(1);
  } else if (category === "allproduct") {
    product_frame = document.querySelectorAll(".product-item");
    totalPage = Math.ceil(product_frame.length / allPD);
    if (totalPage <= 1) pagination.innerHTML = "";
    showPage(1);
  }

}


// check box
// document.querySelectorAll(".option-price input[type='checkbox']").forEach(checkbox => {
//   checkbox.addEventListener("change", render_filter_by_price);
// });

// function render_filter_by_price() {
//   let activeCategory = "";

//   if (document.querySelector(".cake-catelouge-container").style.display === "flex") {
//     activeCategory = "cake";
//   } else if (document.querySelector(".bread-catelouge-container").style.display === "flex") {
//     activeCategory = "bread";
//   } else if (document.querySelector(".cookie-catelouge-container").style.display === "flex") {
//     activeCategory = "cookie";
//   } else {
//     activeCategory = "allproduct";
//   }

//   // Lấy danh sách khoảng giá đã chọn
//   let selectedRanges = Array.from(document.querySelectorAll(".option-price input[type='checkbox']:checked"))
//     .map(checkbox => {
//       let [min, max] = checkbox.value.split("-").map(Number);
//       return { max, min };
//     });

//   filterProductByPriceRange(selectedRanges, activeCategory);
//   const currentSelect = document.querySelector(`.${activeCategory}-catelouge-container .product-filter .arrange-sl`);
//   if (currentSelect) {
//     handleSortProducts(currentSelect);
//   }
// }


// function filterProductByPriceRange(priceRanges, category) {
//   let containerSelector = "";
//   let productSelector = "";

//   if (category === "bread") {
//     productSelector = ".bread-product";
//     containerSelector = "#bread-container";
//   } else if (category === "cake") {
//     productSelector = ".cake-product";
//     containerSelector = "#cake-container";
//   } else if (category === "cookie") {
//     productSelector = ".cookie-product";
//     containerSelector = "#cookie-container";
//   } else if (category === "allproduct") {
//     productSelector = ".product-item";
//     containerSelector = "#allproduct-container";
//   }

//   const product_container = document.querySelector(containerSelector);
//   const originalProducts = originalProductLists[category];

//   let filteredProducts;

//   if (priceRanges.length === 0) {
//     //Nếu không có checkbox nào được chọn -> Hiển thị tất cả sản phẩm
//     filteredProducts = Array.from(originalProducts);
//   } else {
//     //Nếu có checkbox được chọn -> Lọc theo khoảng giá
//     filteredProducts = Array.from(originalProducts).filter(product => {
//       let priceText = product.querySelector(".price").textContent.trim();
//       let price = parseInt(priceText.replace(/\D/g, ""), 10);

//       return priceRanges.some(range => price >= range.min && price <= range.max);
//     });
//   }
//   // const currentSelect = document.querySelector(`.${category}-catelouge-container .product-filter .arrange-sl`);
//   // if (currentSelect) {
//   //   handleSortProducts(currentSelect);
//   // }
//   // console.log("hien tai la:");

//   updateProduct(filteredProducts, product_container);

//   // Xử lý sắp xếp lại sản phẩm sau khi lọc

// }


//================================arange impression
document.querySelectorAll(".arrange-sl").forEach(select => {
  select.addEventListener("change", function () {
    handleSortProducts(this);
  });
});

// const selectElement = document.querySelector(".arrange-sl");
function handleSortProducts(selectElement) {
  const selectedValue = selectElement.value;// Lấy giá trị của select hiện tại
  console.log("Lựa chọn: ", selectedValue);

  let productSelector = "";
  let containerSelector = "";

  if (document.querySelector(".bread-catelouge-container")?.style.display === "flex") {
    productSelector = ".bread-product";
    containerSelector = "#bread-container";
  } else if (document.querySelector(".cake-catelouge-container")?.style.display === "flex") {
    productSelector = ".cake-product";
    containerSelector = "#cake-container";
  } else if (document.querySelector(".cookie-catelouge-container")?.style.display === "flex") {
    productSelector = ".cookie-product";
    containerSelector = "#cookie-container";
  } else if (getComputedStyle(document.querySelector(".main-containerPD"))?.display === "flex") {
    productSelector = ".product-item";
    containerSelector = "#allproduct-container";
  }

  if (!productSelector) {
    console.log("Không xác định danh mục nào đang hiển thị!");
    return;
  }

  let product_container = document.querySelector(containerSelector);
  let productList = Array.from(document.querySelectorAll(productSelector)); // Lấy tất cả sản phẩm

  // console.log("Danh sách sản phẩm trước khi sắp xếp:", productList);

  let sortedProducts = productList.sort((a, b) => {
    let priceA = parseInt(a.querySelector(".price").textContent.replace(/\D/g, ""), 10);
    let priceB = parseInt(b.querySelector(".price").textContent.replace(/\D/g, ""), 10);
    return selectedValue === "up" ? priceB - priceA : priceA - priceB;
  });

  // console.log("Danh sách sản phẩm sau khi sắp xếp:", sortedProducts);

  updateProduct(sortedProducts, product_container);
}



// search oninput
document.getElementById("search").addEventListener("input", function (event) {
  let keyword = this.value.trim().toLowerCase();
  let keywordNoAccents = removeVietnameseTones(keyword);
  let activeCategory = "";
  let productSelector = "";

  if (document.querySelector(".cake-catelouge-container").style.display === "flex") {
    activeCategory = "cake";
    productSelector = ".cake-product";
  } else if (document.querySelector(".bread-catelouge-container").style.display === "flex") {
    activeCategory = "bread";
    productSelector = ".bread-product";
  } else if (document.querySelector(".cookie-catelouge-container").style.display === "flex") {
    activeCategory = "cookie";
    productSelector = ".cookie-product";
  } else if (getComputedStyle(document.querySelector(".main-containerPD")).display === "flex") {
    activeCategory = "allproduct";
    productSelector = ".product-item";
  }

  // Nếu đang ở "allproduct" thì chờ Enter mới thực hiện tìm kiếm
  if (activeCategory === "allproduct") {
    this.addEventListener("keydown", function (e) {
      if (e.key === "Enter") {
        searchProducts(keyword, keywordNoAccents, activeCategory, productSelector);
      }
    });
  } else {
    // Các danh mục khác tìm kiếm ngay lập tức
    searchProducts(keyword, keywordNoAccents, activeCategory, productSelector);
  }
});

function searchProducts(keyword, keywordNoAccents, activeCategory, productSelector) {
  let products = document.querySelectorAll(productSelector);
  let filteredProducts = [];

  products.forEach(product => {
    let productName = product.querySelector(".product-name").textContent.trim().toLowerCase();
    let productNameNoAccents = removeVietnameseTones(productName);
    if (productName.includes(keyword) || productNameNoAccents.includes(keywordNoAccents)) {
      product.style.display = "flex";
      filteredProducts.push(product);
    } else {
      product.style.display = "none";
    }
  });

  let containerSelector = `#${activeCategory}-container`;
  let container = document.querySelector(containerSelector);
  let noResultMsg = container.querySelector(".no-result-msg");

  if (filteredProducts.length === 0) {
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

  // Phân trang lại
  let totalPages = Math.ceil(filteredProducts.length / product);
  let totalPagesmain = Math.ceil(filteredProducts.length / allPD);

  if (activeCategory === "bread") {
    product_frame1 = filteredProducts;
    totalPage1 = totalPages;
    if (totalPage1 <= 1) pagination1.innerHTML = "";
    showPage1(1);
  } else if (activeCategory === "cake") {
    product_frame2 = filteredProducts;
    totalPage2 = totalPages;
    if (totalPage2 <= 1) pagination2.innerHTML = "";
    showPage2(1);
  } else if (activeCategory === "cookie") {
    product_frame3 = filteredProducts;
    totalPage3 = totalPages;
    if (totalPage3 <= 1) pagination3.innerHTML = "";
    showPage3(1);
  } else if (activeCategory === "allproduct") {
    product_frame = filteredProducts;
    totalPage = totalPagesmain;
    if (totalPage <= 1) pagination.innerHTML = "";
    showPage(1);
  }

  // Nếu input search trống, khôi phục toàn bộ danh sách và phân trang lại
  if (keyword === "") {
    let allProducts = document.querySelectorAll(productSelector);
    allProducts.forEach(product => {
      product.style.display = "flex";
    });

    if (activeCategory === "bread") {
      showPage1(1);
    } else if (activeCategory === "cake") {
      showPage2(1);
    } else if (activeCategory === "cookie") {
      showPage3(1);
    } else if (activeCategory === "allproduct") {
      showPage(1);
    }
  }
}


function removeVietnameseTones(str) {
  return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "").replace(/đ/g, "d").replace(/Đ/g, "D");
}

// search_suggestion
let container = document.querySelector("#container");
let infoproduct = document.querySelector("#InfoPD-container");
let searchInput = document.getElementById("search");
let suggestionBox = document.getElementById("suggestion");
let left_info_pd = document.getElementById("#Left");

searchInput.addEventListener("input", function () {
  let keyword = this.value.trim();

  //Kiểm tra nếu đang ở danh mục riêng thì không hiển thị gợi ý
  let cakeVisible = getComputedStyle(document.querySelector(".cake-catelouge-container")).display === "flex";
  let breadVisible = getComputedStyle(document.querySelector(".bread-catelouge-container")).display === "flex";
  let cookieVisible = getComputedStyle(document.querySelector(".cookie-catelouge-container")).display === "flex";

  if (cakeVisible || breadVisible || cookieVisible) {
    suggestionBox.style.display = "none";
    return; //Dừng lại, không tiếp tục fetch API
  }

  if (keyword === "") {
    suggestionBox.innerHTML = "";
    suggestionBox.style.display = "none";
    return;
  }

  // Nếu không ở danh mục riêng thì mới fetch API
  fetch(`../../PHP/users/search_suggestion.php?query=${encodeURIComponent(keyword)}`)
    .then(response => response.json())
    .then(data => {
      console.log("Dữ liệu nhận được:", data);

      suggestionBox.innerHTML = "";
      if (!data || data.length === 0) {
        suggestionBox.style.display = "none";
        return;
      }

      suggestionBox.style.display = "block";

      data.forEach(productName => {
        let item = document.createElement("div");
        item.classList.add("suggestion-item");
        item.textContent = productName;

        item.addEventListener("click", function () {
          searchInput.value = productName;
          suggestionBox.innerHTML = "";
          suggestionBox.style.display = "none";
          console.log(productName);

          fetch(`../../PHP/users/getProductinfo.php?pd_name=${encodeURIComponent(productName)}`)
            .then(response => response.json())
            .then(product => {
              if (!product.error) {
                document.querySelector(".PD-name h1").textContent = product.pd_name;
                document.querySelector(".Price").textContent = product.price + "đ";
                document.querySelector("#PD-imgage img").src = product.image;
              }
            })
            .catch(error => console.error("Lỗi tải sản phẩm:", error));

          infoproduct.style.display = "flex";
          slide.style.display = "none";
          mainmenu.style.display = "none";
          brandstory.style.display = "none";
          cake_catelouge.style.display = "none";
          bread_catelouge.style.display = "none";
          cookie_catelouge.style.display = "none";
          main_container.style.display = "none";
          window.scrollTo({ top: 0, behavior: "smooth" });

          // main_container.scrollIntoView({ behavior: "smooth", block: "start" });
        });

        suggestionBox.appendChild(item);
      });
    })
    .catch(error => console.error("Lỗi tải gợi ý: ", error));

  container.addEventListener("click", function () {
    suggestionBox.style.display = "none";
  });
});

//Click vào từng sản phẩm thì hiện ra thông tin
document.querySelectorAll(".product-img img").forEach(img => {
  //Chọn phần tử gần nhất với ảnh được click để lấy name của người con gái a yêu!!!!
  img.addEventListener("click", function () {
    let productItem = this.closest(".product-item, .bread-product, .cake-product, .cookie-product");
    if (!productItem) return;

    let productName = productItem.querySelector(".product-name")?.textContent?.trim();
    if (!productName) return;

    console.log("Click ảnh sản phẩm:", productName);

    fetch(`../../PHP/users/getProductinfo.php?pd_name=${encodeURIComponent(productName)}`)
      .then(response => response.json())
      .then(product => {
        if (!product.error) {
          document.querySelector(".PD-name h1").textContent = product.pd_name;
          document.querySelector(".Price").textContent = product.price + "đ";
          document.querySelector("#PD-imgage img").src = product.image;
        }
      })
      .catch(error => console.error("Lỗi khi tải thông tin sản phẩm:", error));

    infoproduct.style.display = "flex";
    slide.style.display = "none";
    mainmenu.style.display = "none";
    brandstory.style.display = "none";
    cake_catelouge.style.display = "none";
    bread_catelouge.style.display = "none";
    cookie_catelouge.style.display = "none";
    main_container.style.display = "none";

    window.scrollTo({ top: 0, behavior: "smooth" });

  });
});


// Lấy chủng loại từ PHP
function loadSubcategories() {
  const categorySelect = document.getElementById('product-category');
  const subcategorySelect = document.getElementById('product-subcategory-allproduct');

  if (!categorySelect || !subcategorySelect) return;

  const categoryId = categorySelect.value;

  if (!categoryId) {
    subcategorySelect.innerHTML = "<option value=''>Vui lòng chọn loại sản phẩm trước</option>";
    return;
  }

  // Hiển thị đang tải
  subcategorySelect.innerHTML = "<option>Đang tải...</option>";

  // Gửi AJAX để lấy danh sách chủng loại
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "../../PHP/PD-getSubcategory.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    if (xhr.status === 200) {
      subcategorySelect.innerHTML = xhr.responseText;
    } else {
      subcategorySelect.innerHTML = "<option value=''>Lỗi tải dữ liệu</option>";
    }
  };

  xhr.send("category_id=" + encodeURIComponent(categoryId));
}








