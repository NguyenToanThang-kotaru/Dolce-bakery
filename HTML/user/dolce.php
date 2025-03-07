<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dolce Bakery</title>
    <link rel="stylesheet" href="../../CSS/user/topMenu.css">
    <link rel="stylesheet" href="../../CSS/user/slideShow.css">
    <link rel="stylesheet" href="../../CSS/user/brandStory.css">
    <link rel="stylesheet" href="../../CSS/user/footer.css">
    <link rel="stylesheet" href="../../CSS/user/login.css">
    <link rel="stylesheet" href="../../CSS/user/register.css">
    <link rel="stylesheet" href="../../CSS/user/mainMenu.css">
    <link rel="stylesheet" href="../../CSS/user/responsive.css">
    <link rel="stylesheet" href="../../CSS/user/cartShop.css">
    <link rel="stylesheet" href="../../CSS/user/catelouge.css">  
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    
</head>

<body style="margin: 0 0; padding: 0 0;background-color: #FAEEE7;">
    <div id="overlay">
        <div id="login-form">
            <div class="login-content">
                Welcome to <span class="highlight-1">DOLCE</span>
            </div>
            <div class="signup">
                <span class="blur">No Account?</span>
                <span class="lg-highlight-2">Sign up</span>
            </div>
            <form id=login-form-son name="login-form-son" action="../../PHP/users/UserCtrl.php" method="POST">
                <input type="hidden" name="login-form-son" value="1">
                <div class="login-username">
                    <label for="lg-username">Enter your username or email address</label><br>
                    <input type="text" name="lg-username" class="username lg-username" placeholder="Username or email address"><br>
                </div>
                <div class="login-password">
                    <label for="lg-password">Enter your Password</label><br>
                    <div class="password-container">
                        <input type="password" name="lg-password" class="password lg-password" placeholder="Password">
                        <i class="fa-solid fa-eye" id="block-password"></i>
                        <i class="fa-regular fa-eye-slash" id="none-password"></i>
                    </div>
                </div>
                <button type="submit" class="signin-btn">Sign in</button>
            </form>
        </div>

        <div id="register-form">
            <div class="register-content">
                Sign up
            </div>
            <div class="signin">
                <span class="blur">Have an Account?</span>
                <span class="rg-highlight-2">Sign in</span>
            </div>
            <form id="register-form-son" name = "register-form-son" action="../../PHP/users/UserCtrl.php" method="POST">
                <input type="hidden" name="register-form-son" value="1">
                <div class="register-username">
                    <label for="rg-username">Enter your username</label><br>
                    <input type="text" name="rg-username" class="username rg-username" placeholder="Username or email address" required><br>
                </div>

                <div class="register-username">
                    <label for="rg-email">Enter your email</label><br>
                    <input type="text" name="rg-email" class="username rg-email" placeholder="Username or email address" required><br>
                </div>


                <div class="register-info">
                    <div class="username-info">
                        <label for="rg-fullName"> Enter your full name</label>
                        <input type="text" name="rg-fullName" class="rg-info rg-fullName" placeholder="User name" required>
                    </div>
                    <div class="contactnumber-info">
                        <label for="rg-phone">Contact Number</label>
                        <input type="text" name="rg-phone" class="rg-info rg-phone" placeholder="Contact Numbers" required>
                    </div>
                </div>
                <div class="register-password">
                    <label for="rg-password">Enter your Password</label><br>
                    <div class="password-container">
                        <input type="password" name="rg-password" class="password rg-password" placeholder="Password" required>
                    </div>
                </div>
                <div class="register-password">
                    <label for="password">Enter your Password Again</label><br>
                    <div class="password-container">
                        <input type="password" class="password" placeholder="Password" required>
                    </div>
                </div>
                <button type="submit" id="signup-btn">Sign up</button>
            </form>
        </div>
    </div>
    <div id="container">
        <header style="position: fixed;width: 100%;top: 0px;z-index: 100;">
            <nav id="topMenu-container"
                style="background-color: #33272A; display: flex;padding: 16px; justify-content: space-between; align-items: center;flex-basis: 33.33%;">
                <div style="display: flex; align-items: center; color: white; cursor: pointer; width: fit-content; ">
                    <a href="#">
                        <img src="../../assest/Dolce.png" alt="" height="70px" id="return-mainshop">
                    </a>
                    <h3 style="margin-left: 8px">Bakery Shop</h3>
                </div>
                <div id="mid" style="display: flex;align-items: center;width: 30%;position: relative;">
                    <input type="text" placeholder="Search" id="search">
                    <div id="delete"><img src="../..//assest/Close.png" alt=""></div>
                </div>
                <div id="rightMenu">
                    <div id="cart" style="margin-left: 60px;"><img src="../../assest/Shopping cart.png" width="50%"></div>
                    <div id="menu">
                        <img src="../../assest/menu.png" id="menu2" alt="">
                        <ul id="menudacap">
                            <a href="#">
                                <li>Trang chủ</li>
                            </a>
                            <a href="#">
                                <li id="login-btn">Đăng nhập</li>
                            </a>
                            <a href="#">
                                <li style="display: none;"  id="infor">Thông tin</li>
                            </a>
                            <a href="#">
                                <li>Thực đơn</li>
                            </a>
                            <a href="#">
                                <li style="border-bottom:none;">Tin tức</li>
                            </a>
                            <a href="#">
                                <li id="CartPhone">Giỏ hàng</li>
                            </a>
                            <a href="#">
                                <li style="border-bottom:none; border-top: 1px solid black;display:none" id="log-out">Đăng xuất</li>
                                
                            </a>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <div class="bread-catelouge-container">
            <div class="show-product" id="product-list">
                <div class="title">
                    <img src="../../assest/Filter.png" alt="">
                    <div class="type">Bread</div>
                </div>
                <div class="product-container">
    
                        <div class="bread-product">
                            <div class="product-img">
                                <div class="img-effect"><img src="../../assest/bread1.png" alt=""></div>
                            </div>
                            <div class="product-name">Kem Cake</div>
                            <div class="product-end">
                                <div class="price">100,000 đ</div>
                                <div class="add-cart"><img src="../../assest/cart.png" alt=""></div> 
                            </div>
                        </div>
                        <div class="bread-product">
                            <div class="product-img">
                                <div class="img-effect"><img src="../../assest/bread1.png" alt=""></div>
                            </div>
                            <div class="product-name">Kem Cake</div>
                            <div class="product-end">
                                <div class="price">100,000 đ</div>
                                <div class="add-cart"><img src="../../assest/cart.png" alt=""></div> 
                            </div>
                        </div>
                        <div class="bread-product">
                            <div class="product-img">
                                <div class="img-effect"><img src="../../assest/bread1.png" alt=""></div>
                            </div>
                            <div class="product-name">Kem Cake</div>
                            <div class="product-end">
                                <div class="price">100,000 đ</div>
                                <div class="add-cart"><img src="../../assest/cart.png" alt=""></div> 
                            </div>
                        </div>
                        <div class="bread-product">
                            <div class="product-img">
                                <div class="img-effect"><img src="../../assest/bread1.png" alt=""></div>
                            </div>
                            <div class="product-name">Kem Cake</div>
                            <div class="product-end">
                                <div class="price">100,000 đ</div>
                                <div class="add-cart"><img src="../../assest/cart.png" alt=""></div> 
                            </div>
                        </div>
                    
    
           
                        <div class="bread-product">
                            <div class="product-img">
                                <div class="img-effect"><img src="../../assest/bread1.png" alt=""></div>
                            </div>
                            <div class="product-name">Kem Cake</div>
                            <div class="product-end">
                                <div class="price">100,000 đ</div>
                                <div class="add-cart"><img src="../../assest/cart.png" alt=""></div> 
                            </div>
                        </div>
                        <div class="bread-product">
                            <div class="product-img">
                                <div class="img-effect"><img src="../../assest/bread1.png" alt=""></div>
                            </div>
                            <div class="product-name">Kem Cake</div>
                            <div class="product-end">
                                <div class="price">100,000 đ</div>
                                <div class="add-cart"><img src="../../assest/cart.png" alt=""></div> 
                            </div>
                        </div>
                        <div class="bread-product">
                            <div class="product-img">
                                <div class="img-effect"><img src="../../assest/bread1.png" alt=""></div>
                            </div>
                            <div class="product-name">Kem Cake</div>
                            <div class="product-end">
                                <div class="price">100,000 đ</div>
                                <div class="add-cart"><img src="../../assest/cart.png" alt=""></div> 
                            </div>
                        </div>
                        <div class="bread-product">
                            <div class="product-img">
                                <div class="img-effect"><img src="../../assest/bread1.png" alt=""></div>
                            </div>
                            <div class="product-name">Kem Cake</div>
                            <div class="product-end">
                                <div class="price">100,000 đ</div>
                                <div class="add-cart"><img src="../../assest/cart.png" alt=""></div> 
                            </div>
                        </div>
                    
    
            
                        <div class="bread-product">
                            <div class="product-img">
                                <div class="img-effect"><img src="../../assest/bread1.png" alt=""></div>
                            </div>
                            <div class="product-name">Kem Cake</div>
                            <div class="product-end">
                                <div class="price">100,000 đ</div>
                                <div class="add-cart"><img src="../../assest/cart.png" alt=""></div> 
                            </div>
                        </div>
                </div>
                
              
            </div>

            <div class="bread-pagination">
            </div>
        </div>
        <div class="cake-catelouge-container">
            <div class="show-product" id="product-list">
                <div class="title">
                    <img src="../../assest/Filter.png" alt="">
                    <div class="type">Cake</div>
                </div>
                <div class="product-container">
    
                        <div class="cake-product">
                            <div class="product-img">
                                <div class="img-effect"><img src="../../assest/bread1.png" alt=""></div>
                            </div>
                            <div class="product-name">Kem Cake</div>
                            <div class="product-end">
                                <div class="price">100,000 đ</div>
                                <div class="add-cart"><img src="../../assest/cart.png" alt=""></div> 
                            </div>
                        </div>
                        <div class="cake-product">
                            <div class="product-img">
                                <div class="img-effect"><img src="../../assest/bread1.png" alt=""></div>
                            </div>
                            <div class="product-name">Kem Cake</div>
                            <div class="product-end">
                                <div class="price">100,000 đ</div>
                                <div class="add-cart"><img src="../../assest/cart.png" alt=""></div> 
                            </div>
                        </div>
                        <div class="cake-product">
                            <div class="product-img">
                                <div class="img-effect"><img src="../../assest/bread1.png" alt=""></div>
                            </div>
                            <div class="product-name">Kem Cake</div>
                            <div class="product-end">
                                <div class="price">100,000 đ</div>
                                <div class="add-cart"><img src="../../assest/cart.png" alt=""></div> 
                            </div>
                        </div>
                        <div class="cake-product">
                            <div class="product-img">
                                <div class="img-effect"><img src="../../assest/bread1.png" alt=""></div>
                            </div>
                            <div class="product-name">Kem Cake</div>
                            <div class="product-end">
                                <div class="price">100,000 đ</div>
                                <div class="add-cart"><img src="../../assest/cart.png" alt=""></div> 
                            </div>
                        </div>
                    
    
           
                        <div class="cake-product">
                            <div class="product-img">
                                <div class="img-effect"><img src="../../assest/bread1.png" alt=""></div>
                            </div>
                            <div class="product-name">Kem Cake</div>
                            <div class="product-end">
                                <div class="price">100,000 đ</div>
                                <div class="add-cart"><img src="../../assest/cart.png" alt=""></div> 
                            </div>
                        </div>
                        <div class="cake-product">
                            <div class="product-img">
                                <div class="img-effect"><img src="../../assest/bread1.png" alt=""></div>
                            </div>
                            <div class="product-name">Kem Cake</div>
                            <div class="product-end">
                                <div class="price">100,000 đ</div>
                                <div class="add-cart"><img src="../../assest/cart.png" alt=""></div> 
                            </div>
                        </div>
                        <div class="cake-product">
                            <div class="product-img">
                                <div class="img-effect"><img src="../../assest/bread1.png" alt=""></div>
                            </div>
                            <div class="product-name">Kem Cake</div>
                            <div class="product-end">
                                <div class="price">100,000 đ</div>
                                <div class="add-cart"><img src="../../assest/cart.png" alt=""></div> 
                            </div>
                        </div>
                        <div class="cake-product">
                            <div class="product-img">
                                <div class="img-effect"><img src="../../assest/bread1.png" alt=""></div>
                            </div>
                            <div class="product-name">Kem Cake</div>
                            <div class="product-end">
                                <div class="price">100,000 đ</div>
                                <div class="add-cart"><img src="../../assest/cart.png" alt=""></div> 
                            </div>
                        </div>
                    
    
            
                        
                </div>
                
              
            </div>

            <div class="cake-pagination">
            </div>
        </div>
        <div class="cookie-catelouge-container">
        <div class="show-product" id="product-list">
            <div class="title">
                <img src="../../assest/Filter.png" alt="">
                <div class="type">Cookie</div>
            </div>
            <div class="product-container">

                    <div class="cookie-product">
                        <div class="product-img">
                            <div class="img-effect"><img src="../../assest/bread1.png" alt=""></div>
                        </div>
                        <div class="product-name">Kem Cake</div>
                        <div class="product-end">
                            <div class="price">100,000 đ</div>
                            <div class="add-cart"><img src="../../assest/cart.png" alt=""></div> 
                        </div>
                    </div>
                    <div class="cookie-product">
                        <div class="product-img">
                            <div class="img-effect"><img src="../../assest/bread1.png" alt=""></div>
                        </div>
                        <div class="product-name">Kem Cake</div>
                        <div class="product-end">
                            <div class="price">100,000 đ</div>
                            <div class="add-cart"><img src="../../assest/cart.png" alt=""></div> 
                        </div>
                    </div>
                    <div class="cookie-product">
                        <div class="product-img">
                            <div class="img-effect"><img src="../../assest/bread1.png" alt=""></div>
                        </div>
                        <div class="product-name">Kem Cake</div>
                        <div class="product-end">
                            <div class="price">100,000 đ</div>
                            <div class="add-cart"><img src="../../assest/cart.png" alt=""></div> 
                        </div>
                    </div>
                    <div class="cookie-product">
                        <div class="product-img">
                            <div class="img-effect"><img src="../../assest/bread1.png" alt=""></div>
                        </div>
                        <div class="product-name">Kem Cake</div>
                        <div class="product-end">
                            <div class="price">100,000 đ</div>
                            <div class="add-cart"><img src="../../assest/cart.png" alt=""></div> 
                        </div>
                    </div>
                

       
                    <div class="cookie-product">
                        <div class="product-img">
                            <div class="img-effect"><img src="../../assest/bread1.png" alt=""></div>
                        </div>
                        <div class="product-name">Kem Cake</div>
                        <div class="product-end">
                            <div class="price">100,000 đ</div>
                            <div class="add-cart"><img src="../../assest/cart.png" alt=""></div> 
                        </div>
                    </div>
                    <div class="cookie-product">
                        <div class="product-img">
                            <div class="img-effect"><img src="../../assest/bread1.png" alt=""></div>
                        </div>
                        <div class="product-name">Kem Cake</div>
                        <div class="product-end">
                            <div class="price">100,000 đ</div>
                            <div class="add-cart"><img src="../../assest/cart.png" alt=""></div> 
                        </div>
                    </div>
                    <div class="cookie-product">
                        <div class="product-img">
                            <div class="img-effect"><img src="../../assest/bread1.png" alt=""></div>
                        </div>
                        <div class="product-name">Kem Cake</div>
                        <div class="product-end">
                            <div class="price">100,000 đ</div>
                            <div class="add-cart"><img src="../../assest/cart.png" alt=""></div> 
                        </div>
                    </div>
                    <div class="cookie-product">
                        <div class="product-img">
                            <div class="img-effect"><img src="../../assest/bread1.png" alt=""></div>
                        </div>
                        <div class="product-name">Kem Cake</div>
                        <div class="product-end">
                            <div class="price">100,000 đ</div>
                            <div class="add-cart"><img src="../../assest/cart.png" alt=""></div> 
                        </div>
                    </div>
                

        
                    <div class="cookie-product">
                        <div class="product-img">
                            <div class="img-effect"><img src="../../assest/bread1.png" alt=""></div>
                        </div>
                        <div class="product-name">Kem Cake</div>
                        <div class="product-end">
                            <div class="price">100,000 đ</div>
                            <div class="add-cart"><img src="../../assest/cart.png" alt=""></div> 
                        </div>
                    </div>
            </div>
            
          
        </div>

        <div class="cookie-pagination">
        </div>
</div>
        <div id="slideshow">
            <div id="run">
                <img src="../../assest/slideshow.jpg" width="100%" class="img" alt="">
                <img src="../../assest/slideshow1.jpg" width="100%" class="img" alt="">
                <img src="../../assest/Slidesho3.jpg" width="100%" class="img" alt="">
            </div>
        </div>

        <div class="promotion" style="margin-top: 102px;"><img src="../../assest/slideshow.jpg"
                style="width: 100%;height: 100%;object-fit: cover;" alt=""></div>
        <div class="promotion"><img src="../../assest/slideshow1.jpg" style="width: 100%;height: 100%;object-fit: cover;"
            alt=""></div>
        <div class="promotion"><img src="../../assest/slidesho3.jpg" style="width: 100%;height: 100%;object-fit: cover;"
                alt=""></div>

                
        <div id="mainMenu">
            <h1 id="MenuTitle">Menu</h1>
            <div id="selection">
                <div class="menuOption">
                    <img src="../../assest/croisant Icon.png" width="100%" alt="" id="bread-part">
                    <h3>Bánh mì</h3>
                </div>
                <div class="menuOption">
                    <img src="../../assest/HPBD ICON.png" width="100%" alt="" id="cake-part">
                    <h3>Bánh kem</h3>
                </div>
                <div class="menuOption">
                    <img src="../../assest/Mouse Icon.png" width="80%" alt="" id="cookie-part">
                    <h3>Cookies</h3>
                </div>
            </div>
        </div>
        

        <div id="brandStory">
            <div id="story">
                <h1>Brand Story</h1>
                <h3>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatum perferendis aperiam vel dolor
                    minima nesciunt mollitia accusantium aspernatur sapiente, voluptatibus iusto doloribus aliquam modi
                    distinctio asperiores ipsum cumque quibusdam assumenda?</h3>
            </div>
            <div id="imgBrand"><img src="../../assest/story.png" width="30%"></div>
        </div>
        <div id="shopcart-container">
            <div id="cart-header">
                <i class="fa-solid fa-arrow-left" id="back-cart"></i>
                <h1>Giỏ hàng</h1>
            </div>
            <div id="cart-body">
                <p id="Title">Products</p>
                <div id="list-PD">
                    <div class="PDCart">
                        <div id="PDCart1">
                            <img src="../../assest/Dolce.png" width="8%" height="100%" alt="">
                            <div id="PDCart-NP">
                                <div id="PDCart-Name">Sản phẩm 1</div>
                                <div id="PDCart-Price">100.000đ</div>
                            </div>
                        </div>
                        <div id="PDCart2">
                            <div id="quantity-container">
                                <div id="downQuantity"><i class="fa-solid fa-minus"></i></div>
                                <div id="PDCart-Quantity">1</div>
                                <div id="upQuantity"><i class="fa-solid fa-plus"></i></div>
                            </div>
                            <div id="delete-icon">
                                <i class="fa-regular fa-trash-can"></i>
                            </div>
                        </div>
                    </div>
        
        
                    <div class="PDCart">
                        <div id="PDCart1">
                            <img src="../../assest/Dolce.png" width="8%" height="100%" alt="">
                            <div id="PDCart-NP">
                                <div id="PDCart-Name">Sản phẩm 1</div>
                                <div id="PDCart-Price">100.000đ</div>
                            </div>
                        </div>
                        <div id="PDCart2">
                            <div id="quantity-container">
                                <div id="downQuantity"><i class="fa-solid fa-minus"></i></div>
                                <div id="PDCart-Quantity">1</div>
                                <div id="upQuantity"><i class="fa-solid fa-plus"></i></div>
                            </div>
                            <div id="delete-icon">
                                <i class="fa-regular fa-trash-can"></i>
                            </div>
                        </div>
                    </div>
        
                    <div class="PDCart">
                        <div id="PDCart1">
                            <img src="../../assest/Dolce.png" width="8%" height="100%" alt="">
                            <div id="PDCart-NP">
                                <div id="PDCart-Name">Sản phẩm 1</div>
                                <div id="PDCart-Price">100.000đ</div>
                            </div>
                        </div>
                        <div id="PDCart2">
                            <div id="quantity-container">
                                <div id="downQuantity"><i class="fa-solid fa-minus"></i></div>
                                <div id="PDCart-Quantity">1</div>
                                <div id="upQuantity"><i class="fa-solid fa-plus"></i></div>
                            </div>
                            <div id="delete-icon">
                                <i class="fa-regular fa-trash-can"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="cart-footer">
                <div style="display: flex; margin-left: 1.5%;">
                    <p>Tạm tính:</p>
                    <p id="price-total">0đ</p>
                </div>
                <p id="buy">Mua Ngay</p>
            </div>
        </div>
        <!-- -------------------------------------FOoter------------------------------------- -->
        <footer class="container-footer">
            <div style="display: flex;justify-content: space-between;width: 100%;">
                <div id="logo-section">
                    <img src="../../assest/Dolce.png" width="40%" alt="Logo" id="footer-logo">
                </div>
                <div id="links-section">
                    <div id="learn-more">
                        <h3>Learn More</h3>
                        <ul>
                            <li><a href="#">About Lift</a></li>
                            <li><a href="#">Press Releases</a></li>
                            <li><a href="#">Environment</a></li>
                            <li><a href="#">Jobs</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Contact Us</a></li>
                        </ul>
                    </div>
                    <div id="tickets-booking">
                        <h3>Tickets & Booking</h3>
                        <ul>
                            <li><a href="#">Lift Tickets</a></li>
                            <li><a href="#">Season Passes</a></li>
                            <li><a href="#">Vacation Packages</a></li>
                        </ul>
                    </div>
                    <div id="contact-section">
                        <h3>Contact Us</h3>
                        <p>Address: XX/ XX/ XX/ HCM</p>
                        <p>Phone: <a href="#" style="color: red;">123-456-7890</a></p>
                    </div>

                </div>
                <div id="social-section">
                    <h3>Social</h3>
                    <div style="display: flex;">
                        <a href="#"><img src="../../assest/fb.png" alt="Facebook"></a>
                        <a href="#"><img src="../../assest/ins.png" alt="Twitter"></a>
                        <a href="#"><img src="../../assest/Twitter.png" alt="YouTube"></a>
                    </div>
                </div>
            </div>

            <div id="copyright-section">
                <p>© 2025 Nguyen Toan Thang | All Rights Reserved</p>
            </div>
        </footer>


    </div>



    <script src="../../JS/user/clear.js"></script>
    <script src="../../JS/user/slideShow.js"></script>
    <script src="../../JS/user/blocklogin.js"></script>
    <script src="../../JS/user/blockCart.js"></script>
    <script src="../../JS/user/pagination.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../JS/user/userAjax.js"></script>
</body>

</html>