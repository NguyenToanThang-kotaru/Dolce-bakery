const payment = document.getElementById('submit-payment-btn');
const blockInvoice = document.getElementById('overlay-invoice');
const mainInvoice = document.getElementById('invoice-container');
const closeInvoice = document.getElementById('close-invoice');
let flag_invoice = 0;
payment.addEventListener("click", function (event) {
    event.preventDefault();
    clearErrorPayment();
    if(!checkConditionToPay()) return;
    clearErrorPayment();
    openSummary();
    getInfoSummary();
})
function openSummary()
{
    if(flag_invoice === 0){
        blockInvoice.style.display="block";
        mainInvoice.style.display="block";
        blockPayment.style.display = "none";
        flag_payment = 0;
        flag_invoice = 1;

    }
    else{
        blockInvoice.style.display="none";
        mainInvoice.style.display="none";
        flag_invoice = 0;
    }
    closeInvoice.addEventListener("click",function(){
        blockInvoice.style.display="none";
        mainInvoice.style.display="none";
        flag_invoice = 0;
    })
    window.addEventListener("click",function(event){
        if(event.target === blockInvoice){
            blockInvoice.style.display="none";
            mainInvoice.style.display="none";
            flag_invoice = 0;
        }
    })
}





let userName;
let email;
let phone;
let address;
let note;
let paymentDate;
let paymentMethod;
let bankName = "";
let cardNumber = "";
let totalAmount = 0;
let orderItems = [];

function getInfoSummary()
{
    userName = document.querySelector(".payment-customer-name").textContent;
    email = document.querySelector(".payment-customer-email").textContent;
    phone = document.querySelector(".payment-customer-phone").textContent;
    address = document.querySelector("#address-payment").value;
    note = document.querySelector("#note-payment").value;
    paymentDate = document.querySelector(".payment-date").textContent;
    paymentMethod = 1;
    let paymentMethod_toString = '';
    if(document.querySelector("#atm-payment").checked)
    {
        paymentMethod = 2;
        bankName = document.querySelector("#bank").value;
        cardNumber = document.querySelector("#card-number").value;
    }
    
    paymentMethod_toString = paymentMethod<=1 ? "Thanh toán khi nhận hàng" : "Thanh toán bằng thẻ ngân hàng";
    document.querySelector(".invoice-customer-name").textContent = userName;
    document.querySelector(".invoice-customer-phone").textContent = phone;
    document.querySelector(".invoice-customer-address").textContent = address;
    document.querySelector(".invoice-customer-email").textContent = email;
    document.querySelector(".invoice-date").textContent = paymentDate;
    document.querySelector(".invoice-process-note").textContent = "Ghi chú: " + note;
    paymentMethod_toString = paymentMethod_toString + " " + bankName + " " + cardNumber;
    document.querySelector(".invoice-process-payment").textContent = "Phương thức thanh toán: " + paymentMethod_toString;
    displayItemInSummary();
}
function checkConditionToPay()
{
    let address = document.querySelector("#address-payment");
    let payByFTF= document.querySelector("#cash-on-delivery");
    let payByTrans = document.querySelector("#atm-payment");
    let atmPayment = document.querySelector("#atm-payment");
    let bankSelect = document.querySelector("#bank");
    let cardNumber = document.querySelector("#card-number");

    if(address.value == ''){
        showErrorPayment(address, "Vui lòng nhập địa chỉ giao hàng");
        address.focus();
        return false;
    } 

    
    if(!payByFTF.checked && !payByTrans.checked){
        showErrorPayment(payByFTF, "Vui lòng chọn phương thức thanh toán");
        return false;
    }
    
    if(atmPayment.checked && bankSelect.value === ""){
        showErrorPayment(bankSelect, "Vui lòng chọn ngân hàng");
        return false;
    }

    
    if(atmPayment.checked && cardNumber.value == '')
    {
        showErrorPayment(cardNumber, "Vui lòng nhập mã số thẻ");
        cardNumber.focus();
        return false;
    }
    return true;
}
function showErrorPayment(input, message) {
    console.log(input.id);
    var errorDiv;
    if (input.id === "cash-on-delivery" || input.id === "atm-payment") {
        errorDiv = document.getElementById("payment-method-error");
    }  
    else if(input.id === "bank"){
        errorDiv = document.getElementById("select-bank");
    }
    else if(input.id === "card-number"){
        errorDiv = document.getElementById("payment-card-method-error");
    }
    else {
        errorDiv = input.parentNode.querySelector(".error-msg-payment");
    }

    if (errorDiv) {
        var symbolError = '<i class="fa-solid fa-circle-xmark"></i>';
        errorDiv.innerHTML = symbolError + " " + message;
        errorDiv.classList.add("show");
    }
}

function clearErrorPayment() {
    let paymentError = document.querySelector("#overlay-payment");
    paymentError.querySelectorAll(".error-msg-payment").forEach((errorDiv) => {
        errorDiv.innerHTML = "";
        errorDiv.classList.remove("show");
    });
}


function displayItemInSummary() {
    let html = '';
    let cart = sessionStorage.getItem("cart");
    cart = JSON.parse(cart);
    console.log(cart);
    cart.forEach(item => {
        totalAmount += item.price * item.quantity;
        html += `
            <div class="invoice-product">
                <span class="invoice-product-img">
                    <img src = "${item.image}" style="width: 30px; object-fit: cover; vertical-align: middle; margin-right:8px">
                </span>
                <span class="invoice-product-name">${item.pd_name}</span>
                <span class="invoice-product-quantity">X${item.quantity}</span>
                <span class="space">........................................................................</span>
                <span class="invoice-product-price">${parseInt(item.price * item.quantity).toLocaleString("vi-VN")}đ</span>
            </div>                                
        `;
    })
    document.querySelector(".invoice-product-list-container").innerHTML = html;
    document.querySelector(".invoice-total-price").innerHTML = totalAmount.toLocaleString('vi-VN') + "đ";
}

document.querySelector("#submit-invoice").addEventListener("click", function () {
    if(!checkToPaying()) return;
    getCartSummary();
    savePaymentIntoDatabase();
});

function checkToPaying()
{
    let selectSure = document.querySelector("#invoice-submit-checkbox")
    if(!selectSure.checked)
    {
        showToast("Vui lòng xác nhận rằng bạn đã đọc và kiểm tra trước khi thanh toán.", false);
        return false;
    }
    return true;
}

function showToast(message, isSuccess, duration = 2000) {
    const toast = document.createElement("div");
    toast.className = "toast";
    toast.textContent = message;
    toast.style.backgroundColor = isSuccess ? "#4caf50" : "#f44336";

    document.body.appendChild(toast);

    setTimeout(() => {
        toast.style.animation = "fadeout 0.3s ease forwards";
        setTimeout(() => toast.remove(), 300);
    }, duration);

    return duration + 300; 
}

function getCartSummary() {
    let cart = JSON.parse(sessionStorage.getItem("cart"));

    orderItems = [];
    cart.forEach(item => {
        orderItems.push({
            id: item.id,
            name: item.pd_name,
            quantity: item.quantity,
            price: item.price,
            totalPrice: item.price * item.quantity
        });
    });

    return orderItems;
}
function savePaymentIntoDatabase()
{
    console.log(paymentDate);
    $.ajax({
        type: "POST",
        url: "../../PHP/users/savePayment.php",
        data: {
            // address: address,
            note: note,
            paymentDate: paymentDate,
            paymentMethod: paymentMethod,
            bankName: bankName,
            cardNumber: cardNumber,
            totalAmount: totalAmount,
            orderItems: JSON.stringify(orderItems)
        },
        dataType: "json",
        success: function (response) {
            if (response.status === "success") {
                console.log("Success");
                const timeShown = showToast("Thanh toán thành công.", true);
                setTimeout(() => {
                    location.reload();
                }, timeShown);
            } else {
                console.log("Fail");
                showToast("Thanh toán thất bại.", false);
            }
            console.log("Server response:", response);
        }
        
    });
}