const COD = document.querySelector("#cash-on-delivery");
const atmOptions = document.getElementById("atm-options");
const atmPayment = document.querySelector("#atm-payment");

atmPayment.addEventListener("click", togglePaymentOptions);
function togglePaymentOptions() {
    atmOptions.style.display = "block";
}

COD.addEventListener("click", toggleCOD);
function toggleCOD() {
    atmOptions.style.display = "none";
}

const buy = document.getElementById("buy");
const blockPayment = document.getElementById("overlay-payment");
const closePayment = document.getElementById("close-payment");
const back_cart = document.getElementById("payment-back-cart");
const back_mainPage = document.getElementById("main-page");
let flag_payment = 0;
let userSession;
buy.addEventListener("click", function () {
    if (flag_payment === 0) {

        blockPayment.style.display = "block";
        flag_payment = 1;
    }

    else {

        blockPayment.style.display = "none";
        flag_payment = 0;

    }
    closePayment.addEventListener("click", function () {
        blockPayment.style.display = "none";
        flag_payment = 0;
    })
    window.addEventListener("click", function (event) {
        if (event.target === blockPayment) {
            blockPayment.style.display = "none";
            flag_payment = 0;
        }
    });
    back_cart.addEventListener("click", function () {
        blockPayment.style.display = "none";
        flag_payment = 0;
    })
    back_mainPage.addEventListener("click", function () {
        blockPayment.style.display = "none";
        flag_payment = 0;
       
    })
    localStorage.removeItem("userAddress");
    GoToPayProcess();
})
// const payment = document.getElementById('submit-payment-btn');
// const blockInvoice = document.getElementById('overlay-invoice');
// const mainInvoice = document.getElementById('invoice-container');
// const closeInvoice = document.getElementById('close-invoice');
// let flag_invoice = 0;
// payment.addEventListener("click", function () {
//     if(flag_invoice === 0){
//         blockInvoice.style.display="block";
//         mainInvoice.style.display="block";
//         blockPayment.style.display = "none";
//         flag_payment = 0;
//         flag_invoice = 1;

//     }
//     else{
//         blockInvoice.style.display="none";
//         mainInvoice.style.display="none";
//         flag_invoice = 0;
//     }
//     closeInvoice.addEventListener("click",function(){
//         blockInvoice.style.display="none";
//         mainInvoice.style.display="none";
//         flag_invoice = 0;
//     })
//     window.addEventListener("click",function(event){
//         if(event.target === blockInvoice){
//             blockInvoice.style.display="none";
//             mainInvoice.style.display="none";
//             flag_invoice = 0;
//         }
//     })
// })

function GoToPayProcess() {
    getPayDate();
    setUserInfoPayment();
    displayItemReadyPaying();
}
function getPayDate() {
    const today = new Date(); // Lấy ngày tháng năm hiện tại
    const day = String(today.getDate()).padStart(2, '0'); // Lấy ngày và đảm bảo có 2 chữ số
    const month = String(today.getMonth() + 1).padStart(2, '0'); // Lấy tháng và đảm bảo có 2 chữ số (tháng bắt đầu từ 0)
    const year = today.getFullYear(); // Lấy năm đầy đủ

    const formattedDate = `${day}/${month}/${year}`;
    document.querySelector(".payment-date").textContent = formattedDate;
    return formattedDate;
}
function setUserInfoPayment() {
    userSession = sessionStorage.getItem("userInfo");
    userSession = JSON.parse(userSession);
    document.querySelector(".payment-customer-name").textContent = userSession.fullName;
    document.querySelector(".payment-customer-email").textContent = userSession.email;
    document.querySelector(".payment-customer-phone").textContent = userSession.phoneNumber + "";
    document.querySelector(".payment-customer-address").textContent = userSession.address;
}

function displayItemReadyPaying() {
    let totalAmount = 0;
    let html = '';
    let cart = sessionStorage.getItem("cart");
    cart = JSON.parse(cart);
    console.log(cart);
    cart.forEach(item => {
        totalAmount += item.price * item.quantity;
        html += `
            <tr>
                
                <td><img src="${item.image}"style="width: 30px; object-fit: cover; vertical-align: middle; margin-right:8px"></td>
                <td style=" text-align:left; width:100px">${item.pd_name}</td>
                <td style=" text-align:center;">${item.quantity}</td>
                <td style="text-align:right;">${(item.price * item.quantity).toLocaleString('vi-VN')}<sup>đ</sup></td>
            </tr>                                
        `;
    })
    document.querySelector(".payment-table #product-list").innerHTML = html;
    document.querySelector(".payment-table .payment-total-product-price-value").innerHTML = totalAmount.toLocaleString('vi-VN');
    document.querySelector(".payment-table .payment-total-price-value").innerHTML = totalAmount.toLocaleString('vi-VN');
}
