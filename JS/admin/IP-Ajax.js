// Xử lý combobox nhập hàng
document.addEventListener('DOMContentLoaded', function() {
    const supplierSelect = document.getElementById('supplier-ip');
    const categorySelect = document.getElementById('category-ip');
    const subcategorySelect = document.getElementById('subcategory-ip');
    const productTableBody = document.querySelector('.import-table-show tbody');
    let totalAmount = 0;

    // Load danh sách nhà cung cấp khi trang load
    fetch('../../PHP/IP-getSuppliers.php')
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                data.suppliers.forEach(sup => {
                    supplierSelect.innerHTML += `<option value="${sup.id}">${sup.name}</option>`;
                });
            }
        });

    // Khi chọn nhà cung cấp
    supplierSelect.addEventListener('change', function() {
        const supplierId = this.value;
        categorySelect.innerHTML = '<option value="">Chọn loại</option>';
        subcategorySelect.innerHTML = '<option value="">Chọn chủng loại</option>';
        productTableBody.innerHTML = '';
        if (supplierId) {
            fetch(`../../PHP/IP-getCategoriesBySupplier.php?supplier_id=${supplierId}`)
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        data.categories.forEach(cat => {
                            categorySelect.innerHTML += `<option value="${cat.id}">${cat.name}</option>`;
                        });
                    }
                });
        }
    });

    // Khi chọn loại
    categorySelect.addEventListener('change', function() {
        const categoryId = this.value;
        const supplierId = supplierSelect.value;
        subcategorySelect.innerHTML = '<option value="">Chọn chủng loại</option>';
        productTableBody.innerHTML = '';
        if (categoryId && supplierId) {
            fetch(`../../PHP/IP-getSubcategoriesByCategory.php?category_id=${categoryId}&supplier_id=${supplierId}`)
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        data.subcategories.forEach(sub => {
                            subcategorySelect.innerHTML += `<option value="${sub.id}">${sub.name}</option>`;
                        });
                    }
                });
        }
    });

    // Khi chọn phân loại
    subcategorySelect.addEventListener('change', function() {
        const subcategoryId = this.value;
        const supplierId = supplierSelect.value;
        productTableBody.innerHTML = '';
        if (subcategoryId && supplierId) {
            fetch(`../../PHP/IP-getProductsBySubcategoryAndSupplier.php?subcategory_id=${subcategoryId}&supplier_id=${supplierId}`)
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        data.products.forEach(product => {
                            productTableBody.innerHTML += `
                                <tr data-product-id="${product.id}">
                                    <td>${product.pd_name}</td>
                                    <td><img src="${product.image}" alt="" style="max-width:60px;max-height:60px;"></td>
                                    <td>${categorySelect.options[categorySelect.selectedIndex].text}</td>
                                    <td>${subcategorySelect.options[subcategorySelect.selectedIndex].text}</td>
                                    <td style="display: none;">${product.price}</td>
                                </tr>
                            `;
                        });
                    }
                });
        }
    });

    // Xử lí chọn sản phẩm
    let selectedProduct = null;
    let selectedProductId = null;

    // Khi click vào row sản phẩm
    productTableBody.addEventListener('click', function(e) {
        let row = e.target.closest('tr');
        if (!row) return;
        // Lấy thông tin sản phẩm từ row
        const cells = row.children;
        selectedProduct = {
            name: cells[0].textContent,
            image: cells[1].querySelector('img').src,
            category: cells[2].textContent,
            subcategory: cells[3].textContent,
            price: parseFloat(cells[4].textContent)
        };
        // Lấy product_id 
        selectedProductId = row.getAttribute('data-product-id');
        // Đánh dấu row được chọn
        Array.from(productTableBody.children).forEach(r => r.classList.remove('selected'));
        row.classList.add('selected');
        // Reset các input
        document.getElementById('quantity').value = '';
        document.getElementById('import-price').value = '';
        document.getElementById('profit-percent').value = '';
    });

    const importPriceInput = document.getElementById('import-price');
    const profitPercent = document.getElementById('profit-percent');
    // Tính lãi khi nhập giá bán
    importPriceInput.addEventListener('blur', function() {
        const importPrice = parseFloat(importPriceInput.value);
        if (selectedProduct && !isNaN(importPrice) && importPrice > 0) {
            const percent = ((selectedProduct.price - importPrice) / importPrice) * 100;
            profitPercent.value = percent.toFixed(2);
        } else {
            profitPercent.value = '';
        }
    });

    // Khi click nút thêm sản phẩm
    document.getElementById('add-product-btn-ip').addEventListener('click', function(e) {
        e.preventDefault();
        if (!selectedProduct) {
            alert('Vui lòng chọn sản phẩm!');
            return;
        }
        const quantity = document.getElementById('quantity').value;
        const importPrice = document.getElementById('import-price').value;
        const profitPercent = document.getElementById('profit-percent').value;
        if (!quantity || !importPrice) {
            alert('Vui lòng nhập đủ số lượng và giá nhập!');
            return;
        }
        // Tính thành tiền
        const total = (parseFloat(importPrice) * parseInt(quantity)).toFixed(0);
        totalAmount = totalAmount + parseFloat(total);

        // Thêm vào bảng sản phẩm trong phiếu nhập
        const importListBody = document.querySelector('.imported-product-list-section tbody');
        const newRow = document.createElement('tr');
        newRow.setAttribute('data-product-id', selectedProductId);
        newRow.innerHTML = `
            <td>${selectedProduct.name}</td>
            <td>${quantity}</td>
            <td>${importPrice}</td>
            <td>${profitPercent}%</td>
            <td>${total}</td>
            <td style='text-align: center; vertical-align: middle;'><i class='fa-solid fa-trash' style='cursor:pointer'></i></td>
        `;
        document.getElementById('total-price-ip').textContent = totalAmount.toLocaleString('vi-VN') + ' VND';
        importListBody.appendChild(newRow);
        // Reset chọn sản phẩm và input
        Array.from(productTableBody.children).forEach(r => r.classList.remove('selected'));
        selectedProduct = null;
        selectedProductId = null;
        document.getElementById('quantity').value = '';
        document.getElementById('import-price').value = '';
        document.getElementById('profit-percent').value = '';
    });

    // Xử lý xóa sản phẩm khỏi bảng sản phẩm trong phiếu
    document.querySelector('.imported-product-list-section tbody').addEventListener('click', function(e) {
        if (e.target.classList.contains('fa-trash')) {
            const row = e.target.closest('tr');
            if (row) row.remove();
        }
    });

    // Khi click nút 'Thêm phiếu nhập'
    document.getElementById('submit-import-btn').addEventListener('click', function(e) {
        e.preventDefault();
        // Lấy employee_id từ session
        const employee_id = window.adminInfo?.userName;
        if (!employee_id) {
            alert('Vui lòng đăng nhập lại!');
            return;
        }

        const supplier_id = supplierSelect.value;
        const importListBody = document.querySelector('.imported-product-list-section tbody');
        const rows = importListBody.querySelectorAll('tr');

        // Kiểm tra dữ liệu đầu vào
        if (!supplier_id || rows.length === 0) {
            alert('Vui lòng chọn nhà cung cấp và thêm ít nhất một sản phẩm!');
            return;
        }

        // Lấy danh sách sản phẩm và kiểm tra dữ liệu
        const products = [];
        let hasError = false;

        rows.forEach(row => {
            const tds = row.querySelectorAll('td');
            const product_id = row.getAttribute('data-product-id');
            const quantity = parseInt(tds[1].textContent);
            const import_price = parseFloat(tds[2].textContent);

            // Kiểm tra số lượng và giá nhập
            if (isNaN(quantity) || quantity <= 0) {
                alert('Số lượng phải lớn hơn 0!');
                hasError = true;
                return;
            }

            if (isNaN(import_price) || import_price <= 0) {
                alert('Giá nhập phải lớn hơn 0!');
                hasError = true;
                return;
            }

            products.push({ 
                product_id, 
                quantity, 
                import_price 
            });
        });

        if (hasError) return;

        // Gửi AJAX
        fetch('../../PHP/IP-Add.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ 
                employee_id, 
                supplier_id, 
                products 
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                // Thêm dòng mới vào bảng import-table
                const importTableBody = document.getElementById('import-table-body');
                const currentRowCount = importTableBody.querySelectorAll('tr').length;
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td>${currentRowCount + 1}</td>
                    <td>${data.import.id}</td>
                    <td>${data.import.employee_id}</td>
                    <td>${data.import.importDate}</td>
                    <td><select class='import-status' data-id='${data.import.id}' data-current-status='1'>
                        <option value='1' selected>Chưa duyệt</option>
                        <option value='2'>Đã duyệt</option>
                    </select></td>
                    <td style='text-align: center; vertical-align: middle;'>
                          <i class='fa-solid fa-circle-info import-detail' data-id='${data.import.id}' style='cursor:pointer'></i>
                    </td>
                    <td>
                        <div class='fix-import'>
                            <i class='fa-solid fa-pen-to-square fix-btn-import'></i>
                            <i class='fa-solid fa-trash delete-btn-import' style='cursor:pointer'></i>
                        </div>
                    </td>
                `;
                // Thêm vào cuối bảng thay vì đầu bảng
                importTableBody.appendChild(newRow);
                setImportStatusColor(newRow.querySelector('.import-status'));
                // Reset bảng sản phẩm trong phiếu nhập
                importListBody.innerHTML = '';
                // Reset combobox và tổng tiền
                supplierSelect.value = '';
                categorySelect.innerHTML = '<option value="">Chọn loại</option>';
                subcategorySelect.innerHTML = '<option value="">Chọn chủng loại</option>';
                productTableBody.innerHTML = '';
                totalAmount = 0;
                document.getElementById('total-price-ip').textContent = '0 VND';
                alert('Thêm phiếu nhập thành công!');
            } else {
                alert('Lỗi: ' + data.message);
            }
        })
        .catch(err => {
            console.error('Lỗi:', err);
            alert('Có lỗi xảy ra khi kết nối server!');
        });
    });

    // Hàm set màu viền cho trạng thái phiếu nhập
    function setImportStatusColor(select) {
        if (select.value == "2") {
            select.style.boxShadow = "0 0 5px 1px rgb(47, 218, 70)";
        } else {
            select.style.boxShadow = "0 0 5px 1px #ff9800";
        }
    }
    // Áp dụng cho tất cả combobox trạng thái phiếu nhập khi trang load
    document.querySelectorAll('.import-status').forEach(setImportStatusColor);
});

// Xử lý hiển thị chi tiết phiếu nhập
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('import-detail')) {
        const importId = e.target.getAttribute('data-id');
        
        document.querySelector('.import-table').style.display = 'none';
        
        const detailContainer = document.querySelector('.import-detail-container');
        detailContainer.style.display = 'block';
        
        // Lấy thông tin chi tiết từ server
        fetch(`../../PHP/getImportDetail.php?id=${importId}`)
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const importInfo = data.import;
                    const infoRows = detailContainer.querySelectorAll('.info-row-ip');
                    
                    infoRows[0].innerHTML = `
                        <span><strong>Mã phiếu nhập:</strong> ${importInfo.id}</span>
                        <span><strong>Mã nhân viên:</strong> ${importInfo.employee_id}</span>
                    `;
                    
                    infoRows[1].innerHTML = `
                        <span><strong>Ngày nhập:</strong> ${importInfo.importDate}</span>
                        <span><strong>Trạng thái:</strong> ${importInfo.status == 1 ? 'Chưa duyệt' : 'Đã duyệt'}</span>
                    `;
                    
                    infoRows[2].innerHTML = `
                        <span><strong>Tổng tiền:</strong> ${importInfo.total_amount.toLocaleString('vi-VN')} VNĐ</span>
                    `;
                    
                    const tbody = detailContainer.querySelector('.imported-product-list-section table tbody');
                    tbody.innerHTML = '';
                    
                    // Chỉ hiển thị sản phẩm của phiếu nhập hiện tại
                    if (data.details && data.details.length > 0) {
                        data.details.forEach(detail => {
                            const profitPercent = ((detail.product_price - detail.unitPrice) / detail.unitPrice * 100).toFixed(2);
                            tbody.innerHTML += `
                                <tr>
                                    <td>${detail.product_name}</td>
                                    <td>${detail.quantity}</td>
                                    <td>${detail.unitPrice.toLocaleString('vi-VN')} VNĐ</td>
                                    <td>${profitPercent}%</td>
                                    <td>${detail.subtotal.toLocaleString('vi-VN')} VNĐ</td>
                                </tr>
                            `;
                        });
                    } else {
                        tbody.innerHTML = '<tr><td colspan="5" style="text-align: center;">Không có sản phẩm nào</td></tr>';
                    }
                } else {
                    alert('Lỗi: ' + data.message);
                }
            })
            .catch(err => {
                console.error('Lỗi:', err);
                alert('Có lỗi xảy ra khi lấy thông tin chi tiết!');
            });
    }
});

// Xử lý thay đổi trạng thái phiếu nhập bằng AJAX

document.addEventListener('change', function(e) {
    if (e.target.classList.contains('import-status')) {
        const select = e.target;
        const importId = select.getAttribute('data-id');
        const newStatus = select.value;
        // Nếu trạng thái hiện tại là Đã duyệt thì không cho chuyển về Chưa duyệt
        if (select.getAttribute('data-current-status') === '2' && newStatus === '1') {
            select.value = '2';
            alert('Không thể thay đổi trạng thái!');
            return;
        }
        fetch('../../PHP/IP-update_status.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `import_id=${encodeURIComponent(importId)}&status=${encodeURIComponent(newStatus)}`
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                select.style.boxShadow = newStatus == "2"
                    ? "0 0 5px 1px rgb(47, 218, 70)"
                    : "0 0 5px 1px #ff9800";
                // Cập nhật lại data-current-status
                select.setAttribute('data-current-status', newStatus);
                alert('Cập nhật trạng thái thành công!');
            } else {
                alert(data.message || 'Cập nhật trạng thái thất bại!');
            }
        })
        .catch(() => {
            alert('Có lỗi khi kết nối server!');
        });
    }
});

// Xử lý xóa phiếu nhập
document.querySelectorAll('.delete-btn-import').forEach(btn => {
    btn.addEventListener('click', function() {
        const row = this.closest('tr');
        const importId = row.getAttribute('data-id');
        
        document.getElementById('delete-overlay-import').style.display = 'block';
        
        document.getElementById('delete-acp-import').onclick = function() {
            fetch('../../PHP/IP-Delete.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `id=${importId}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Xóa row khỏi bảng
                    row.remove();
                    alert(data.message);
                } else {
                    alert(data.message);
                }
                // Ẩn overlay
                document.getElementById('delete-overlay-import').style.display = 'none';
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Có lỗi xảy ra khi xóa phiếu nhập!');
                document.getElementById('delete-overlay-import').style.display = 'none';
            });
        };
        
        // Xử lý khi click nút hủy
        document.getElementById('cancel-import').onclick = function() {
            document.getElementById('delete-overlay-import').style.display = 'none';
        };
    });
});

