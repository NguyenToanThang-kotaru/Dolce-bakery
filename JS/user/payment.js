
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

let buy=document.getElementById("buy");
let blockPayment=document.getElementById("overlay-payment");
let closePayment=document.getElementById("close-payment");
let flag_payment=0;
buy.addEventListener("click",function(){
    if(flag_payment===0){
                        
        blockPayment.style.display="block";
        flag_payment=1;
    }

    else{
        
        blockPayment.style.display="none";
        flag_payment=0;

    }
    closePayment.addEventListener("click",function(){
       blockPayment.style.display="none";
        flag_payment=0;
    })
     
})




