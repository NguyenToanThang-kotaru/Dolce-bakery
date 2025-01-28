const overlay = document.querySelector("#overlay");
const login_form = document.querySelector("#login-form");
const register_form = document.querySelector("#register-form");
const lg_highlight = document.querySelector(".lg-highlight-2");
const rg_highlight = document.querySelector(".rg-highlight-2");
const lg_btn = document.querySelector("#login-btn");
const close_eye = document.querySelector("#none-password");
const open_eye = document.querySelector("#block-password");
const lg_pass = document.querySelector("#lg-password");

function pageLogin(){
    overlay.style.display = "block";
    login_form.style.display = "block";
    register_form.style.display = "none";
}

lg_btn.addEventListener("click",pageLogin);

function pageRegister(){
    overlay.style.display = "block";
    login_form.style.display = "none";
    register_form.style.display = "block";
}

function returnHome(){
    overlay.style.display = "none";
}

function openEye(){
    close_eye.style.display = "none";
    lg_pass.type = "text";
    open_eye.style.display = "block";
}

function closeEye(){
    close_eye.style.display = "block";
    lg_pass.type = "password";
    open_eye.style.display = "none";
}

lg_highlight.addEventListener("click",pageRegister);
rg_highlight.addEventListener("click",pageLogin);
overlay.addEventListener("click",returnHome);

login_form.addEventListener("click",function(event){
    event.stopPropagation();
})

register_form.addEventListener("click",function(event){
    event.stopPropagation();
})

open_eye.style.display = "none";

close_eye.addEventListener("click",openEye);
open_eye.addEventListener("click",closeEye);




