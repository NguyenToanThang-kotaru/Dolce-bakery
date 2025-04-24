<?php
session_start();
if (!isset($_SESSION['adminInfo'])) {
  header("Location: login_admin.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bakery admin</title>
  <link rel="stylesheet" href="../../CSS/admin/admin.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../../CSS/user/notificationRegist.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>


  <div class="sidebar">
    <h2 id="admin">Admin</h2>
    <div id="ad-menu">
      <a href="#" id="admin-statistic">Thống kê</a>
      <a href="#" id="admin-oder">Đơn hàng</a>
      <a href="#" id="admin-product">Sản phẩm</a>
      <a href="#" id="admin-customer">Khách hàng</a>
      <a href="#" id="admin-employee">Nhân viên</a>
      <a href="#" id="admin-account">Quản lí tài khoản</a>
      <a href="#" id="admin-role">Quản lí quyền</a>
      <a href="#" id="admin-import">Nhập hàng</a>
    </div>

    <img src="../../assest/Dolce.png" alt="hahaha" />
  </div>

  <div class="admin-main">
    <div class="admin-header">
      <div class="profile">
        <span><?php echo $_SESSION['adminInfo']['fullName']; ?></span>
        <img src="../../assest/admin.jpg" alt="" id="profile" />
      </div>
    </div>
    <div class="business-process">
      <div class="card">
        <h3>Số đơn hàng</h3>
        <p>0</p>
      </div>
      <div class="card">
        <h3>Doanh thu</h3>
        <p>0</p>
      </div>
      <div class="card">
        <h3>Tỷ lệ tăng trưởng</h3>
        <p>0</p>
      </div>
    </div>
  </div>

  <div class="profile-part">
    <div class="profile-container">
      <div class="profile-header">
        <img src="../../assest/admin.jpg" alt="" class="avatar" />
        <div class="user-info">
          <h2><?php echo $_SESSION['adminInfo']['fullName']; ?></h2>
        </div>
      </div>
      <ul class="menu-profile">
        <li><a href="#">Thông tin cá nhân</a></li>
        <li>
          <a href="#">Quyền hạn: <span>...</span></a>
        </li>
        <li><a href="#">Lịch sử hoạt động</a></li>
        <li><a href="#">Quản lý quyền</a></li>
      </ul>
      <button class="logout-btn-admin">Đăng xuất</button>
    </div>
  </div>

  <div class="statistic-part">
    <div class="statistic-table-container">
      <form id="filter-form-statistic" style="margin-bottom: 10px; display: flex; gap: 5px;">

        <div class="form-group">
          <label for="fromDate">Số lượng khách hàng:</label><br>
          <input type="number" id="customer-number" name="customer-number" class="form-input"
            placeholder="Nhập số lượng" min="1">
        </div>

        <div class="form-group">
          <label for="fromDate">Từ ngày:</label><br>
          <input type="date" id="statistic-start-date" name="start_date" class="form-input">
        </div>

        <div class="form-group">
          <label for="toDate">Đến ngày:</label><br>
          <input type="date" id="statistic-end-date" name="end_date" class="form-input">
        </div>

        <div class="form-group">
          <label for="sort">Sắp xếp:</label><br>
          <select id="statistic-sort" name="statistic-sort" class="form-select" require>
            <option value="1">Tăng dần</option>
            <option value="2">Giảm dần</option>
          </select>
        </div>

        <div class="form-group">
          <label></label><br>
          <button type="submit" class="form-button">Thống kê</button>
        </div>
      </form>
      <h3 style="text-align:center; display: none" class="statistic-title"></h3>
      <table class="statistic-table">
        <thead>
          <tr>
            <th>STT</th>
            <th>Mã khách hàng</th>
            <th>Tên khách hàng</th>
            <th>Tổng tiền mua</th>
            <th>Các đơn hàng</th>
          </tr>
        </thead>
        <tbody>
          <?php include '../../PHP/ST-Manager.php' ?>
        </tbody>
      </table>
      <div class="order-detail-container1" style="display: none;"></div>


    </div>
  </div>

  <div class="order-part">
    <div class="order-table-container">
      <form id="filter-form-order" style="margin-bottom: 10px; display: flex; gap: 5px;">
        <div class="form-group">
          <label for="filter-status">Trạng thái:</label>
          <?php include '../../PHP/OD-get_status.php' ?>
        </div>

        <div class="form-group">
          <label for="province">Tỉnh/Thành phố:</label><br>
          <select name="order-province" class="form-select" id="order-province">;
            <option value="">Chọn tỉnh/thành phố</option>";
            <?php include '../../PHP/OD-get_province.php' ?>
        </div>

        <div class="form-group">
          <label for="district">Huyện/Quận:</label><br>
          <select id="order-district" name="order-district" class="form-select">
            <option value="">Chọn huyện/quận</option>
          </select>
        </div>

        <div class="form-group">
          <label for="fromDate">Từ ngày:</label><br>
          <input type="date" id="order-start-date" name="start_date" class="form-input">
        </div>

        <div class="form-group">
          <label for="toDate">Đến ngày:</label><br>
          <input type="date" id="order-end-date" name="end_date" class="form-input">
        </div>

        <div class="form-group">
          <label></label><br>
          <button type="submit" class="form-button"><img src="../../assest/Filter.png" style="height: 17px;">
            Lọc</button>
        </div>
      </form>

      <table class="order-table">
        <thead>
          <tr>
            <th>STT</th>
            <th>Mã đơn hàng</th>
            <th>Mã khách hàng</th>
            <th>Tên khách hàng</th>
            <th>Tổng tiền</th>
            <th>Ngày đặt</th>
            <th>Xem chi tiết</th>
            <th>Trạng thái</th>
          </tr>
        </thead>
        <tbody>
          <?php include '../../PHP/OD-Manager.php' ?>
        </tbody>
      </table>
      <div class="order-detail-container" style="display: none; margin-top: 20px;"></div>
    </div>
  </div>
  <!-- ----------------------------PRODUCT----------------------------- -->
  <div class="product-part">
    <div class="product-table-container">
      <div id="product-plus">Thêm sản phẩm</div>
      <table class="product-table">
        <thead>
          <tr>
            <th style="text-align: center">Hình ảnh sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Thể loại</th>
            <th>Phân loại</th>
            <th>Số lượng</th>
            <th>Giá tiền</th>
            <th id="setting-pro">Cài đặt</th>
          </tr>
        </thead>
        <tbody id="product-table-body">
          <?php include '../../PHP/PD-Manager.php'; ?>
        </tbody>
      </table>

      <form class="add-form-product" action="../../PHP/PD-Add.php" method="POST" enctype="multipart/form-data">
        <i class="fa-solid fa-rotate-left back-product"></i>
        <div class="form-group">
          <label for="product-image" class="form-label">Ảnh sản phẩm</label>
          <input type="file" id="product-image" name="product-image" class="form-input" />
        </div>

        <div class="form-group">
          <label for="product-name" class="form-label">Tên sản phẩm</label>
          <input type="text" id="product-name" name="product-name" placeholder="Nhập tên sản phẩm" class="form-input" />
        </div>

        <div class="form-group">
          <label for="category" class="form-label">Thể loại sản phẩm</label>
          <?php
          $selectId = "product-category";
          $selectName = "product-category";
          include '../../PHP/PD-getCategory.php';
          ?>
        </div>

        <div class="form-group">
          <label for="subcategory" class="form-label">Phân loại sản phẩm</label>
          <select name="product-subcategory" id="product-subcategory" class="form-select" required>
            <option value="">-- Chọn phân loại sản phẩm --</option>
          </select>
        </div>

        <div class="form-group">
          <label for="product-quantity" class="form-label">Số Lượng</label>
          <input type="number" id="product-quantity" name="product-quantity" placeholder="Nhập số lượng"
            class="form-input" />
        </div>

        <div class="form-group">
          <label for="product-price" class="form-label">Giá Tiền (VNĐ)</label>
          <input type="number" id="product-price" name="product-price" placeholder="Nhập giá tiền" class="form-input" />
        </div>

        <div class="form-group text-center">
          <button type="submit" class="form-button" id="accept-addPD">Thêm Sản Phẩm</button>
        </div>
      </form>

      <form class="fix-form-product" id="update-form-product" enctype="multipart/form-data">
        <input type="hidden" id="product-id" name="product-id">
        <i class="fa-solid fa-rotate-left back-product"></i>
        <div class="form-group">
          <label for="product-image" class="form-label">*Ảnh sản phẩm</label>
          <img id="preview-image" src="" alt="Ảnh sản phẩm" style="width: 150px; height: auto; margin-bottom: 10px;">
          <input type="file" id="product-image" onchange="uploadImg(this)" name="product-image" class="form-input"
            accept="image/*" />
        </div>

        <div class="form-group">
          <label for="product-name" class="form-label">*Tên sản phẩm</label>
          <input type="text" id="product-nameFIX" name="product-name" placeholder="Nhập tên sản phẩm"
            class="form-input" />
        </div>

        <div class="form-group">
          <label for="category" class="form-label">*Thể loại sản phẩm</label>
          <select name="product-category" id="product-categoryFIX" class="form-select" required>
            <?php
            include 'config.php';
            $sql = "SELECT id, name FROM categories";
            $result = $conn->query($sql);
            echo "  <option value=''>-- Chọn thể loại sản phẩm --</option>";
            if ($result && $result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['name']}</option>";
              }
            } else {
              echo "<option value=''>Không có thể loại nào!</option>";
            }
            ?>
          </select>
        </div>

        <div class="form-group">
          <label for="subcategory" class="form-label">*Phân loại sản phẩm</label>
          <select name="product-subcategory" id="product-subcategoryFIX" class="form-select" required>
            <?php
            include 'config.php';
            $sql = "SELECT id, name FROM subcategories";
            $result = $conn->query($sql);
            echo "  <option value=''>-- Chọn phân loại loại sản phẩm --</option>";
            if ($result && $result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['name']}</option>";
              }
            } else {
              echo "<option value=''>Không có phân loại loại nào!</option>";
            }
            ?>
          </select>
        </div>

        <div class="form-group">
          <label for="product-quantity" class="form-label">*Số Lượng</label>
          <input type="number" id="product-quantityFIX" name="product-quantity" placeholder="Nhập số lượng"
            class="form-input" />
        </div>

        <div class="form-group">
          <label for="product-price" class="form-label">*Giá Tiền (VNĐ)</label>
          <input type="number" id="product-priceFIX" name="product-price" placeholder="Nhập giá tiền"
            class="form-input" />
        </div>

        <div class="form-group text-center">
          <button type="submit" id="accept-fixPD" class="form-button">Hoàn tất</button>
        </div>
      </form>

    </div>
  </div>

  <div class="customer-part">
    <div class="customer-table-container">
      <!-- <div id="customer-plus">Thêm khách hàng</div> -->
      <table class="customer-table">
        <thead>
          <tr>
            <th>Mã KH</th>
            <th>Tên KH</th>
            <th>Trạng thái tài khoản</th>
            <th>Chi tiết tài khoản</th>
            <th>Lịch sử đơn hàng</th>
            <!-- <th>Email</th>
            <th>Địa chỉ</th> -->
            <th id="setting-cus">Cài đặt</th>
          </tr>
        </thead>
        <tbody id="customer-table-body">
          <?php include '../../PHP/CU-Manager.php' ?>
        </tbody>
      </table>

      <div class="history-order-container">
        <i class="fa-solid fa-rotate-left back-customer2"></i>
        <!--<div id="cus-identity">
          <span>Khách hàng:</span>
          <h4>Nguyễn Toàn Thắng</h4>
        </div>
        <h3 style="color: #3C8DBC; text-align: center;">Đơn hàng đã mua</h3>
        <div class="history-order-wrapper">
          <div id="order-id">Đơn hàng 1</div>
          <table class="history-order-table">
            <thead>
              <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
              </tr>
            </thead>
            <tbody id="history-order-table-body"> -->
        <!-- Dữ liệu đơn hàng sẽ được thêm ở đây -->
        <!-- Dữ liệu tạm -->
        <!-- <tr>
                  <td>Bánh thần tài</td>
                  <td>3</td>
                  <td>303030</td>
              </tr>
            </tbody>
          </table>
          <div class="order-summary">
            <p><strong>Tổng tiền:</strong> <span id="total-amount">0đ</span></p>
            <p><strong>Trạng thái đơn hàng:</strong> <span id="order-status">Chưa xác định</span></p>
          </div>
        </div>

        <div class="history-order-wrapper">
          <div id="order-id">Đơn hàng 1</div>
          <table class="history-order-table">
            <thead>
              <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
              </tr>
            </thead>
            <tbody id="history-order-table-body"> -->
        <!-- Dữ liệu đơn hàng sẽ được thêm ở đây -->
        <!-- Dữ liệu tạm -->
        <!-- <tr>
                  <td>Bánh thần tài</td>
                  <td>3</td>
                  <td>303030</td>
              </tr>
            </tbody>
          </table>
          <div class="order-summary">
            <p><strong>Tổng tiền:</strong> <span id="total-amount">0đ</span></p>
            <p><strong>Trạng thái đơn hàng:</strong> <span id="order-status">Chưa xác định</span></p>
          </div>
        </div> -->
      </div>





      <!-- <form class="add-form-customer">
        <i class="fa-solid fa-rotate-left back-customer"></i>

        <div class="form-group">
          <label for="product-id" class="form-label">Mã khách hàng</label>
          <input type="text" id="customer-id" name="customer-id" placeholder="Nhập mã KH" class="form-input" />
        </div>

        <div class="form-group">
          <label for="customer-name" class="form-label">Tên khách hàng</label>
          <input type="text" id="customer-name" name="customer-name" placeholder="Nhập tên khách hàng"
            class="form-input" />
        </div>

        <div class="form-group">
          <label for="product-phone" class="form-label">Số điện thoại</label>
          <input type="text" id="customer-phone" name="customer-phone" placeholder="Nhập SĐT khách hàng"
            class="form-input" />
        </div>

        <div class="form-group">
          <label for="customer-email" class="form-label">Email</label>
          <input type="email" id="customer-email" name="customer-email" placeholder="Nhập email" class="form-input" />
        </div>

        <div class="form-group">
          <label for="customer-address" class="form-label">Địa chỉ</label>
          <input type="text" id="custommer-address" name="customer-address" placeholder="Nhập địa chỉ"
            class="form-input" />
        </div>

        <div class="form-group text-center">
          <button type="submit" class="form-button">Thêm Khách Hàng</button>
        </div>
      </form> -->


      <form class="fix-form-customer" id="fix-form-customer" enctype="multipart/form-data">
        <i class="fa-solid fa-rotate-left back-customer"></i>

        <div class="form-group">
          <label for="customer-id" class="form-label">Mã khách hàng</label>
          <input type="text" id="customer-id" name="customer-id" placeholder="Nhập mã KH" class="form-input" />
        </div>

        <div class="form-group">
          <label for="customer-uname" class="form-label">Tên đăng nhập</label>
          <input type="text" id="customer-uname-f" name="customer-uname" placeholder="Nhập tên đăng nhập"
            class="form-input" />
        </div>

        <div class="form-group">
          <label for="customer-pass" class="form-label">Password</label>
          <input type="text" id="customer-pass-f" name="customer-pass" placeholder="Nhập mật khẩu" class="form-input" />
        </div>

        <div class="form-group">
          <label for="customer-name" class="form-label">Tên khách hàng</label>
          <input type="text" id="customer-name-f" name="customer-name" placeholder="Nhập tên khách hàng"
            class="form-input" />
        </div>

        <div class="form-group">
          <label for="customer-phone" class="form-label">Số điện thoại</label>
          <input type="text" id="customer-phone-f" name="customer-phone" placeholder="Nhập SĐT khách hàng"
            class="form-input" />
        </div>

        <div class="form-group">
          <label for="customer-email" class="form-label">Email</label>
          <input type="email" id="customer-email-f" name="customer-email" placeholder="Nhập email" class="form-input" />
        </div>

        <!-- <div class="form-group">
          <label for="customer-address" class="form-label">Địa chỉ</label>
          <input type="text" id="customer-address-f" name="customer-address" placeholder="Nhập địa chỉ"
            class="form-input" />
        </div> -->

        <div class="form-group text-center">
          <button type="submit" class="form-button">Hoàn tất</button>
        </div>
      </form>

    </div>
  </div>

  <div class="account-part">
    <div class="account-table-container">
      <div id="account-plus">Thêm tài khoản</div>
      <table class="account-table">
        <thead>
          <tr>
            <th style="text-align: center">Tên đăng nhập</th>
            <!-- <th>Mật khẩu</th> -->
            <th>Tên nhân viên</th>
            <th>Trạng thái</th>
            <th>Quyền</th>
            <th id="setting-ac">Cài đặt</th>
          </tr>
        </thead>
        <tbody id="account-table-body">

          <?php
          include '../../PHP/AC-Manager.php';
          ?>
        </tbody>
      </table>

      <div id="role-popup">
        <div>Chức năng 1</div>
        <div>Chức năng 2</div>
        <div>Chức năng 3</div>
        <div class="popup-arrow">
        </div>
      </div>






      <form class="add-form-account" action="../../PHP/AC-Add.php" method="POST" enctype="multipart/form-data">
        <i class="fa-solid fa-rotate-left back-account"></i>
        <div class="form-group">
          <label for="account-name" class="form-label">Tên đăng nhập</label>
          <input type="text" id="account-name" name="account-name" placeholder="Nhập tên" class="form-input" required />
        </div>

        <div class="form-group">
          <label for="account-pass" class="form-label">Mật khẩu</label>
          <input type="password" id="account-pass" name="account-pass" placeholder="Nhập mật khẩu" class="form-input"
            required />
        </div>

        <div class="form-group">
          <label for="account-role" class="form-label" style="color: red;">Cấp quyền</label>
          <div class="role-container">
            <?php
            require_once '../../PHP/AC-Manager.php'; // Kết nối database
            // Lấy danh sách quyền từ bảng permissions
            $sql = "SELECT id, name FROM permissions ORDER BY id ASC";
            $result = $conn->query($sql);

            echo "<select name='permission_id' class='permission-select' id='permissionSelect' required>";
            echo "<option value=''>Chọn quyền</option>"; // Chọn giá trị mặc định
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['name']}</option>";
              }
            } else {
              echo "<option value=''>Không có quyền nào!</option>"; // Nếu không có dữ liệu
            }
            echo "</select>";
            ?>
          </div>
        </div>

        <div class="form-group text-center">
          <button type="submit" class="form-button">Thêm tài khoản</button>
        </div>
      </form>


      <form class="fix-form-account" id="fix-form-account" action="../../PHP/AC-Edit.php" method="POST"
        enctype="multipart/form-data">
        <input type="hidden" id="account-id" name="account-id">
        <i class="fa-solid fa-rotate-left back-account"></i>
        <div class="form-group">
          <label for="account-name" class="form-label">Tên đăng nhập</label>
          <input type="text" id="account-name-f" name="account-name" placeholder="Nhập tên" class="form-input" />
        </div>

        <div class="form-group">
          <label for="account-pass" class="form-label">Mật khẩu</label>
          <input type="text" id="account-pass-f" name="account-pass" placeholder="Nhập mật khẩu" class="form-input" />
        </div>

        <div class="form-group">
          <label for="account-role" class="form-label" style="color: red;">Cập nhật quyền</label>
          <div class=role-container>
            <?php
            require_once '../../PHP/AC-Manager.php'; // Kết nối database
            
            // Lấy danh sách quyền từ bảng permissions
            $sql = "SELECT id, name FROM permissions ORDER BY id ASC";
            $result = $conn->query($sql);

            echo "<select name='permission_id' class='permission-select' id='permissionSelect-f' required>";
            echo "<option value=''>Chọn quyền</option>";
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['name']}</option>";
              }
            } else {
              echo "<option value=''>Không có quyền nào!</option>";
            }
            echo "</select>";
            ?>
          </div>
        </div>

        <div class="form-group text-center">
          <button type="submit" class="form-button">Hoàn tất</button>
        </div>
      </form>



    </div>
  </div>

  <!-- ROLEEEEEEEEEEEEEEEEEEEEEEEEEEE -->

  <div class="role-part">
    <div class="role-table-container">
      <!-- <div id="account-overlay-role">
        <div class="account-role-container">
          <img src="../../assest/Chevron down.png" alt="">
          <div class="list-user-role">
            <div class="user-role">user1</div>
            <div class="user-role">user2</div>
            <div class="user-role">user4</div>
            <div class="user-role">user5</div>
            <div class="user-role">user6</div>
            <div class="user-role">user7</div>
            <div class="user-role">user8</div>
            <div class="user-role">user9</div>
            <div class="user-role">usera</div>
            <div class="user-role">userb</div>
            <div class="user-role">userc</div>
            <div class="user-role">userd</div>
            <div class="user-role">usere</div>
            <div class="user-role">userf</div>
            <div class="user-role">userg</div>
            <div class="user-role">userh</div>
            <div class="user-role">userj</div>
          </div>
        </div> -->
      <!-- </div> -->

      <div id="role-plus">Thêm quyền</div>

      <table class="role-table">
        <thead>
          <tr>
            <th style="text-align: center">Quyền</th>
            <th>Chức năng</th>
            <th>Số lượng TK</th>
            <th>Danh sách tài khoản</th>
            <th id="setting-pm">Cài đặt</th>
          </tr>
        </thead>
        <tbody id="role-table-body">
          <?php
          include '../../PHP/PM-Manager.php';
          ?>
        </tbody>
      </table>



      <form class="add-form-role" id="add-form-role" action="../../PHP/PM-Add.php" method="POST"
        enctype="multipart/form-data">
        <i class="fa-solid fa-rotate-left back-role"></i>
        <div class="form-group">
          <label for="role-name" class="form-label">Tên quyền</label>
          <input type="text" id="role-name" name="role-name" placeholder="Nhập tên" class="form-input" required />
        </div>

        <!-- Danh sách chức năng -->
        <div class="form-group">
          <label class="form-label" style="color: red;">Chức năng</label>
          <div class="role-container">

            <!-- Tiêu đề cột -->
            <div class="role-header">
              <div class="role-item">Tên chức năng</div>
              <div class="permission">Xem</div>
              <div class="permission">Thêm</div>
              <div class="permission">Sửa</div>
              <div class="permission">Xóa</div>
            </div>

            <!-- Dòng phân quyền dữ liệu ảo-->

            <div class="role-row">
              <div class="role-item">Quản lý quyền</div>
              <div class="permission"><input type="checkbox"></div>
              <div class="permission"><input type="checkbox"></div>
              <div class="permission"><input type="checkbox"></div>
              <div class="permission"><input type="checkbox"></div>
            </div>

            <div class="role-row">
              <div class="role-item">Quản lý sản phẩm</div>
              <div class="permission"><input type="checkbox"></div>
              <div class="permission"><input type="checkbox"></div>
              <div class="permission"><input type="checkbox"></div>
              <div class="permission"><input type="checkbox"></div>
            </div>

            <div class="role-row">
              <div class="role-item">Quản lý đơn hàng</div>
              <div class="permission"><input type="checkbox"></div>
              <div class="permission"><input type="checkbox"></div>
              <div class="permission"><input type="checkbox"></div>
              <div class="permission"><input type="checkbox"></div>
            </div>

            <div class="role-row">
              <div class="role-item">Quản lý khách hàng</div>
              <div class="permission"><input type="checkbox"></div>
              <div class="permission"><input type="checkbox"></div>
              <div class="permission"><input type="checkbox"></div>
              <div class="permission"><input type="checkbox"></div>
            </div>

            <div class="role-row">
              <div class="role-item">Quản lý đơn hàng</div>
              <div class="permission"><input type="checkbox"></div>
              <div class="permission"><input type="checkbox"></div>
              <div class="permission"><input type="checkbox"></div>
              <div class="permission"><input type="checkbox"></div>
            </div>

            <div class="role-row">
              <div class="role-item">Quản lý tài khoản</div>
              <div class="permission"><input type="checkbox"></div>
              <div class="permission"><input type="checkbox"></div>
              <div class="permission"><input type="checkbox"></div>
              <div class="permission"><input type="checkbox"></div>
            </div>
          </div>
        </div>


        <!-- Nút thêm quyền -->
        <div class="form-group text-center">
          <button type="submit" class="form-button">Thêm quyền</button>
        </div>
      </form>




      <form id="fix-form-role" class="fix-form-role" action="../../PHP/PM-Edit.php" method="POST"
        enctype="multipart/form-data">
        <input type="hidden" id="role-id-f" name="role-id">
        <i class="fa-solid fa-rotate-left back-role"></i>
        <div class="form-group">
          <label for="role-name" class="form-label">Tên quyền</label>
          <input type="text" id="role-name-f" name="role-name" placeholder="Nhập tên" class="form-input" />
        </div>
        <div class="form-group">
          <label for="account-role" class="form-label" style="color: red;">Chức năng</label>
          <div class="role-container">
            <?php
            require_once '../../PHP/PM-Manager.php'; // Kết nối database
            // Lấy chức năng từ database
            $sql = "SELECT id, name FROM functions ORDER BY id ASC";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "
                    <div class='check-role'>
                        <input type='checkbox' class='permission-checkbox' value='{$row['id']}' name='permissions[]'>
                        <label>{$row['name']}</label>
                    </div>";
              }
            } else {
              echo "<p>Không có chức năng nào!</p>";
            }
            ?>
          </div>
        </div>
        <div class="form-group text-center">
          <button type="submit" class="form-button">Hoàn tất</button>
        </div>
      </form>

      <div id="delete-overlay-role">
        <div class="delete-container">
          <span>Bạn muốn xóa quyền này?</span>
          <button id="delete-acp-role">Xác nhận</button>
          <button id="cancel-role">Hủy</button>
        </div>
      </div>



    </div>
  </div>

  <!-- employee-part -->
  <div class="employee-part">
    <div class="employee-table-container">
      <div id="employee-plus">Thêm nhân viên</div>
      <table class="employee-table">
        <thead>
          <tr>
            <th>STT</th>
            <th>Mã nhân viên</th>
            <th>Họ tên</th>
            <th>Chức vụ</th>
            <th>Email</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th id="setting-emp">Cài đặt</th>
          </tr>
        </thead>
        <tbody id="employee-table-body">
          <?php include '../../PHP/EP-Manager.php' ?>
        </tbody>
      </table>

      <form class="add-form-employee" action="../../PHP/PD-Add.php" method="POST" enctype="multipart/form-data">
        <i class="fa-solid fa-rotate-left back-employee"></i>

        <div class="form-group">
          <label for="employee-name" class="form-label">Họ tên nhân viên</label>
          <input type="text" id="employee-name" name="employee-name" placeholder="Nhập tên nhân viên"
            class="form-input" />
        </div>

        <div class="form-group">
          <label for="employee-email" class="form-label">Email</label>
          <input type="text" id="employee-email" name="employee-email" placeholder="Nhập email" class="form-input" />
        </div>

        <div class="form-group">
          <label for="employee-phone" class="form-label">Số điện thoại</label>
          <input type="number" id="employee-phone" name="employee-phone" placeholder="Nhập số điện thoại"
            class="form-input" />
        </div>

        <div class="form-group">
          <label for="employee-address" class="form-label">Địa chỉ</label>
          <input type="text" id="employee-address" name="employee-address" placeholder="Nhập địa chỉ"
            class="form-input" />
        </div>

        <div class="form-group">
          <label for="employee-position" class="form-label" style="color: red;">Chức vụ</label>
          <div class="role-container">
            <?php
            require_once '../../PHP/EP-Manager.php';
            // Lấy danh sách chức vụ từ bảng positions
            $sql = "SELECT id, name FROM positions ORDER BY id ASC";
            $result = $conn->query($sql);

            echo "<select name='position_id' class='position_id-select' id='positionSelect' required>";
            echo "<option value=''>Chọn chức vụ</option>";
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['name']}</option>";
              }
            } else {
              echo "<option value=''>Không có chức vụ nào!</option>";
            }
            echo "</select>";
            ?>
          </div>
        </div>

        <div class="form-group text-center">
          <button type="submit" class="form-button" id="accept-addEP">Thêm Nhân Viên</button>
        </div>
      </form>

      <form class="fix-form-employee" id="fix-form-employee" enctype="multipart/form-data">
        <input type="hidden" id="employee-id" name="employee-id">
        <i class="fa-solid fa-rotate-left back-employee"></i>
        <div class="form-group">
          <label for="employee-name" class="form-label">Họ tên nhân viên</label>
          <input type="text" id="employee-nameFIX" name="employee-name" placeholder="Nhập tên nhân viên"
            class="form-input" />
        </div>

        <div class="form-group">
          <label for="employee-email" class="form-label">Email</label>
          <input type="text" id="employee-emailFIX" name="employee-email" placeholder="Nhập email" class="form-input" />
        </div>

        <div class="form-group">
          <label for="employee-address" class="form-label">Địa chỉ</label>
          <input type="text" id="employee-addressFIX" name="employee-address" placeholder="Nhập địa chỉ"
            class="form-input" />
        </div>

        <div class="form-group">
          <label for="employee-phone" class="form-label">Số điện thoại</label>
          <input type="number" id="employee-phoneFIX" name="employee-phone" placeholder="Nhập số điện thoại"
            class="form-input" />
        </div>

        <div class="form-group">
          <label for="employee-position" class="form-label" style="color: red;">Chức vụ</label>
          <div class="role-container">
            <?php
            require_once '../../PHP/EP-Manager.php';
            // Lấy danh sách chức vụ từ bảng positions
            $sql = "SELECT id, name FROM positions ORDER BY id ASC";
            $result = $conn->query($sql);

            echo "<select name='position_id' class='position_id-select' id='positionSelectFIX' required>";
            echo "<option value=''>Chọn chức vụ</option>";
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['name']}</option>";
              }
            } else {
              echo "<option value=''>Không có chức vụ nào!</option>";
            }
            echo "</select>";
            ?>
          </div>
        </div>

        <div class="form-group text-center">
          <button type="submit" id="accept-fixEP" class="form-button">Hoàn tất</button>
        </div>
      </form>
    </div>
  </div>


  <!--import-involces-part-->

  <div class="import-part">
    <div class="import-table-container">
      <div id="import-plus">Thêm phiếu nhập</div>
      <table class="import-table">
        <thead>
          <tr>
            <th>STT</th>
            <th>Mã phiếu nhập</th>
            <th>Mã nhân viên</th>
            <th>Ngày nhập</th>
            <th>Trạng thái</th>
            <th>Xem chi tiết</th>
            <th id="setting-ip">Xóa</th>
          </tr>
        </thead>
        <tbody id="import-table-body">
          <tr>
            <td>1</td>
            <td>IP001</td>
            <td>NV001</td>
            <td>25-2-2025</td>
            <td><select name='import-status' class='importstatus-select form-select' id='filter-status' required></select>
            </td>
            <td style='text-align: center; vertical-align: middle;'>
              <i class='fa-solid fa-circle-info import-detail' style='cursor:pointer;'></i>
            </td>
            <td>
              <div class="fix-import">
                <i class='fa-solid fa-pen-to-square fix-btn-import'></i>
                <i class='fa-solid fa-trash delete-btn-import' style='cursor:pointer'></i>
              </div>
            </td>
          </tr>
        </tbody>
      </table>

      <div class="import-receipt-container">
        <i class="fa-solid fa-rotate-left back-import"></i>
        <h2 class="receipt-title">Phiếu nhập hàng</h2>

        <!-- Tổng tiền -->
        <div class="total-section-ip">
          <label for="total-price-ip">Tổng tiền:</label>
          <span id="total-price-ip">0 VND</span>
        </div>

        <!-- Combobox Nhà cung cấp, Loại, Chủng loại -->
        <div class="filter-section-ip">
          <select id="supplier-ip" class="form-select">
            <option value="">Chọn nhà cung cấp</option>
          </select>
          <select id="category-ip" class="form-select">
            <option value="">Chọn loại</option>
          </select>
          <select id="subcategory-ip" class="form-select">
            <option value="">Chọn chủng loại</option>
          </select>
        </div>

        <!-- Bảng sản phẩm -->
        <div class="product-table-section-ip">
          <table class="import-table-show">
            <thead>
              <tr>
                <th>Tên SP</th>
                <th>Ảnh sản phẩm</th>
                <th>Thể loại</th>
                <th>Phân loại</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Bánh kem</td>
                <td>*</td>
                <td>Bánh ngọt</td>
                <td>Bánh sinh nhật</td>
              </tr>
              <tr>
                <td>Bánh kem</td>
                <td>*</td>
                <td>Bánh ngọt</td>
                <td>Bánh sinh nhật</td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Nhập số lượng, giá nhập, % lãi -->
        <div class="selected-product-input-ip">
          <label for="quantity">Số lượng:</label>
          <input type="number" id="quantity" class="form-input" placeholder="Nhập số lượng" />

          <label for="import-price">Giá nhập:</label>
          <input type="number" id="import-price" class="form-input" placeholder="Nhập giá nhập" />

          <label for="profit-percent">% Lãi:</label>
          <input type="number" id="profit-percent" class="form-input" placeholder="Nhập % lãi" />

          <button id="add-product-btn-ip" class="form-button">Thêm sản phẩm</button>
        </div>

        <!-- Bảng sản phẩm đã được thêm vào phiếu nhập -->
        <div class="imported-product-list-section">
          <h3>Sản phẩm trong phiếu nhập</h3>
          <table class="import-table">
            <thead>
              <tr>
                <th>Tên SP</th>
                <th>Số lượng</th>
                <th>Giá nhập</th>
                <th>% Lãi</th>
                <th>Thành tiền</th>
                <th>Xóa</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Bánh kem</td>
                <td>20</td>
                <td>400000</td>
                <td>30</td>
                <td>500000</td>
                <td style='text-align: center; vertical-align: middle;'>
                  <i class='fa-solid fa-trash' style='cursor:pointer'></i>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Nút thêm phiếu nhập -->
        <div class="submit-section-ip text-center">
          <button id="submit-import-btn" class="form-button">Thêm phiếu nhập</button>
        </div>
      </div>

      <div id="delete-overlay-import">
        <div class="delete-container">
          <span>Bạn muốn xóa phiếu nhập?</span>
          <button id="delete-acp-import">Xác nhận</button>
          <button id="cancel-import">Hủy</button>
        </div>
      </div>

      <div class="import-receipt-fix-container">
        <i class="fa-solid fa-rotate-left back-import"></i>
        <h2 class="receipt-title"> Sửa phiếu nhập hàng</h2>

        <!-- Tổng tiền -->
        <div class="total-section-ip">
          <label for="total-price-ip">Tổng tiền:</label>
          <span id="total-price-ip">0 VND</span>
        </div>

        <!-- Combobox Nhà cung cấp, Loại, Chủng loại -->
        <div class="filter-section-ip">
          <select id="supplier-ip" class="form-select">
            <option value="">Chọn nhà cung cấp</option>
          </select>
          <select id="category-ip" class="form-select">
            <option value="">Chọn loại</option>
          </select>
          <select id="subcategory-ip" class="form-select">
            <option value="">Chọn chủng loại</option>
          </select>
        </div>

        <!-- Bảng sản phẩm -->
        <div class="product-table-section-ip">
          <table class="import-table-show">
            <thead>
              <tr>
                <th>Tên SP</th>
                <th>Ảnh sản phẩm</th>
                <th>Thể loại</th>
                <th>Phân loại</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Bánh kem</td>
                <td>*</td>
                <td>Bánh ngọt</td>
                <td>Bánh sinh nhật</td>
              </tr>
              <tr>
                <td>Bánh kem</td>
                <td>*</td>
                <td>Bánh ngọt</td>
                <td>Bánh sinh nhật</td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Nhập số lượng, giá nhập, % lãi -->
        <div class="selected-product-input-ip">
          <label for="quantity">Số lượng:</label>
          <input type="number" id="quantity" class="form-input" placeholder="Nhập số lượng" />

          <label for="import-price">Giá nhập:</label>
          <input type="number" id="import-price" class="form-input" placeholder="Nhập giá nhập" />

          <label for="profit-percent">% Lãi:</label>
          <input type="number" id="profit-percent" class="form-input" placeholder="Nhập % lãi" />

          <button id="add-product-btn" class="form-button">Thêm sản phẩm</button>
        </div>

        <!-- Bảng sản phẩm đã được thêm vào phiếu nhập -->
        <div class="imported-product-list-section">
          <h3>Sản phẩm trong phiếu nhập</h3>
          <table class="import-table">
            <thead>
              <tr>
                <th>Tên SP</th>
                <th>Số lượng</th>
                <th>Giá nhập</th>
                <th>% Lãi</th>
                <th>Thành tiền</th>
                <th>Xóa</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Bánh kem</td>
                <td>20</td>
                <td>400000</td>
                <td>30</td>
                <td>500000</td>
                <td style='text-align: center; vertical-align: middle;'>
                  <i class='fa-solid fa-trash' style='cursor:pointer'></i>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Nút thêm phiếu nhập -->
        <div class="submit-section text-center">
          <button id="submit-import-btn" class="form-button">Hoàn tất</button>
        </div>
      </div>


      <div class="import-detail-container">
        <i class="fa-solid fa-rotate-left back-import"></i>
        <h3 style="margin-bottom: 10px;">Chi tiết phiếu nhập</h3>
        <div class="import-info">
          <div class="info-row-ip">
            <span><strong>Mã phiếu nhập:</strong> PN001</span>
            <span><strong>Mã nhân viên:</strong> NV123</span>
          </div>
          <div class="info-row-ip">
            <span><strong>Ngày nhập:</strong> 23/04/2025</span>
            <span><strong>Trạng thái:</strong> Đã duyệt</span>
          </div>
          <div class="info-row-ip">
            <span><strong>Tổng tiền:</strong> 5.000.000 VNĐ</span>
          </div>
        </div>

        <div class="imported-product-list-section">
          <h4>Sản phẩm trong phiếu nhập</h4>
          <table class="import-table">
            <thead>
              <tr>
                <th>Tên SP</th>
                <th>Số lượng</th>
                <th>Giá nhập</th>
                <th>% Lãi</th>
                <th>Thành tiền</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Bánh kem</td>
                <td>20</td>
                <td>400000</td>
                <td>30</td>
                <td>500000</td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>



  <script src="../../JS/admin/admin.js"></script>
  <!-- <script src="../../JS/PD-editAjax"></script> -->
  <script src="../../JS/admin/PD-Ajax.js"></script>
  <script src="../../JS/admin/PM-Ajax.js"></script>
  <script src="../../JS/admin/AC-Ajax.js"></script>
  <script src="../../JS/admin/CU-Ajax.js"></script>
  <script src="../../JS/admin/EP-Ajax.js"></script>
  <script src="../../JS/admin/Logout_admin.js"></script>
  <script src="../../JS/admin/PD-getCategory_ajax.js"></script>
  <script src="../../JS/admin/OD-ajax.js"></script>
  <script src="../../JS/admin/OD-getAddress_ajax.js"></script>
  <script src="../../JS/admin/ST-ajax.js"></script>


  <script>
    const adminFunctions = <?php echo json_encode($_SESSION['adminInfo']['function_ids']); ?>;
    console.log(adminFunctions);
    adminFunctions.forEach(funcId => {


    });


  </script>


</body>

</html>