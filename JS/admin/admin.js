document.addEventListener("DOMContentLoaded", function() {

const oder_part = document.querySelector(".oder-part");
const product_part = document.querySelector(".product-part");
const customer_part = document.querySelector(".customer-part");
const admin_main = document.querySelector(".admin-main");
const admin_oder = document.querySelector("#admin-oder");
const admin_product = document.querySelector("#admin-product");
const admin_customer = document.querySelector("#admin-customer");
const admin_account = document.querySelector("#admin-account");
const admin = document.querySelector("#admin");
const profile_img =  document.querySelector("#profile");
const profile_part = document.querySelector(".profile-part");
const account_part = document.querySelector(".account-part");


function oderToggle(){
    oder_part.style.display = "block";
    admin_main.style.display = "none";
    customer_part.style.display = "none";
    product_part.style.display = "none";
    profile_part.style.display = "none";
    account_part.style.display = "none";   
}

function customerToggle(){
    customer_part.style.display = "block";
    oder_part.style.display = "none";
    admin_main.style.display = "none";
    product_part.style.display = "none";
    profile_part.style.display = "none"; 
    account_part.style.display = "none";
}

function productToggle(){
    product_part.style.display = "block";
    admin_main.style.display = "none";
    customer_part.style.display = "none";
    oder_part.style.display = "none";
    profile_part.style.display = "none"; 
    account_part.style.display = "none";  
}

function returnMain(){
    oder_part.style.display = "none";
    customer_part.style.display = "none";
    product_part.style.display = "none" 
    admin_main.style.display = "block";
    profile_part.style.display = "none";
    account_part.style.display = "none";
}

function accountToggle(){
    oder_part.style.display = "none";
    customer_part.style.display = "none";
    product_part.style.display = "none" 
    admin_main.style.display = "none";
    profile_part.style.display = "none";
    account_part.style.display = "block";
}

admin_oder.addEventListener("click",oderToggle);
admin_product.addEventListener("click",productToggle);
admin_customer.addEventListener("click",customerToggle);
admin.addEventListener("click",returnMain);
admin_account.addEventListener("click",accountToggle);

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

const add_form_3 = document.querySelector(".add-form-account");
const plus_3 = document.querySelector("#account-plus");
const account_table = document.querySelector(".account-table");
const fix_form_3 = document.querySelector(".fix-form-account   ");
const delete_acp_3 = document.querySelector("#delete-acp-account");
const delete_ovl_3 = document.querySelector("#delete-overlay-account");
const back_3 = document.querySelectorAll(".back-account");
const delete_btn_3 = document.querySelectorAll(".delete-btn-account");
const fix_btn_3 = document.querySelectorAll(".fix-btn-account");
const cancel_btn_3 = document.querySelector("#cancel-account");


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

function addFormAccount(){
    account_table.style.display = "none";
    add_form_3.style.display = "block";
    plus_3.style.display = "none";
    fix_form_3.style.display = "none";
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

function fixFormAccount(){
    account_table.style.display = "none";
    fix_form_3.style.display = "block";
    plus_3.style.display = "none";
    add_form_3.style.display = "none";
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

function returnAcount(){
    account_table.removeAttribute("style");
    add_form_3.style.display = "none";
    plus_3.style.display = "block";
    fix_form_3.style.display = "none";
    delete_ovl_3.style.display = "none";
    profile_part.style.display = "none";
}

function showNofiProduct(){
    delete_ovl_1.style.display = "block";
}

function showNofiCustomer(){
    delete_ovl_2.style.display = "block";
}

function showNofiAccount(){
    delete_ovl_3.style.display = "block";
}

plus_1.addEventListener("click",addFormProduct);
plus_2.addEventListener("click",addFormCustomer);
plus_3.addEventListener("click",addFormAccount);

delete_btn_1.forEach(button =>{
    button.addEventListener("click",showNofiProduct);
})

delete_btn_2.forEach(button =>{
    button.addEventListener("click",showNofiCustomer);
})

delete_btn_3.forEach(button =>{
    button.addEventListener("click",showNofiAccount);
})

fix_btn_1.forEach(button =>{
    button.addEventListener("click",fixFormProduct);
})

fix_btn_2.forEach(button =>{
    button.addEventListener("click",fixFormCustomer);
})

fix_btn_3.forEach(button =>{
    button.addEventListener("click",fixFormAccount);
})

back_1.forEach(button =>{
    button.addEventListener("click",returnProduct);
})


back_2.forEach(button =>{
    button.addEventListener("click",returnCustomer);
})

back_3.forEach(button =>{
    button.addEventListener("click",returnAcount);
})

delete_acp_1.addEventListener("click",returnProduct);
delete_acp_2.addEventListener("click",returnCustomer);
delete_acp_3.addEventListener("click",returnAcount);

cancel_btn_1.addEventListener("click",returnProduct);
cancel_btn_2.addEventListener("click",returnCustomer);
cancel_btn_3.addEventListener("click",returnAcount);

// profile

function showProfile(){
    profile_part.style.display = "block";
    admin_main.style.display = "none";
}

profile_img.addEventListener("click",showProfile);

// customer

// account
const act_status = document.querySelectorAll(".account-status");

function ChangeStatus(event){
    let select = event.target;

    if(select.value == "lock"){
        select.style.boxShadow = "0 0 5px 1px red";
    }
    else{
        select.style.boxShadow = "0 0 5px 1px rgb(47, 218, 70)";
    }
}

act_status.forEach(select => {
    select.addEventListener("change",ChangeStatus);
    ChangeStatus({target: select });
})
});

// role popup show 
function togglePopup(event) {
    let popup = document.getElementById("role-popup");
    let icon = event.target;

    let rect = icon.getBoundingClientRect();
    let top = rect.bottom + window.scrollY + 10;
    let left = rect.left + window.scrollX;  

    popup.style.top = `${top}px`;
    popup.style.left = `${left}px`;
    popup.style.display = popup.style.display === "block" ? "none" : "block";

    document.addEventListener("click", function hidePopup(e) {
        if (!popup.contains(e.target) && e.target !== icon) {
            popup.style.display = "none";
            document.removeEventListener("click", hidePopup);
        }
    });
}


