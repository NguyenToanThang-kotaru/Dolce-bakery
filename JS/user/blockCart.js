const slideshow = document.getElementById("slideshow");
const mainMenu = document.getElementById("mainMenu");
const brandStory = document.getElementById("brandStory");
const cart = document.getElementById("cart");
const shopcartContainer = document.getElementById("shopcart-container");
const backCart= document.getElementById("back-cart")
const CartPhone = document.getElementById("CartPhone");
const promotion = document.getElementsByClassName("promotion");
let flagBlockCart = 0;
function blockShopCart(){
    slideshow.style.display="none";
    mainMenu.style.display="none";
    brandStory.style.display="none";
    shopcartContainer.style.display = "block";
    for(let i = 0; i<promotion.length;i++){
        promotion[i].style.display = "none"
    }
}


function noneShopCart(){
    slideshow.removeAttribute("style");
    mainMenu.removeAttribute("style");
    brandStory.removeAttribute("style");
    shopcartContainer.removeAttribute("style");
}

cart.addEventListener("click",()=>{
    if(flagBlockCart==1){
        noneShopCart();
        flagBlockCart = 0;
        console.log("0");
    }
    else{
        blockShopCart();
        flagBlockCart = 1;
    }
})

CartPhone.addEventListener("click",()=>{
    if(flagBlockCart==1){
        noneShopCart();
        flagBlockCart = 0;
        console.log("0");
    }
    else{
        blockShopCart();
        flagBlockCart = 1;
    }
})



backCart.addEventListener("click",()=>{
    noneShopCart();
})