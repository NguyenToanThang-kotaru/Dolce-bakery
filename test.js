
document.addEventListener("DOMContentLoaded", function () {
    const provinceSelect = document.getElementById("province");
    const districtSelect = document.getElementById("district");
    const wardSelect = document.getElementById("ward");

    // Load tỉnh/thành
    fetch("https://provinces.open-api.vn/api/?depth=1")
        .then(response => response.json())
        .then(data => {
            data.forEach(province => {
                const option = document.createElement("option");
                option.value = province.code;
                option.textContent = province.name;
                provinceSelect.appendChild(option);
            });
        });

    // Khi chọn tỉnh -> load quận/huyện
    provinceSelect.addEventListener("change", function () {
        const provinceCode = this.value;
        districtSelect.innerHTML = `<option value="">Chọn quận/huyện</option>`;
        wardSelect.innerHTML = `<option value="">Chọn xã/phường</option>`;

        if (provinceCode) {
            fetch(`https://provinces.open-api.vn/api/p/${provinceCode}?depth=2`)
                .then(response => response.json())
                .then(data => {
                    data.districts.forEach(district => {
                        const option = document.createElement("option");
                        option.value = district.code;
                        option.textContent = district.name;
                        districtSelect.appendChild(option);
                    });
                });
        }
    });

    // Khi chọn huyện -> load xã/phường
    districtSelect.addEventListener("change", function () {
        const districtCode = this.value;
        wardSelect.innerHTML = `<option value="">Chọn xã/phường</option>`;

        if (districtCode) {
            fetch(`https://provinces.open-api.vn/api/d/${districtCode}?depth=2`)
                .then(response => response.json())
                .then(data => {
                    data.wards.forEach(ward => {
                        const option = document.createElement("option");
                        option.value = ward.code;
                        option.textContent = ward.name;
                        wardSelect.appendChild(option);
                    });
                });
        }
    });
});

