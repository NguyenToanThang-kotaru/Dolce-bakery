<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chuyển Trang (Query Parameters)</title>
  <style>
    #filterForm {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        align-items: flex-end;
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        max-width: 100%;
    }

    #filterForm > div {
        display: flex;
        flex-direction: column;
        min-width: 180px;
        flex: 1 1 180px;
    }

    #filterForm label {
        font-weight: bold;
        margin-bottom: 5px;
        font-size: 14px;
    }

    #filterForm select,
    #filterForm input[type="date"] {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
        transition: border-color 0.2s ease-in-out;
    }

    #filterForm select:focus,
    #filterForm input[type="date"]:focus {
        border-color: #007bff;
        outline: none;
    }

    #filterForm button {
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        font-weight: bold;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.2s ease-in-out;
    }

    #filterForm button:hover {
        background-color: #0056b3;
    }

    /* Responsive for small screens */
    @media (max-width: 768px) {
        #filterForm {
            flex-direction: column;
            align-items: stretch;
        }

        #filterForm > div {
            width: 100%;
        }
    }
</style>



  </style>

  
</head>
<body>
  <form id="filterForm" method="GET" style="display: flex; flex-wrap: wrap; gap: 16px; align-items: flex-end;">
    <!-- Trạng thái -->
    <div>
        <label for="status">Trạng thái:</label><br>
        <select id="status" name="status">
            <option value="">Tất cả</option>
            <option value="pending">Chờ xử lý</option>
            <option value="approved">Đã duyệt</option>
            <option value="rejected">Từ chối</option>
        </select>
    </div>

    <!-- Tỉnh/Thành phố -->
    <div>
        <label for="province">Tỉnh/Thành phố:</label><br>
        <!-- <select id="province" name="province">
            <option value="">Chọn tỉnh/thành</option>
        </select> -->
        <?php include '../Dolce-bakery/getprovince.php'?>
    </div>

    <!-- Huyện/Quận -->
    <div>
        <label for="district">Huyện/Quận:</label><br>
        <select id="order-district" name="order-district">
            <option value="">Chọn quận/huyện</option>
        </select>
      
    </div>

    <div>
        <label for="fromDate">Từ ngày:</label><br>
        <input type="date" id="fromDate" name="fromDate">
    </div>

    <!-- Đến ngày -->
    <div>
        <label for="toDate">Đến ngày:</label><br>
        <input type="date" id="toDate" name="toDate">
    </div>

    <!-- Nút lọc -->
    <div>
        <button type="submit">Lọc</button>
    </div>
</form>


  <script src="getaddress.js"></script>
</body>
</html>
