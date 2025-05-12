$(document).ready(function() {
    loadCustomerAddress();
});
function loadCustomerAddress() {
    $.ajax({
        url: '../../PHP/users/loadCustomerAddress.php',
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                let addresses = response.data;

                addresses.sort((a, b) => b.default_id - a.default_id);
                
                let addressHTML = `
                    <div class="modal-header">Địa chỉ nhận hàng</div>
                    <div class="address-scroll-wrapper">
                `;

                addresses.forEach((address) => {
                    const isDefault = address.default_id == 1;

                    addressHTML += `
                        <div class="address-card">
                            <div class = "address_id" style = "display: none">${address.id}</div>
                            <input class="radio" type="radio" name="address" ${isDefault ? 'checked' : ''} />
                            <div class="address-content">
                                <div>${address.fullAddress}</div>
                                ${isDefault ? '<div class="default-label">Địa chỉ mặc định</div>' : ''}
                            </div>
                            <button class="edit-button" onclick="editAddress(${address.id})">Sửa</button>
                            ${!isDefault ? `<button class="delete-button" onclick="deleteAddress(${address.id})">Xóa</button>` : ''}
                        </div>
                    `;
                });

                addressHTML += `</div>`; 

                addressHTML += `
                    <div class="add-new-btn" onclick="OnUpdateAddress()">
                        <div>Thêm địa chỉ mới</div>
                        <div class="add-icon">+</div>
                    </div>
                    <button class="continue-btn" onClick="getAddressToPaying();">Tiếp tục</button>
                `;

                $('.modal-select-address').html(addressHTML);

                // Gắn lại các sự kiện click
                $(document).on('click', '.address-card', function () {
                    const checkbox = $(this).find('input[type="radio"]')[0];
                    checkbox.checked = true;
                });

                $(document).on('click', '.edit-button, .delete-button', function (e) {
                    e.stopPropagation();
                });
                // Kiểm tra nếu chưa có địa chỉ nào -> bật và disable toggleDefaultAddress
                if (addresses.length === 0) {
                    $('#toggleDefaultAddress').prop('checked', true).prop('disabled', true);
                } else {
                    $('#toggleDefaultAddress').prop('checked', false).prop('disabled', false);
                }

            } else {
                alert("Không thể tải địa chỉ: " + response.message);
            }
        }
    });
}
function addAddress() {
    const addressDetail = $(".address").val();
    const province_id = $(".province").val();
    const district_id = $(".district").val();
    const isDefault = $('#toggleDefaultAddress').prop('checked') ? 1 : 0;
    if (!addressDetail || !province_id || !district_id) {
        showToast("Vui lòng nhập đầy đủ thông tin!", false);
        return;
    }
    // Nếu có đánh dấu là địa chỉ mặc định thì chạy update trước
    if (isDefault === 1) {
        $.ajax({
            url: '../../PHP/users/updateDefaultAddress.php',
            type: 'POST',
            dataType: 'json',
            success: function(updateResponse) {
                if (updateResponse.status === 'success') {
                    // Sau khi update xong mới thêm địa chỉ mới
                    addNewAddress(addressDetail, district_id, province_id, isDefault);
                } else {
                    alert("Cập nhật địa chỉ mặc định thất bại: " + updateResponse.message);
                }
            }
        });
    } else {
        // Nếu không chọn làm mặc định thì chỉ cần thêm
        addNewAddress(addressDetail, district_id, province_id, isDefault);
        
    }
}

function addNewAddress(addressDetail, district_id, province_id, default_id) {
    $.ajax({
        url: '../../PHP/users/addCustomerAddress.php',
        type: 'POST',
        dataType: 'json',
        data: {
            addressDetail: addressDetail,
            district_id: district_id,
            province_id: province_id,
            default_id: default_id
        },
        success: function(response) {
            if (response.status === 'success') {
                showToast("Thêm địa chỉ thành công.", true);
                loadCustomerAddress(); 
                document.querySelector(".overlayAddress").style.display = "none";
                document.querySelector(".overlayInfoAddress").style.display = "none";
                document.querySelector(".modal-select-address").style.display = "block";
                document.querySelector(".overlaySelectAddress").style.display = "block";

                $(".address").val('');
                $(".province").val('');
                $(".district").val('');
                $('#toggleDefaultAddress').prop('checked', false);
            } else {
                alert("Thêm địa chỉ thất bại: " + response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error("Lỗi thêm:", error);
            alert("Lỗi khi thêm địa chỉ.");
        }
    });
}
function deleteAddress(address_id) {
    if (confirm("Bạn có chắc chắn muốn xóa địa chỉ này?")) {
        $.ajax({
            url: '../../PHP/users/deleteCustomerAddress.php', 
            type: 'POST',
            dataType: 'json',
            data: { id: address_id },
            success: function(response) {
                if (response.status === 'success') {
                    loadCustomerAddress();
                    showToast("Địa chỉ đã được xóa thành công.", true);
                } else {
                    alert("Xóa địa chỉ không thành công: " + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error("Lỗi AJAX:", error);
                alert("Đã xảy ra lỗi khi xóa địa chỉ.");
            }
        });
    }
}

function editAddress(address_id)
{
   $.ajax({
        url: '../../PHP/users/getCustomerAddressById.php',
        type: 'POST',
        dataType: 'json',
        data: { id: address_id },
        success: function(response) {
            if (response.status === 'success') {
                const data = response.data;
                document.querySelector('.overlayAddressPayment .address_id').textContent = data.id;
                $(".overlayAddressPayment .address").val(data.addressDetail);
                $(".overlayAddressPayment .province").val(data.province_id).trigger("change");
                setTimeout(() => { $(".overlayAddressPayment .district").val(data.district_id); }, 100);

                if (data.default_id == 1) {
                    $('.overlayAddressPayment #toggleDefaultAddress').prop('checked', true).prop('disabled', true);
                } else {
                    $('.overlayAddressPayment #toggleDefaultAddress').prop('checked', false).prop('disabled', false);
                }
                
                $(".overlayAddressPayment").show();
                $(".overlayInfoAddress").show();
                
            } else {
                alert("Không lấy được thông tin địa chỉ: " + response.message);
            }
        },
        error: function(xhr, status, error) {
            alert("Lỗi khi lấy dữ liệu địa chỉ.");
        }
    }); 
}

function submitEditAddress() {
    const id = $(".overlayAddressPayment .address_id").text();
    const addressDetail = $(".overlayAddressPayment .address").val();
    const province_id = $(".overlayAddressPayment .province").val();
    const district_id = $(".overlayAddressPayment .district").val();
    const isDefault = $('.overlayAddressPayment #toggleDefaultAddress').prop('checked') ? 1 : 0;

    if (!addressDetail || !province_id || !district_id) {
        showToast("Vui lòng nhập đầy đủ thông tin!", false);
        return;
    }

    if (isDefault === 1) {
        $.ajax({
            url: '../../PHP/users/updateDefaultAddress.php',
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                updateAddress(id, addressDetail, province_id, district_id, isDefault);
            }
        });
    } else {
        updateAddress(id, addressDetail, province_id, district_id, isDefault);
    }
}

function updateAddress(id, addressDetail, province_id, district_id, default_id) {
    $.ajax({
        url: '../../PHP/users/updateCustomerAddress.php',
        type: 'POST',
        dataType: 'json',
        data: {
            id: id,
            addressDetail: addressDetail,
            province_id: province_id,
            district_id: district_id,
            default_id: default_id
        },
        success: function(response) {
            if (response.status === 'success') {
                showToast("Cập nhật thành công", true);
                loadCustomerAddress();
                $(".overlayAddressPayment").hide();
                $(".overlayInfoAddress").hide();
              
            } else {
                alert("Cập nhật thất bại: " + response.message);
            }
        },
        error: function() {
            alert("Lỗi khi cập nhật địa chỉ");
        }
    });
}

function getAddressToPaying() {
    const checkedRadio = $("input.radio[name='address']:checked");

    const addressCard = checkedRadio.closest(".address-card");

    const addressId = parseInt(addressCard.find(".address_id").text().trim());

    $(".overlaySelectAddress").hide();
    $(".modal-select-address").hide();
    $.ajax({
        url: '../../PHP/users/getCustomerAddressById.php',
        type: 'POST',
        data: { id: addressId },
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                const addressData = response.data;
                const provinceId = addressData.province_id;
                const districtId = addressData.district_id;
                
                $.ajax({
                    url: '../../PHP/users/getAddressName.php',
                    type: 'POST',
                    data: {
                        province: provinceId,
                        district: districtId
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.status === 'success') {
                            const provinceName = res.provinceName;
                            const districtName = res.districtName;

                            const address = addressData.addressDetail + ", " + districtName + ", " + provinceName;
                            
                            let userInfo = sessionStorage.getItem("userInfo");
                            userInfo = userInfo ? JSON.parse(userInfo) : {};
                            userInfo.address = address;
                            userInfo.addressDetail = addressData.addressDetail;
                            userInfo.district_id = districtId;
                            userInfo.province_id = provinceId;
                            sessionStorage.setItem("userInfo", JSON.stringify(userInfo));
                            setUserInfoPayment();
                            loadUserInfo();
                        } else {
                            console.warn("Không lấy được tên tỉnh/huyện:", res.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Lỗi khi lấy tên tỉnh/huyện:", error);
                    }
                });
            } else {
                console.warn("Không tìm thấy địa chỉ:", response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error("Lỗi khi lấy địa chỉ theo ID:", error);
        }
    });

  
}

