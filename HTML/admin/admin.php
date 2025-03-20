<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bakery admin</title>
  <link rel="stylesheet" href="../../CSS/admin/admin.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <div class="sidebar">
    <h2 id="admin">Admin</h2>
    <a href="#">Thống kê</a>
    <a href="#" id="admin-oder">Đơn hàng</a>
    <a href="#" id="admin-product">Sản phẩm</a>
    <a href="#" id="admin-customer">Khách hàng</a>
    <a href="#" id="admin-account">Quản lí tài khoản</a>
    <a href="#" id="admin-role">Quản lí quyền</a>
    
    <img src="../../assest/Dolce.png" alt="hahaha" />
  </div>

  <div class="admin-main">
    <div class="admin-header">
      <div class="profile">
        <span>Admin 1</span>
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
          <h2>Admin 1</h2>
        </div>
      </div>
      <ul class="menu-profile">
        <li><a href="#">Thông tin cá nhân</a></li>
        <li>
          <a href="#">Quyền hạn: <span>Admin</span></a>
        </li>
        <li><a href="#">Lịch sử hoạt động</a></li>
        <li><a href="#">Quản lý quyền</a></li>
      </ul>
      <button class="logout-btn-admin">Đăng xuất</button>
    </div>
  </div>

  <div class="oder-part">
    <div class="order-table-container">
      <table class="order-table">
        <thead>
          <tr>
            <th>Tên KH</th>
            <th>Mã KH</th>
            <th>Số lượng</th>
            <th>Tổng tiền</th>
            <th>Xem chi tiết</th>
            <th>Trạng thái</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Nguyễn</td>
            <td>01</td>
            <td>2</td>
            <td>500,000 VND</td>
            <td><i class="fa-solid fa-circle-info"></i></td>
            <td>Đã xử lý</td>
          </tr>
          <tr>
            <td>Mai</td>
            <td>02</td>
            <td>3</td>
            <td>150,000 VND</td>
            <td><i class="fa-solid fa-circle-info"></i></td>
            <td>Chưa xử lý</td>
          </tr>
        </tbody>
      </table>
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
            <th>Loại</th>
            <th>Số lượng</th>
            <th>Giá tiền</th>
            <th>Cài đặt</th>
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
          <label for="product-type" class="form-label">Loại sản phẩm</label>
          <select id="product-type" name="product-type" class="form-select">
            <option value="">-- Chọn loại sản phẩm --</option>
            <option value="cake">Bánh kem</option>
            <option value="bread">Bánh mì</option>
            <option value="cookie">Cookies</option>
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
          <img id="preview-image" src="" alt="Ảnh sản phẩm" style="width: 150px; height: auto; display: block; margin-bottom: 10px;">
          <input type="file" id="product-image" name="product-image" class="form-input" />
        </div>

        <div class="form-group">
          <label for="product-name" class="form-label">*Tên sản phẩm</label>
          <input type="text" id="product-nameFIX" name="product-name" placeholder="Nhập tên sản phẩm" class="form-input" />
        </div>

        <div class="form-group">
          <label for="product-type" class="form-label">*Loại sản phẩm</label>
          <select id="product-typeFIX" name="product-type" class="form-select">
            <option value="">-- Chọn loại sản phẩm --</option>
            <option value="cake">Bánh kem</option>
            <option value="bread">Bánh mì</option>
            <option value="cookie">Cookies</option>
          </select>
        </div>

        <div class="form-group">
          <label for="product-quantity" class="form-label">*Số Lượng</label>
          <input type="number" id="product-quantityFIX" name="product-quantity" placeholder="Nhập số lượng"
            class="form-input" />
        </div>

        <div class="form-group">
          <label for="product-price" class="form-label">*Giá Tiền (VNĐ)</label>
          <input type="number" id="product-priceFIX" name="product-price" placeholder="Nhập giá tiền" class="form-input" />
        </div>

        <div class="form-group text-center">
          <button type="submit" id="accept-fixPD" class = "form-button">Hoàn tất</button>
        </div>
      </form>
      
    </div>
  </div>

  <div class="customer-part">
    <div class="customer-table-container">
      <div id="customer-plus">Thêm khách hàng</div>
      <table class="customer-table">
        <thead>
          <tr>
            <th>Mã KH</th>
            <th>Tên KH</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Địa chỉ</th>
            <th>Trạng thái tài khoản</th>
            <th>Cài đặt</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>01</td>
            <td>Nguyễn</td>
            <td>000000</td>
            <td>Nguyễn@gmail.com</td>
            <td>Q1</td>
            <td>Đang hoạt động</td>
            <td>
              <div class="fix-customer">
                <i class="fa-solid fa-pen-to-square fix-btn-customer"></i>
                <i class="fa-solid fa-trash delete-btn-customer"></i>
              </div>
            </td>
          </tr>
          <tr>
            <td>02</td>
            <td>Mai</td>
            <td>002000</td>
            <td>Mai@gmail.com</td>
            <td>Q5</td>
            <td>Đang hoạt động</td>
            <td>
              <div class="fix-customer">
                <i class="fa-solid fa-pen-to-square fix-btn-customer"></i>
                <i class="fa-solid fa-trash delete-btn-customer"></i>
              </div>
            </td>
          </tr>
        </tbody>
      </table>

      <form class="add-form-customer">
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
      </form>

      <form class="fix-form-customer">
        <i class="fa-solid fa-rotate-left back-customer"></i>

        <div class="form-group">
          <label for="customer-id" class="form-label">Mã khách hàng</label>
          <input type="text" id="customer-id" name="customer-id" placeholder="Nhập mã KH" class="form-input" />
        </div>

        <div class="form-group">
          <label for="customer-name" class="form-label">Tên khách hàng</label>
          <input type="text" id="customer-name" name="customer-name" placeholder="Nhập tên khách hàng"
            class="form-input" />
        </div>

        <div class="form-group">
          <label for="customer-phone" class="form-label">Số điện thoại</label>
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
          <button type="submit" class="form-button">Hoàn tất</button>
        </div>
      </form>
      <div id="delete-overlay-customer">
        <div class="delete-container">
          <span>Bạn muốn xóa khách hàng?</span>
          <button id="delete-acp-customer">Xác nhận</button>
          <button id="cancel-customer">Hủy</button>
        </div>
      </div>
    </div>
  </div>

  <div class="account-part">
    <div class="account-table-container">
     <div id="account-plus">Thêm tài khoản</div>
      <table class="account-table">
        <thead>
          <tr>
            <th style="text-align: center">Tên đăng nhập</th>
            <th>Mật khẩu</th>
            <th>Email</th>
            <th>Trạng thái</th>
            <th>Quyền</th>
            <th>Cài đặt</th>
          </tr>
        </thead>
        <tbody>
          
          <?php
            include '../../PHP/AC-Manager.php';
           ?>
        </tbody>
      </table>

      
      

     

     

      <form class="add-form-account" action="../../PHP/AC-Add.php" method="POST" enctype="multipart/form-data">
        <i class="fa-solid fa-rotate-left back-account"></i>
        <div class="form-group">
          <label for="account-name" class="form-label">Tên đăng nhập</label>
          <input type="text" id="account-name" name="account-name" placeholder="Nhập tên" class="form-input" />
        </div>

        <div class="form-group">
          <label for="account-pass" class="form-label">Mật khẩu</label>
          <input type="text" id="account-pass" name="account-pass" placeholder="Nhập mật khẩu" class="form-input" />
        </div>

        <div class="form-group">
          <label for="account-email" class="form-label">Email</label>
          <input type="text" id="account-email" name="account-email" placeholder="Nhập email" class="form-input" />
        </div>

        
       
      <div class="form-group">
          <label for="account-role" class="form-label" style="color: red;">Cấp quyền</label>
        <div class="role-container">
        <select name="permissions[]" class="permission-select" data-user="<?= $userId ?>">
          <option value="1">Quyền A</option>
          <option value="2">Quyền B</option>
          <option value="3">Quyền C</option>
          <option value="4">Quyền D</option>
          <option value="5">None</option>
        </select>

        </div>
      </div>
        <div class="form-group text-center">
          <button type="submit" class="form-button">Thêm tài khoản</button>
        </div>
      </form> 

      <form class="fix-form-account" action="../../PHP/AC-Edit.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" id="account-id" name="account-id">
        <i class="fa-solid fa-rotate-left back-account"></i>
        <div class="form-group">
          <label for="account-name" class="form-label">Tên đăng nhập</label>
          <input type="text" id="account-name" name="account-name" placeholder="Nhập tên" class="form-input" />
        </div>

        <div class="form-group">
          <label for="account-pass" class="form-label">Mật khẩu</label>
          <input type="text" id="account-pass" name="account-pass" placeholder="Nhập mật khẩu" class="form-input" />
        </div>

        <div class="form-group">
          <label for="account-email" class="form-label">Email</label>
          <input type="text" id="account-email" name="account-email" placeholder="Nhập email" class="form-input" />
        </div>

        <div class="form-group">
          <label for="account-role" class="form-label" style = "color: red;">Cập nhật quyền</label>
          <div class = role-container>
          <select name="permissions[]" class="permission-select" data-user="<?= $userId ?>">
          <option value="1">Quyền A</option>
          <option value="2">Quyền B</option>
          <option value="3">Quyền C</option>
          <option value="4">Quyền D</option>
          <option value="5">None</option>
        </select>
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
            <div class ="user-role">user4</div>
            <div class ="user-role">user5</div>
            <div class ="user-role">user6</div>
            <div class ="user-role">user7</div>
            <div class ="user-role">user8</div>
            <div class ="user-role">user9</div>
            <div class ="user-role">usera</div>
            <div class ="user-role">userb</div>
            <div class ="user-role">userc</div>
            <div class ="user-role">userd</div>
            <div class ="user-role">usere</div>
            <div class ="user-role">userf</div>
            <div class ="user-role">userg</div>
            <div class ="user-role">userh</div>
            <div class ="user-role">userj</div>
          </div>
        </div>
      </div> -->
      
     <div id="role-plus">Thêm quyền</div>

      <table class="role-table">
        <thead>
          <tr>
            <th style="text-align: center">Quyền</th>
            <th>Chức năng</th>
            <th>Số lượng TK</th>
            <th>Danh sách tài khoản</th>
            <th>Cài đặt</th>
          </tr>
        </thead>
        <tbody>
          <?php
            include '../../PHP/PM-Manager.php';
           ?>
        </tbody>
      </table>

      <!-- <form class="add-form-role" action="../../PHP/PM-Add.php" method="POST" enctype="multipart/form-data">
        <i class="fa-solid fa-rotate-left back-role"></i>
        <div class="form-group">
          <label for="role-name" class="form-label">Tên quyền</label>
          <input type="text" id="role-name" name="role-name" placeholder="Nhập tên" class="form-input" />
        </div>
        
      <div class="form-group">
          <label for="account-role" class="form-label" style="color: red;">Chức năng</label>
        <div class="role-container">
          <div class="check-role">
            <input type="checkbox" class="permission-checkbox" value="5" name="permissions[]" data-user="<?= $userId ?>" >
            <label>Quản lí sản phẩm</label>
          </div>
          <div class="check-role">
            <input type="checkbox" class="permission-checkbox" value="4" name="permissions[]" data-user="<?= $userId ?>" >
            <label>Quản lí khách hàng</label>
          </div>
          <div class="check-role">
            <input type="checkbox" class="permission-checkbox" value="3" name="permissions[]" data-user="<?= $userId ?>" >
            <label>Quản lí nhà cung cấp</label>
          </div>
          <div class="check-role">
            <input type="checkbox" class="permission-checkbox" value="2" name="permissions[]" data-user="<?= $userId ?>" >
            <label>Quản lí người dùng</label>
          </div>
        </div>
      </div>
        <div class="form-group text-center">
          <button type="submit" class="form-button">Thêm quyền</button>
        </div>
      </form>  -->

      <form class="add-form-role" action="../../PHP/PM-Add.php" method="POST" enctype="multipart/form-data">
    <i class="fa-solid fa-rotate-left back-role"></i>

    <!-- Nhập tên quyền -->
    <div class="form-group">
        <label for="role-name" class="form-label">Tên quyền</label>
        <input type="text" id="role-name" name="role-name" placeholder="Nhập tên" class="form-input" required />
    </div>

    <!-- Danh sách chức năng -->
    <div class="form-group">
        <label for="account-role" class="form-label" style="color: red;">Chức năng</label>
        <div class="role-container">
            <?php
            require_once '../../PHP/PM-Manager.php'; // Kết nối database

            // Lấy  chức năng từ database
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

    <!-- Nút thêm quyền -->
    <div class="form-group text-center">
        <button type="submit" class="form-button">Thêm quyền</button>
    </div>
</form>




      <form class="fix-form-role" action="../../PHP/PM-Edit.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" id="role-id" name="role-id">
        <i class="fa-solid fa-rotate-left back-role"></i>
        <div class="form-group">
          <label for="role-name" class="form-label">Tên quyền</label>
          <input type="text" id="role-name" name="role-name" placeholder="Nhập tên" class="form-input" />
        </div>

        <div class="form-group">
          <label for="account-role" class="form-label" style = "color: red;">Chức năng</label>
          <div class = role-container>
          <?php
            require_once '../../PHP/PM-Manager.php'; // Kết nối database

            // Lấy  chức năng từ database
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


  <script src="../../JS/admin/admin.js"></script>
  <!-- <script src="../../JS/PD-editAjax"></script> -->
  <script src="../../JS/admin/AC-changestatus.js"></script>
  <script src="../../JS/admin/PD-Ajax.js"></script>




</body>

</html>