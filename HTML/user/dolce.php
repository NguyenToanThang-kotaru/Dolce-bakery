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
    <link rel="stylesheet" href="../../CSS/user/InfoUser.css">
    <link rel="stylesheet" href="../../CSS/user/infoproduct.css">
    <link rel="stylesheet" href="../../CSS/user/allPD.css">
    <link rel="stylesheet" href="../../CSS/user/notificationRegist.css">
    <link rel="stylesheet" href="../../CSS/user/payment.css">
    <link rel="stylesheet" href="../../CSS/user/invoice.css">
    <script src="https://kit.fontawesome.com/1dbf430077.js" crossorigin="anonymous"></script>
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
                    <div class="error-msg"></div>
                </div>
                <div class="login-password">
                    <label for="lg-password">Enter your Password</label><br>
                    <div class="password-container">
                        <input type="password" name="lg-password" class="password lg-password" placeholder="Password">
                        <i class="fa-solid fa-eye" id="block-password"></i>
                        <i class="fa-regular fa-eye-slash" id="none-password"></i>
                    </div>
                    <div class="error-msg"></div>
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
            <form id="register-form-son" name="register-form-son" action="../../PHP/users/UserCtrl.php" method="POST">
                <input type="hidden" name="register-form-son" value="1">
                <div class="register-username">
                    <label for="rg-username">Enter your username</label><br>
                    <input type="text" name="rg-username" class="username rg-username" placeholder="Username or email address"
                        required><br>
                    <div class="error-msg"></div>
                </div>

                <div class="register-username">
                    <label for="rg-email">Enter your email</label><br>
                    <input type="text" name="rg-email" class="username rg-email" placeholder="Username or email address"
                        required><br>
                    <div class="error-msg"></div>
                </div>


                <div class="register-info">
                    <div class="username-info">
                        <label for="rg-fullName"> Enter your full name</label>
                        <input type="text" name="rg-fullName" class="rg-info rg-fullName" placeholder="User name" required>
                        <div class="error-msg"></div>
                    </div>
                    <div class="contactnumber-info">
                        <label for="rg-phone">Contact Number</label>
                        <input type="text" name="rg-phone" class="rg-info rg-phone" placeholder="Contact Numbers" required>
                        <div class="error-msg"></div>
                    </div>
                </div>
                <div class="register-password">
                    <label for="rg-password">Enter your Password</label><br>
                    <input type="password" name="rg-password" class="password rg-password" placeholder="Password" required>
                    <div class="error-msg"></div>
                </div>
                <div class="register-password">
                    <label for="password">Enter your Password Again</label><br>
                    <input type="password" class="password rg-confirm-password" placeholder="Password" required>
                    <div class="error-msg"></div>
                </div>
                <button type="submit" id="signup-btn">Sign up</button>
            </form>
        </div>
    </div>
    <div id="container">
        <header style="position: fixed;width: 100%;top: 0px;z-index: 100;">
            <nav id="topMenu-container"
                style="background-color: #33272A; display: flex;padding: 16px; justify-content: space-between; align-items: center;flex-basis: 33.33%;">
                <div id="main-page" style="display: flex; align-items: center; color: white; cursor: pointer; width: fit-content; ">
                    <a href="#">
                        <img src="../../assest/Dolce.png" alt="" height="70px" id="return-mainshop">
                        <span class="cart-count">0</span>
                    </a>
                    <h3 style="margin-left: 8px">Bakery Shop</h3>
                </div>
                <div id="mid"
                    style="display: flex;align-items: center;width: 30%;position: relative; flex-direction: column;">
                    <input type="text" placeholder="Search" id="search">
                    <div id="delete"><img src="../..//assest/Close.png" alt=""></div>
                    <div id="suggestion"></div>
                </div>
                <div id="rightMenu">
                    <div id="cart" style="margin-left: 60px;"><img src="../../assest/Shopping cart.png" width="50%">
                    </div>
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
                                <li style="display: none;" id="infor">Thông tin</li>
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
                                <li style="border-bottom:none; border-top: 1px solid black;display:none" id="log-out">
                                    Đăng xuất</li>

                            </a>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <div id="InfoPD-container">
            <div id="Left">
                <div id="PD-imgage">
                    <img src="../../assest/PD-Manager">
                </div>

            </div>
            <div id="Right">
                <div class="PD-name">
                    <h1>Bánh kem 1</h1>
                </div>
                <div id="Decribe">
                    <p class="PD-decribe">Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus corporis
                        error aliquam velit eius facilis eveniet veniam tempore dolores ipsam. Beatae maiores nostrum,
                        doloribus ex incidunt repudiandae libero iste adipisci?</p>
                </div>
                <div id="Quantity-Price">
                    <p class="Price">100.000đ</p>
                    <div class="QuantityPD-container">
                        <i class="fa-solid fa-minus"></i>
                        <p>1</p>
                        <i class="fa-solid fa-plus"></i>
                    </div>
                </div>
                <div id="button">
                    <button class="add-cart-info" type="submit">Thêm vào giỏ hàng</button>
                    <button class="Buy" type="submit">Mua Ngay</button>
                </div>
            </div>

        </div>

        <div class="bread-catelouge-container">

            <div class="product-filter">
                <img src="../../assest/Star.png" alt="" class="filtershow" onclick="toggleFilter('bread')">

                <div class="filter" id="filter-sidebar">
                    <div class="filter-title">
                        <img src="../../assest/filterrrr2.png" alt="" style="width: 10%;cursor: pointer;"
                            onclick="toggleFilter('bread')">
                        <span>Bộ lọc tìm kiếm</span>
                    </div>
                    <div class="level-price">
                        <h4>Mức giá</h4>
                        <div class="option-price"><input type="checkbox" value="0-50000"><span>Dưới 50.000đ</span></div>
                        <div class="option-price"><input type="checkbox" value="50000-100000"><span>Từ 50.000đ -
                                100.000đ</span></div>
                        <div class="option-price"><input type="checkbox" value="100000-150000"><span>Từ 100.000đ -
                                150.000đ</span></div>
                    </div>
                    <div class="price-range">
                        <span>Nhập khoảng giá phù hợp:</span>
                        <div class="slider-value">
                            <span id="min-value-bread">20.000đ</span>
                            <span style="border: none; width: 50px;">~</span>
                            <span id="max-value-bread">200.000đ</span>
                        </div>
                        <div class="slider-container">
                            <input type="range" id="min-price-bread" min="20000" max="200000" step="10000"
                                value="20000">
                            <input type="range" id="max-price-bread" min="20000" max="200000" step="10000"
                                value="200000">
                        </div>

                        <span class="acp-filter" onclick="render_filter()">Done</span>
                    </div>
                </div>
                <div class="show-product" id="product-list">
                    <div class="title">
                        <div class="type">Bread</div>
                    </div>
                    <div class="arrange-filter">
                        <span>Sắp xếp theo:</span>
                        <select name="" class="arrange-sl">
                            <option value="impression">Nổi bật</option>
                            <option value="up">Giá cao nhất</option>
                            <option value="down">Giá thấp nhất</option>
                        </select>
                    </div>

                    <img src="../../assest/backmain.png" alt="" class="backtomain">

                    <div class="product-container" id="bread-container">
                        <?php $type = "bread";
                        include '../../PHP/users/uploadpd.php'; ?>
                    </div>

                </div>
            </div>

            <div class="bread-pagination">
            </div>
        </div>
        <div class="cake-catelouge-container">
            <div class="product-filter">
                <img src="../../assest/Star.png" alt="" class="filtershow" onclick="toggleFilter('cake')">

                <div class="filter" id="filter-sidebar">
                    <div class="filter-title">
                        <img src="../../assest/filterrrr2.png" alt="" style="width: 10%;cursor: pointer;"
                            onclick="toggleFilter('cake')">
                        <span>Bộ lọc tìm kiếm</span>
                    </div>
                    <div class="level-price">
                        <h4>Mức giá</h4>
                        <div class="option-price"><input type="checkbox" value="0-300000"><span>Dưới 300.000đ</span>
                        </div>
                        <div class="option-price"><input type="checkbox" value="300000-500000"><span>Từ 300.000đ -
                                500.000đ</span></div>
                        <div class="option-price"><input type="checkbox" value="500000-800000"><span>Từ 500.000đ -
                                800.000đ</span></div>



                    </div>
                    <div class="price-range">
                        <span>Nhập khoảng giá phù hợp:</span>
                        <div class="slider-value">
                            <span id="min-value-cake">100.000đ</span>
                            <span style="border: none; width: 50px;">~</span>
                            <span id="max-value-cake">1.000.000đ</span>
                        </div>
                        <div class="slider-container">
                            <input type="range" id="min-price-cake" min="100000" max="1000000" step="10000"
                                value="100000">
                            <input type="range" id="max-price-cake" min="100000" max="1000000" step="10000"
                                value="1000000">
                        </div>

                        <span class="acp-filter" onclick="render_filter()">Done</span>
                    </div>
                </div>

                <div class="show-product" id="product-list">
                    <div class="title">
                        <div class="type">Cake</div>
                    </div>
                    <div class="arrange-filter">
                        <span>Sắp xếp theo:</span>
                        <select name="" class="arrange-sl">
                            <option value="impression">Nổi bật</option>
                            <option value="up">Giá cao nhất</option>
                            <option value="down">Giá thấp nhất</option>
                        </select>
                    </div>

                    <img src="../../assest/backmain.png" alt="" class="backtomain">

                    <div class="product-container" id="cake-container">

                        <?php $type = "cake";
                        include '../../PHP/users/uploadpd.php'; ?>


                    </div>


                </div>
            </div>

            <div class="cake-pagination">
            </div>
        </div>
        <div class="cookie-catelouge-container">

            <div class="product-filter">
                <!-- <button id="filtershow" onclick="toggleFilter()">Filter</button> -->
                <img src="../../assest/Star.png" alt="" class="filtershow" onclick="toggleFilter('cookie')">

                <div class="filter" id="filter-sidebar">
                    <div class="filter-title">
                        <img src="../../assest/filterrrr2.png" alt="" style="width: 10%;cursor: pointer;"
                            onclick="toggleFilter('cookie')">
                        <span>Bộ lọc tìm kiếm</span>
                    </div>
                    <div class="level-price">
                        <h4>Mức giá</h4>
                        <div class="option-price"><input type="checkbox" value="0-50000"><span>Dưới 50.000đ</span></div>
                        <div class="option-price"><input type="checkbox" value="50000-100000"><span>Từ 50.000đ -
                                100.000đ</span></div>
                        <div class="option-price"><input type="checkbox" value="100000-150000"><span>Từ 100.000đ -
                                150.000đ</span></div>




                    </div>
                    <div class="price-range">
                        <span>Nhập khoảng giá phù hợp:</span>
                        <div class="slider-value">
                            <span id="min-value-cookie">20.000đ</span>
                            <span style="border: none; width: 50px;">~</span>
                            <span id="max-value-cookie">100.000đ</span>
                        </div>
                        <div class="slider-container">
                            <input type="range" id="min-price-cookie" min="20000" max="100000" step="10000"
                                value="20000">
                            <input type="range" id="max-price-cookie" min="20000" max="100000" step="10000"
                                value="100000">
                        </div>

                        <span class="acp-filter" onclick="render_filter()">Done</span>
                    </div>
                </div>  

                <div class="show-product" id="product-list">
                    <div class="title">
                        <div class="type">Cookie</div>
                    </div>
                    <div class="arrange-filter">
                        <span>Sắp xếp theo:</span>
                        <select name="" class="arrange-sl">
                            <option value="up">Giá cao nhất</option>
                            <option value="impression">Nổi bật</option>
                            <option value="down">Giá thấp nhất</option>
                        </select>
                    </div>

                    <img src="../../assest/backmain.png" alt="" class="backtomain">


                    <div class="product-container" id="cookie-container">

                        <?php $type = "cookie";
                        include '../../PHP/users/uploadpd.php'; ?>
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
        <div class="promotion"><img src="../../assest/slideshow1.jpg"
                style="width: 100%;height: 100%;object-fit: cover;" alt=""></div>
        <div class="promotion"><img src="../../assest/slidesho3.jpg" style="width: 100%;height: 100%;object-fit: cover;"
                alt=""></div>



        <!-- --------------------------display all product--------------------- -->
        <div class="main-containerPD allproduct-catelouge-container">

            <div class="product-filter">
                <!-- <img src="../../assest/Star.png" alt="" class="filtershow" onclick="toggleFilter('allproduct')"> -->

                <div class="filter" id="filter-sidebar">
                    <div class="filter-title">
                        <img src="../../assest/filterrrr2.png" alt="" style="width: 10%;cursor: pointer;"
                            onclick="toggleFilter('allproduct')">
                        <span>Bộ lọc tìm kiếm</span>
                    </div>
                    <div class="level-price">
                        <h4>Mức giá</h4>
                        <div class="option-price"><input type="checkbox" value="0-100000"><span>Dưới 100.000đ</span>
                        </div>
                        <div class="option-price"><input type="checkbox" value="100000-200000"><span>Từ 100.000đ -
                                200.000đ</span></div>
                        <div class="option-price"><input type="checkbox" value="200000-300000"><span>Từ 200.000đ -
                                300.000đ</span></div>
                        <div class="option-price"><input type="checkbox" value="300000-400000"><span>Từ 300.000đ -
                                400.000đ</span></div>
                        <div class="option-price"><input type="checkbox" value="400000-500000"><span>Từ 400.000đ -
                                500.000đ</span></div>
                        <div class="option-price"><input type="checkbox" value="500000-600000"><span>Từ 500.000đ -
                                600.000đ</span></div>
                        <div class="option-price"><input type="checkbox" value="600000-700000"><span>Từ 600.000đ -
                                700.000đ</span></div>





                    </div>
                    <div class="price-range">
                        <span>Nhập khoảng giá phù hợp:</span>
                        <div class="slider-value">
                            <span id="min-value-allproduct">20.000đ</span>
                            <span style="border: none; width: 50px;">~</span>
                            <span id="max-value-allproduct">700.000đ</span>
                        </div>
                        <div class="slider-container">
                            <input type="range" id="min-price-allproduct" min="20000" max="700000" step="10000"
                                value="20000">
                            <input type="range" id="max-price-allproduct" min="20000" max="700000" step="10000"
                                value="700000">
                        </div>

                        <span class="acp-filter" onclick="render_filter()">Done</span>
                    </div>
                </div>
                <div class="show-allproduct">
                    <div class="titleallPD">
                        <div>Products</div>
                    </div>
                    <div class="arrange-filter">
                        <span>Sắp xếp theo:</span>
                        <select name="" class="arrange-sl">
                            <option value="impression">Nổi bật</option>
                            <option value="up">Giá cao nhất</option>
                            <option value="down">Giá thấp nhất</option>
                        </select>
                    </div>
                    <img src="../../assest/Star.png" alt="" class="filtershow" onclick="toggleFilter('allproduct')">

                    <img src="../../assest/Star.png" alt="" class="filtershow" onclick="toggleFilter('allproduct')">

                    <div id="allproduct-container">
                        <?php include '../../PHP/users/displayProduct.php'; ?>
                    </div>


                </div>
            </div>

            <div class="allPD-pagination">
            </div>

        </div>


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
                    
                </div>
            </div>
            <div id="cart-footer">
                <div style="display: flex; margin-left: 1.5%;">
                    <p>Tạm tính:</p>
                    <p id="price-total"></p>
                </div>
                <button  id="buy">Mua Ngay</button>
            </div>
        </div>
        <!-- ------------------------------------infor-------------------------------------- -->
        <div id="overlayInfo">
            <div id="InfoUser-container">
                <div class="InfoUser-Title">
                    <i id="Back" class="fa-solid fa-arrow-right-from-bracket"></i>
                    <h1 class="Title">Thông tin</h1>
                
                </div>
            <div class="InfoUser_Detail">
                <div class="row">
                    <label for="account" class="Detail">Tài khoản: </label>
                    <span></span>
                </div>
                <div class="row">
                    <label for="fullname" class="Detail" >Họ và tên: </label>
                    <span></span>

                </div>
                
                <div class="row">
                    <label for="email" class="Detail" >Email:</label>
                    <span></span>
                </div>
                    
                <div class="row">
                    <label for="phone" class="Detail" >Số điện thoại: </label>
                    <span></span>
                </div>

                <div id="Buy-history">
                    <div class="History">Lịch sử mua hàng</div>
                </div>

            </div>

        </div>
    </div>
        <div id="overlay-payment">
            <div id="payment-container">
                <div class="payment-left-container">
                    <div class="payment-header">
                        <button id="close-payment">x</button>
                        <h3 class="header">THÔNG TIN THANH TOÁN</h3>
                    </div>
                    
                    <form id="payment-left-form">
                        <div class="cus-name">
                            <label><strong>Tên:</strong> </label><span class="payment-customer-name"></span>
                        </div>
                        
                        <br>
                        <div class="cus-email">
                            <label><strong>Email:</strong> </label><span class="payment-customer-email"></span>
                        </div>
                        <br>
                        <div class="cus-phone">
                            <label for="phone-payment" ><strong>Số điện thoại:</strong></label><span class="payment-customer-phone"></span>
                        </div>
                        <br />
                        <div class="cus-address">
                            <label for="address-payment"><strong>Địa chỉ:</strong> </label>
                            <input type="text" id="address-payment" placeholder="Nhập địa chỉ giao hàng" required />
                                
                        </div>
                        <br />
                        <div class="payment-customer-note">
                            <label for="note-payment"><strong>Ghi chú đơn hàng (tùy chọn)</strong></label> <br />
                            <input style="width: 30vw;" type="text" id="note-payment" placeholder="Nhập ghi chú cho đơn hàng" />

                        </div>
                        <div class="payment-left-footer">
                            <p id="payment-back-cart" style="display: inline-block; margin-top: 200px; color: #007BFF; text-decoration: none;text-align:left;cursor:pointer;margin-left: 0px;position:relative;top: 80px;">
                                ← Quay lại giỏ hàng
                            </p>
                        </div>
                        
                    </form>
                </div>

                <form class="order-summary">
                    <table class="payment-table">
                        <thead>
                            <tr style="border-bottom: 1px solid #ddd">
                                <th colspan="2" class="payment-heading">ĐƠN HÀNG CỦA BẠN</th>
                                <th>
                                <strong>Ngày đặt:
                                    <span class="payment-date">22/09/2005</span>
                                </strong>
                                </th>
                            </tr>
                            <tr class="order-header">
                                <th colspan="2"><strong>SẢN PHẨM</strong></th>
                                <th><strong>TẠM TÍNH</strong></th>
                            </tr>
                            <tr style="border-bottom: 1px solid #ddd">
                                <th class="payment-product-name">Tên sản phẩm</th>
                                <th class="payment-quantity">Số lượng</th>
                                <th class="payment-price">Giá</th>
                            </tr>
                        </thead>

                        <tbody id="product-list">
                            
                        </tbody>

                        <tfoot>
                        <tr style="border-top: 1px solid #ddd">
                            <td colspan="2">Tổng tạm tính:</td>
                            <td><span class="payment-total-product-price-value">1.200.200</span><sup>đ</sup></td>
                        </tr>
                        <tr>
                            <td colspan="2">Giao hàng:</td>
                            <td>Giao hàng miễn phí</td>
                        </tr>
                        <tr>
                            <td colspan="2">Tổng đơn:</td>
                            <td><span class="payment-total-price-value">12.000.000<sup>đ</sup></span></td>
                        </tr>
                        </tfoot>
                    </table>
                    
                    <h3>Phương thức thanh toán</h3>
                    <div>
                        <input type="radio" id="cash-on-delivery" name="payment" value="tm" />
                        <label for="cash-on-delivery">Thanh toán khi nhận hàng</label>
                    </div>
                    <div>
                        <input type="radio" id="atm-payment" name="payment" value="atm" />
                        <label for="atm-payment">Thanh toán bằng ATM</label>
                        <div id="atm-options">
                            <label for="bank">Chọn ngân hàng:</label>
                            <select id="bank">
                                <option value="">Chọn ngân hàng</option>
                                <option value="vietcombank">Vietcombank</option>
                                <option value="techcombank">Techcombank</option>
                                <option value="vpbank">VPBank</option>
                                <option value="agribank">Agribank</option>
                            </select>
                            <div id="select-bank" class="error-msg-payment"></div>
                            <br /><br />
                            <label for="card-number">Số thẻ:</label>
                            <input type="number" id="card-number" placeholder="Nhập số thẻ ATM" required />
                            <div id="payment-card-method-error" class="error-msg-payment"></div>
                        </div>
                    </div>
                    <div id="payment-method-error" class="error-msg-payment"></div>
                    <div class="payment-submit-background">
                        <button type="submit" id="submit-payment-btn">Thanh toán</button>
                    </div>
                </form>

            </div>

        </div>    
        <!-- -------------------------------------Hóa đơn thanh toán------------------------------------- -->
        <div id="overlay-invoice">
            <div id="invoice-container">
                <div class="invoice-header">
                    <button id="close-invoice">x</button>
                    <h3 class="header">HÓA ĐƠN THANH TOÁN</h3>
                </div>
                <div class="invoice-body">
                    <div class="invoice-customer-info">
                        <div class="invoice-customer-left">
                            <label><strong>Tên khách hàng:</strong></label>
                            <span class="invoice-customer-name"></span> <br />
                            <label><strong>Số điện thoại:</strong></label>
                            <span class="invoice-customer-phone"></span> <br />
                            <label><strong>Địa chỉ:</strong></label>
                            <span class="invoice-customer-address"></span> <br />
                            <label><strong>Email:</strong></label>
                            <span class="invoice-customer-email"></span> <br />
                            <label><strong>Voucher(nếu có):</strong></label>
                            <span class="invoice-customer-voucher"></span> <br />
                        </div>
                        <div class="invoice-customer-right">
                            <label><strong>Ngày đặt:</strong></label>
                            <span class="invoice-date"></span> <br />
                        </div>
                            
                    
                    </div>
                    <div class="invoice-product-list">
                        <h3 class="invoice-product-list-header">Sản phẩm</h3>
                        <!-- <span class="payment-product"></span> -->
                        <div class="invoice-product-list-container">
                            <div class="invoice-product">
                                <span class="invoice-product-img">
                                    <img src>
                                </span>
                                <span class="invoice-product-name">Bánh kem trà xanh </span>
                                <span class="invoice-product-quantity">x2</span>
                                <span class="space">........................................................................</span>
                                <span class="invoice-product-price">9000000đ</span>
                            </div>
                            <div class="invoice-product">
                                <span class="invoice-product-name">Bánh kem trà xanh x2</span>
                                <span class="space">........................................................................</span>
                                <span class="invoice-product-price">9000000đ</span>
                            </div>
                            <div class="invoice-product">
                                <span class="invoice-product-name">Bánh kem trà xanh x2</span>
                                <span class="space">........................................................................</span>
                                <span class="invoice-product-price">9000000đ</span>
                            </div>
                            <div class="invoice-product">
                                <span class="invoice-product-name">Bánh kem trà xanh x2</span>
                                <span class="space">........................................................................</span>
                                <span class="invoice-product-price">9000000đ</span>
                            </div>
                            <div class="invoice-product">
                                <span class="invoice-product-name">Bánh kem trà xanh x2</span>
                                <span class="space">........................................................................</span>
                                <span class="invoice-product-price">9000000đ</span>
                            </div>
                            <div class="invoice-product">
                                <span class="invoice-product-name">Bánh kem trà xanh x2</span>
                                <span class="space">........................................................................</span>
                                <span class="invoice-product-price">9000000đ</span>
                            </div>
                            <div class="invoice-product">
                                <span class="invoice-product-name">Bánh kem trà xanh x2</span>
                                <span class="space">........................................................................</span>
                                <span class="invoice-product-price">9000000đ</span>
                            </div>
                            <div class="invoice-product">
                                <span class="invoice-product-name">Bánh kem trà xanh x2</span>
                                <span class="space">........................................................................</span>
                                <span class="invoice-product-price">9000000đ</span>
                            </div>
                            <div class="invoice-product">
                                <span class="invoice-product-name">Bánh kem trà xanh x2</span>
                                <span class="space">........................................................................</span>
                                <span class="invoice-product-price">9000000đ</span>
                            </div>
                            <div class="invoice-product">
                                <span class="invoice-product-name">Bánh kem trà xanh x2</span>
                                <span class="space">........................................................................</span>
                                <span class="invoice-product-price">9000000đ</span>
                            </div>

                        </div>
                        
                        
                    </div>
                    <div class="invoice-process">
                        <div class="invoice-process-total">
                            Tổng cộng:
                            <span class="invoice-total-price">12.000.000đ</span>
                        </div>
                          
                        <div class="invoice-process-note"></div>
                        <div class="invoice-process-payment"></div>
                    </div>

                </div>
                <div class="invoice-footer">
                    <div class="invoice-submit">
                        
                        <input type="checkbox" id="invoice-submit-checkbox" required />
                        <label class="invoice-submit-title"for="invoice-submit-checkbox">Tôi đã đọc và kiểm tra trước khi thanh toán.</label>
                        <br>
                        <button id="submit-invoice" type="submit">Xác nhận thanh toán</button>
                    </div>
                </div>
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


   

    <script src="../../JS/user/invoice.js"></script>
    <script src="../../JS/user/payment.js"></script>
    <script src="../../JS/user/clear.js"></script>
    <script src="../../JS/user/slideShow.js"></script>
    <script src="../../JS/user/blocklogin.js"></script>
    <script src="../../JS/user/blockCart.js"></script>
    <script defer src="../../JS/user/pagination.js"></script>
    <script defer src="../../JS/user/paginationOfMainPD.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../JS/user/userAjax.js"></script>
    <script src="../../JS/user/payment.js"></script>
    <script src="../../JS/user/blockInfo.js"></script>
</body>

</html>