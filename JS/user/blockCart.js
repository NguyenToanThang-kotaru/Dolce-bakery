let new_cart = [];
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
        document.getElementById("InfoPD-container").style.display = "none";
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


function addToCart(productId, quantity = 1) {
    $.ajax({
        url: "../../PHP/carts/addToCartById.php",
        type: "POST",
        data: {
            'product_id': productId,
            'quantity': quantity,
        },
        success: function (response) {
            // alert(response);
            if(response.includes("Bạn cần đăng nhập"))
            {
                showToast("Bạn cần đăng nhập để mua hàng.", false);
            }
            else{
                $('.cart-count').text(response);
                getCart();
                showToast("Đã thêm sản phẩm vào giỏ hàng.", true);
            }
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
                showToast("Bạn cần đăng nhập để xem giỏ hàng.", false);
                if (typeof callback === "function") callback(false);
                return;
            }

            new_cart = response;
            sessionStorage.setItem("cart", JSON.stringify(new_cart));
            displayItemInCart();
            calculateTotal(new_cart);
            if (typeof callback === "function") callback(true);
        }
    });
}

function displayItemInCart() {
    let html = '';
    new_cart.forEach(item => {
        html += `
            <div class="PDCart">
                <div id="PDCart1">
                    <img src="${item.image}" width="8%" height="100%" alt="">
                    <div id="PDCart-NP">
                        <div id="PDCart-Name">${item.pd_name}</div>
                        <div id="PDCart-Price">${parseInt(item.price).toLocaleString("vi-VN")}đ</div>
                    </div>
                </div>
                <div id="PDCart2">
                    <div id="quantity-container">
                    <div id="downQuantity" onclick = "decreaseItemInCart(${item.id})"><i class="fa-solid fa-minus"></i></div>
                    <div id="PDCart-Quantity">${item.quantity}</div>
                    <div id="upQuantity" onclick = "addItemToCart(${item.id},1)"><i class="fa-solid fa-plus"></i></div>
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
        url: "../../PHP/carts/addToCartById.php",
        type: "POST",
        data: {
            'product_id': id
        },
        success: function () {
            getCart(() => {
                itemQuantityCount();
            });
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
            getCart(() => {
                itemQuantityCount();
            });
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
            getCart(() => {
                itemQuantityCount();
            });
        }
    });
    console.log("Xoa san pham: " + id);
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

const addToCartButton = document.querySelector("#InfoPD-container .add-cart-info");
addToCartButton.addEventListener("click", function () {
    let imgUrl = document.querySelector("#InfoPD-container #product-img").getAttribute("src");
    let quantity = parseInt(document.querySelector(".QuantityPD-container #quantity-value").textContent);
    addToCartByImage(imgUrl, quantity);
});

function addToCartByImage(imageUrl, quantity = 1) {
    $.ajax({
        url: "../../PHP/carts/addToCartByImg.php",
        type: "POST",
        data: { image_url: imageUrl },
        success: function (productId) {
            if (productId === "not_found") {
                showToast("Không tìm thấy sản phẩm.", false);
                return;
            }
            addToCart(productId,quantity);
        }
    });
}

function changeQuantity(change) {
    let quantityElement = document.getElementById('quantity-value');
    let currentQuantity = parseInt(quantityElement.textContent);
    let newQuantity = currentQuantity + change;

    if (newQuantity >= 1) {
        quantityElement.textContent = newQuantity;
    }
}

itemQuantityCount();
function itemQuantityCount() {
    if (!localStorage.getItem("isLoggedIn")) {
        document.querySelector('.cart-count').textContent = 0;
        return;
    }

    let cart = sessionStorage.getItem("cart");
    if (!cart) return; 
    let total = 0;
    cart = JSON.parse(cart); 
    cart.forEach(item => {
        total += parseInt(item.quantity);
    });
    console.log(total);
    document.querySelector('.cart-count').textContent = total;
}
