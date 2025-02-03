const oder_part = document.querySelector(".oder-part");
const product_part = document.querySelector(".product-part");
const customer_part = document.querySelector(".customer-part");
const admin_main = document.querySelector(".admin-main");
const admin_oder = document.querySelector("#admin-oder");
const admin_product = document.querySelector("#admin-product");
const admin_customer = document.querySelector("#admin-customer");
const admin = document.querySelector("#admin");
const profile_img =  document.querySelector("#profile");
const profile_part = document.querySelector(".profile-part");


function oderToggle(){
    oder_part.style.display = "block";
    admin_main.style.display = "none";
    customer_part.style.display = "none";
    product_part.style.display = "none";
    profile_part.style.display = "none";   
}

function customerToggle(){
    customer_part.style.display = "block";
    oder_part.style.display = "none";
    admin_main.style.display = "none";
    product_part.style.display = "none";
    profile_part.style.display = "none"; 
}

function productToggle(){
    product_part.style.display = "block";
    admin_main.style.display = "none";
    customer_part.style.display = "none";
    oder_part.style.display = "none";
    profile_part.style.display = "none";   
}

function returnMain(){
    oder_part.style.display = "none";
    customer_part.style.display = "none";
    product_part.style.display = "none" 
    admin_main.style.display = "block";
    profile_part.style.display = "none";
}

admin_oder.addEventListener("click",oderToggle);
admin_product.addEventListener("click",productToggle);
admin_customer.addEventListener("click",customerToggle);
admin.addEventListener("click",returnMain);

// add product

const add_form_1 = document.querySelector(".add-form-product");
const plus_1 = document.querySelector("#product-plus");
const product_table = document.querySelector(".product-table");
const back_1 = document.querySelectorAll(".back-product");
const fix_form_1 = document.querySelector(".fix-form-product");
const fix_btn_1 = document.querySelectorAll(".fix-btn-product");
const delete_btn_1 = document.querySelectorAll(".delete-btn-product");
const delete_acp_1 = document.querySelector("#delete-acp-product");
const delete_ovl_1 = document.querySelector("#delete-overlay-product");
const cancel_btn_1 = document.querySelector("#cancel-product");


const add_form_2 = document.querySelector(".add-form-customer");
const plus_2 = document.querySelector("#customer-plus");
const customer_table = document.querySelector(".customer-table");
const fix_form_2 = document.querySelector(".fix-form-customer   ");
const delete_acp_2 = document.querySelector("#delete-acp-customer");
const delete_ovl_2 = document.querySelector("#delete-overlay-customer");
const back_2 = document.querySelectorAll(".back-customer");
const delete_btn_2 = document.querySelectorAll(".delete-btn-customer");
const fix_btn_2 = document.querySelectorAll(".fix-btn-customer");
const cancel_btn_2 = document.querySelector("#cancel-customer");


function addFormProduct(){
    product_table.style.display = "none";
    add_form_1.style.display = "block";
    plus_1.style.display = "none";
    fix_form_1.style.display = "none";
    profile_part.style.display = "none";
    
}

function addFormCustomer(){
    customer_table.style.display = "none";
    add_form_2.style.display = "block";
    plus_2.style.display = "none";
    fix_form_2.style.display = "none";
    profile_part.style.display = "none";
    
}

function fixFormProduct(){
    product_table.style.display = "none";
    fix_form_1.style.display = "block";
    plus_1.style.display = "none";
    add_form_1.style.display = "none";
    profile_part.style.display = "none";
}


function fixFormCustomer(){
    customer_table.style.display = "none";
    fix_form_2.style.display = "block";
    plus_2.style.display = "none";
    add_form_2.style.display = "none";
    profile_part.style.display = "none";
}

function returnProduct(){
    product_table.removeAttribute("style");
    add_form_1.style.display = "none";
    plus_1.style.display = "block";
    fix_form_1.style.display = "none";
    delete_ovl_1.style.display = "none";
    profile_part.style.display = "none";
}

function returnCustomer(){
    customer_table.removeAttribute("style");
    add_form_2.style.display = "none";
    plus_2.style.display = "block";
    fix_form_2.style.display = "none";
    delete_ovl_2.style.display = "none";
    profile_part.style.display = "none";
}

function showNofiProduct(){
    delete_ovl_1.style.display = "block";
}

function showNofiCustomer(){
    delete_ovl_2.style.display = "block";
}

plus_1.addEventListener("click",addFormProduct);
plus_2.addEventListener("click",addFormCustomer);

delete_btn_1.forEach(button =>{
    button.addEventListener("click",showNofiProduct);
})

delete_btn_2.forEach(button =>{
    button.addEventListener("click",showNofiCustomer);
})

fix_btn_1.forEach(button =>{
    button.addEventListener("click",fixFormProduct);
})

fix_btn_2.forEach(button =>{
    button.addEventListener("click",fixFormCustomer);
})

back_1.forEach(button =>{
    button.addEventListener("click",returnProduct);
})


back_2.forEach(button =>{
    button.addEventListener("click",returnCustomer);
})

delete_acp_1.addEventListener("click",returnProduct);
delete_acp_2.addEventListener("click",returnCustomer);
cancel_btn_1.addEventListener("click",returnProduct);
cancel_btn_2.addEventListener("click",returnCustomer);

// profile

function showProfile(){
    profile_part.style.display = "block";
    admin_main.style.display = "none";
}

profile_img.addEventListener("click",showProfile);

// customer



