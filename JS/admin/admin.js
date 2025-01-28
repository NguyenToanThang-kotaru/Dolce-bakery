const oder_part = document.querySelector(".oder-part");
const product_part = document.querySelector(".product-part");
const customer_part = document.querySelector(".customer-part");
const admin_main = document.querySelector(".admin-main");
const admin_oder = document.querySelector("#admin-oder");
const admin_product = document.querySelector("#admin-product");
const admin_customer = document.querySelector("#admin-customer");
const admin = document.querySelector("#admin");


function oderToggle(){
    oder_part.style.display = "block";
    admin_main.style.display = "none";
    customer_part.style.display = "none";
    product_part.style.display = "none";   
}

function customerToggle(){
    customer_part.style.display = "block";
    oder_part.style.display = "none";
    admin_main.style.display = "none";
    product_part.style.display = "none"; 
}

function productToggle(){
    product_part.style.display = "block";
    admin_main.style.display = "none";
    customer_part.style.display = "none";
    oder_part.style.display = "none";   
}

function returnMain(){
    oder_part.style.display = "none";
    customer_part.style.display = "none";
    product_part.style.display = "none" 
    admin_main.style.display = "block";
}

admin_oder.addEventListener("click",oderToggle);
admin_product.addEventListener("click",productToggle);
admin_customer.addEventListener("click",customerToggle);
admin.addEventListener("click",returnMain);

