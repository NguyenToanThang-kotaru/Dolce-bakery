// const allPD = 12;


// let main_container = document.querySelector(".main-containerPD");
// let product_frame = document.querySelectorAll(".product-item");
// let pagination = document.querySelector(".allPD-pagination");
// let totalPage = Math.ceil(product_frame.length / allPD);

// function showPage(pageNumber) {
//   const start = (pageNumber - 1) * allPD;
//   const end = start + allPD;

//   product_frame.forEach((frame, index) => {
//     if (index >= start && index < end) {
//       frame.style.display = "flex";
//     } else {
//       frame.style.display = "none";
//     }
//   });

//   AddPagination(pageNumber);
//   main_container.scrollIntoView({ behavior: "smooth", block: "start" });

// }

// function AddPagination(activePage) {
//     if (totalPage > 1) {
//       pagination.innerHTML = "";
//       for (let i = 1; i <= totalPage; i++) {
//         const page_btn = document.createElement("div");
//         page_btn.classList.add("page");
//         page_btn.textContent = i;
  
//         if (i === activePage) {
//           page_btn.classList.add("active");
//         }
  
//         page_btn.addEventListener("click", function () {
//           showPage(i);
//         });
  
//         pagination.appendChild(page_btn);
//       }
//     }
//   }
  
//   showPage(1);