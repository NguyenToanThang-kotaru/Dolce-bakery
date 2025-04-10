const slideshow = document.getElementById("slideshow");
const mainMenu = document.getElementById("mainMenu");
const brandStory = document.getElementById("brandStory");
const cart = document.getElementById("cart");
const shopcartContainer = document.getElementById("shopcart-container");
const backCart = document.getElementById("back-cart")
const CartPhone = document.getElementById("CartPhone");
const promotion = document.getElementsByClassName("promotion");
const bread_catelouge1 = document.querySelector(".bread-catelouge-container");
const cake_catelouge1 = document.querySelector(".cake-catelouge-container");
const cookie_catelouge1 = document.querySelector(".cookie-catelouge-container");
const main_container1 = document.querySelector(".main-containerPD");
let flagBlockCart = 0;
function blockShopCart() {
    slideshow.style.display = "none";
    mainMenu.style.display = "none";
    brandStory.style.display = "none";
    cake_catelouge1.style.display = "none";
    bread_catelouge1.style.display = "none";
    cookie_catelouge1.style.display  ="none";
    main_container1.style.display = "none";
    shopcartContainer.style.display = "block";
    for (let i = 0; i < promotion.length; i++) {
        promotion[i].style.display = "none"
    }
}

cart.addEventListener('click', function () {
    getCart(function (canOpen) {
        if (!canOpen) return;
        OnCart();
    });
});



function noneShopCart() {
    slideshow.removeAttribute("style");
    mainMenu.removeAttribute("style");
    brandStory.removeAttribute("style");
    shopcartContainer.removeAttribute("style");
    main_container1.style.display = "flex";
}

function OnCart() {
    if (flagBlockCart == 1) {
        noneShopCart();
        flagBlockCart = 0;
        console.log(flagBlockCart);
    }
    else {
        flagBlockCart = 1;
        console.log(flagBlockCart);
        blockShopCart();
    }
}

backCart.addEventListener("click", () => {
    if (flagBlockCart == 1) {
        flagBlockCart = 0;
        noneShopCart();
        console.log(flagBlockCart);
    }
})



CartPhone.addEventListener("click", () => {
    if (flagBlockCart == 1) {
        noneShopCart();
        flagBlockCart = 0;
        console.log(flagBlockCart);
    }
    else {
        blockShopCart();
        flagBlockCart = 1;
    }
})

let new_cart = [];

function addToCart(productId) {
    $.ajax({
        url: "../../PHP/carts/addToCart.php",
        type: "POST",
        data: {
            'product_id': productId
        },
        success: function (response) {
            alert(response);
        }
    });
}

function getCart(callback) {
    $.ajax({
        url: "../../PHP/carts/getCart.php",
        type: "POST",
        dataType: "json",
        success: function (response) {
            if (response.status === "error") {
                alert("Bạn cần đăng nhập");
                callback(false);
            }

            new_cart = response;
            sessionStorage.setItem("cart", JSON.stringify(new_cart));
            displayItemInCart();
            calculateTotal(new_cart);
            callback(true);
        }
    })
}

function displayItemInCart() {
    let html = '';
    new_cart.forEach(item => {
        html += `
            <div class="PDCart">
                <div id="PDCart1">
                    <img src="${item.image}" width="8%" height="100%" alt="">
                    <div id="PDCart-NP">
                        <div id="PDCart-Name">${item.name}</div>
                        <div id="PDCart-Price">${parseInt(item.price).toLocaleString("vi-VN")}đ</div>
                    </div>
                </div>
                <div id="PDCart2">
                    <div id="quantity-container">
                    <div id="downQuantity" onclick = "decreaseItemInCart(${item.id})"><i class="fa-solid fa-minus"></i></div>
                    <div id="PDCart-Quantity">${item.quantity}</div>
                    <div id="upQuantity" onclick = "addItemToCart(${item.id})"><i class="fa-solid fa-plus"></i></div>
                </div>
                    <div id="delete-icon" onclick = "removeItemFromCart(${item.id})">
                        <i class="fa-regular fa-trash-can"></i>
                    </div>
                </div>
            </div>
        `;
    })
    document.querySelector('#cart-body #list-PD').innerHTML = html;
}

function calculateTotal(cart) {
    let totalAmout = 0;
    cart.forEach(item => {
        totalAmout += item.price * item.quantity;
    })
    document.querySelector('#price-total').textContent = totalAmout.toLocaleString("vi-VN") + "đ";
}

function addItemToCart(id) {
    $.ajax({
        url: "../../PHP/carts/addToCart.php",
        type: "POST",
        data: {
            'product_id': id
        },
        success: function () {
            getCart();
        }
    });
    console.log("Them san pham: " + id);
}

function decreaseItemInCart(id) {
    $.ajax({
        url: "../../PHP/carts/decreaseInCart.php",
        type: "POST",
        data: {
            'product_id': id
        },
        success: function () {
            getCart();
        }
    });
    console.log("Giam san pham: " + id);
}

function removeItemFromCart(id) {
    $.ajax({
        url: "../../PHP/carts/removeFromCart.php",
        type: "POST",
        data: {
            'product_id': id
        },
        success: function () {
            getCart();
        }
    });
    console.log("Xoa san pham: " + id);
}