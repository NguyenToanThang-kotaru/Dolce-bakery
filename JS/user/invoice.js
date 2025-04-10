const payment = document.querySelector('.submit-payment-btn');
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
function getInfoSummary()
{
    let userName = document.querySelector(".payment-customer-name").textContent;
    let email = document.querySelector(".payment-customer-email").textContent;
    let phone = document.querySelector("#phone-payment").value;
    let address = document.querySelector("#address-payment").value;
    let note = document.querySelector("#note-payment").value;
    let paymentDate = document.querySelector(".payment-date").textContent;
    let paymentMethod = "Thanh toán khi nhận hàng.";
    let bankName = "";
    let bankNumber = "";
    if(document.querySelector("#atm-payment").checked)
    {
        paymentMethod = "Thanh toán bằng ngân hàng";
        bankName = document.querySelector("#bank").value;
        bankNumber = document.querySelector("#card-number").value;
    }

    document.querySelector(".invoice-customer-name").textContent = userName;
    document.querySelector(".invoice-customer-phone").textContent = phone;
    document.querySelector(".invoice-customer-address").textContent = address;
    document.querySelector(".invoice-date").textContent = paymentDate;
    document.querySelector(".invoice-process-note").textContent = "Ghi chú: " + note;
    document.querySelector(".invoice-process-payment").textContent = "Phương thức thanh toán: " + paymentMethod + " " + bankName + " " + bankNumber;
    
    console.log(userName);
    console.log(email);
    console.log(phone);
    console.log(address);
    console.log(note);
    console.log(paymentDate);
    console.log(paymentMethod + " " + bankName + " " + bankNumber);
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