document.addEventListener("DOMContentLoaded", function () {

    const statistic_part = document.querySelector(".statistic-part");
    const oder_part = document.querySelector(".order-part");
    const product_part = document.querySelector(".product-part");
    const customer_part = document.querySelector(".customer-part");
    const admin_main = document.querySelector(".admin-main");
    const admin_statistic = document.querySelector("#admin-statistic");
    const admin_oder = document.querySelector("#admin-oder");
    const admin_product = document.querySelector("#admin-product");
    const admin_customer = document.querySelector("#admin-customer");
    const admin_account = document.querySelector("#admin-account");
    const admin_role = document.querySelector("#admin-role");
    const admin_employee = document.querySelector("#admin-employee");
    const admin_import = document.querySelector("#admin-import")
    const admin = document.querySelector("#admin");
    const profile_img = document.querySelector("#profile");
    const profile_part = document.querySelector(".profile-part");
    const account_part = document.querySelector(".account-part");
    const role_part = document.querySelector(".role-part");
    const employee_part = document.querySelector(".employee-part");
    const import_part = this.documentElement.querySelector(".import-part")

    function statisticToggle() {
        statistic_part.style.display = "block";
        oder_part.style.display = "none";
        admin_main.style.display = "none";
        customer_part.style.display = "none";
        product_part.style.display = "none";
        profile_part.style.display = "none";
        account_part.style.display = "none";
        role_part.style.display = "none";
        employee_part.style.display = "none";
        import_part.style.display = "none";
    }

    function oderToggle() {
        oder_part.style.display = "block";
        statistic_part.style.display = "none";
        admin_main.style.display = "none";
        customer_part.style.display = "none";
        product_part.style.display = "none";
        profile_part.style.display = "none";
        account_part.style.display = "none";
        role_part.style.display = "none";
        employee_part.style.display = "none";
        import_part.style.display = "none";
    }

    function customerToggle() {
        customer_part.style.display = "block";
        statistic_part.style.display = "none";
        oder_part.style.display = "none";
        admin_main.style.display = "none";
        product_part.style.display = "none";
        profile_part.style.display = "none";
        account_part.style.display = "none";
        role_part.style.display = "none";
        employee_part.style.display = "none";
        import_part.style.display = "none";
    }

    function productToggle() {
        product_part.style.display = "block";
        statistic_part.style.display = "none";
        admin_main.style.display = "none";
        customer_part.style.display = "none";
        oder_part.style.display = "none";
        profile_part.style.display = "none";
        account_part.style.display = "none";
        role_part.style.display = "none";
        employee_part.style.display = "none";
        import_part.style.display = "none";
    }

    function returnMain() {
        statistic_part.style.display = "none";
        oder_part.style.display = "none";
        customer_part.style.display = "none";
        product_part.style.display = "none"
        admin_main.style.display = "block";
        profile_part.style.display = "none";
        account_part.style.display = "none";
        role_part.style.display = "none";
        employee_part.style.display = "none";
        import_part.style.display = "none";
    }

    function accountToggle() {
        oder_part.style.display = "none";
        customer_part.style.display = "none";
        product_part.style.display = "none"
        admin_main.style.display = "none";
        profile_part.style.display = "none";
        account_part.style.display = "block";
        role_part.style.display = "none";
        employee_part.style.display = "none";
        import_part.style.display = "none";
    }

    function roleToggle() {
        oder_part.style.display = "none";
        customer_part.style.display = "none";
        product_part.style.display = "none"
        admin_main.style.display = "none";
        profile_part.style.display = "none";
        account_part.style.display = "none";
        role_part.style.display = "block";
        employee_part.style.display = "none";
        import_part.style.display = "none";
    }

    function employeeToggle() {
        oder_part.style.display = "none";
        customer_part.style.display = "none";
        product_part.style.display = "none"
        admin_main.style.display = "none";
        profile_part.style.display = "none";
        account_part.style.display = "none";
        role_part.style.display = "none";
        employee_part.style.display = "block";
        import_part.style.display = "none";
    }

    function importToggle() {
        oder_part.style.display = "none";
        customer_part.style.display = "none";
        product_part.style.display = "none"
        admin_main.style.display = "none";
        profile_part.style.display = "none";
        account_part.style.display = "none";
        role_part.style.display = "none";
        employee_part.style.display = "none";
        import_part.style.display = "block";
    }

    admin_statistic.addEventListener("click", statisticToggle);
    admin_oder.addEventListener("click", oderToggle);
    admin_product.addEventListener("click", productToggle);
    admin_customer.addEventListener("click", customerToggle);
    admin.addEventListener("click", returnMain);
    admin_account.addEventListener("click", accountToggle);
    admin_role.addEventListener("click", roleToggle);
    admin_employee.addEventListener("click", employeeToggle);
    admin_import.addEventListener("click", importToggle);
    // add product

    const add_form_1 = document.querySelector(".add-form-product");
    const plus_1 = document.querySelector("#product-plus");
    const product_table = document.querySelector(".product-table");
    const back_1 = document.querySelectorAll(".back-product");
    const fix_form_1 = document.querySelector(".fix-form-product");
    const fix_btn_1 = document.querySelectorAll(".fix-btn-product");
    const delete_btn_1 = document.querySelectorAll(".delete-btn-product");
    const delete_acp_1 = document.querySelector("#delete-acp-product");
    const delete_ovl_1 = document.querySelector("#delete-overlay-product");
    const cancel_btn_1 = document.querySelector("#cancel-product");


    const add_form_2 = document.querySelector(".detail-customer-container");
    const customer_table = document.querySelector(".customer-table");
    const fix_form_2 = document.querySelector(".fix-form-customer   ");
    const delete_acp_2 = document.querySelector("#delete-acp-customer");
    const delete_ovl_2 = document.querySelector("#delete-overlay-customer");
    const back_2 = document.querySelectorAll(".back-customer");
    const delete_btn_2 = document.querySelectorAll(".delete-btn-customer");
    const fix_btn_2 = document.querySelectorAll(".fix-btn-customer");
    const cancel_btn_2 = document.querySelector("#cancel-customer");

    const order_history = document.querySelector(".history-order-container");
    const show_order_btn = document.querySelectorAll(".history-order")
    // const back_history = document.querySelector(".back-customer2");

    const add_form_3 = document.querySelector(".add-form-account");
    const plus_3 = document.querySelector("#account-plus");
    const account_table = document.querySelector(".account-table");
    const fix_form_3 = document.querySelector(".fix-form-account   ");
    const delete_acp_3 = document.querySelector("#delete-acp-account");
    const delete_ovl_3 = document.querySelector("#delete-overlay-account");
    const back_3 = document.querySelectorAll(".back-account");
    const delete_btn_3 = document.querySelectorAll(".delete-btn-account");
    const fix_btn_3 = document.querySelectorAll(".fix-btn-account");
    const cancel_btn_3 = document.querySelector("#cancel-account");

    const add_form_4 = document.querySelector(".add-form-role");
    const plus_4 = document.querySelector("#role-plus");
    const role_table = document.querySelector(".role-table");
    const fix_form_4 = document.querySelector(".fix-form-role");
    const delete_acp_4 = document.querySelector("#delete-acp-role");
    const delete_ovl_4 = document.querySelector("#delete-overlay-role");
    const back_4 = document.querySelectorAll(".back-role");
    const delete_btn_4 = document.querySelectorAll(".delete-btn-role");
    const fix_btn_4 = document.querySelectorAll(".fix-btn-role");
    const cancel_btn_4 = document.querySelector("#cancel-role");
    const account_ovl_4 = document.querySelector("#account-overlay-role");
    const show_userrole = document.querySelectorAll(".show-userrole");

    const add_form_5 = document.querySelector(".add-form-employee");
    const plus_5 = document.querySelector("#employee-plus");
    const employee_table = document.querySelector(".employee-table");
    const back_5 = document.querySelectorAll(".back-employee");
    const fix_form_5 = document.querySelector(".fix-form-employee");
    const fix_btn_5 = document.querySelectorAll(".fix-btn-employee");
    const delete_btn_5 = document.querySelectorAll(".delete-btn-employee");
    const delete_acp_5 = document.querySelector("#delete-acp-employee");
    const delete_ovl_5 = document.querySelector("#delete-overlay-employee");
    const cancel_btn_5 = document.querySelector("#cancel-employee");
    console.log("cancel_btn_5 = ", cancel_btn_5);

    const add_form_6 = document.querySelector(".import-receipt-container");
    const plus_6 = document.querySelector("#import-plus");
    const import_table = document.querySelector(".import-table");
    const back_6 = document.querySelectorAll(".back-import");
    const fix_form_6 = document.querySelector(".import-receipt-fix-container");
    const fix_btn_6 = document.querySelectorAll(".fix-btn-import");
    const delete_btn_6 = document.querySelectorAll(".delete-btn-import");
    const delete_acp_6 = document.querySelector("#delete-acp-import");
    const delete_ovl_6 = document.querySelector("#delete-overlay-import");
    const cancel_btn_6 = document.querySelector("#cancel-import");
    const import_detail_btn = document.querySelectorAll(".import-detail");
    const import_detail = document.querySelector(".import-detail-container");


    function addFormProduct() {
        product_table.style.display = "none";
        add_form_1.style.display = "block";
        plus_1.style.display = "none";
        fix_form_1.style.display = "none";
        profile_part.style.display = "none";

    }

    // function addFormCustomer(){
    //     customer_table.style.display = "none";
    //     add_form_2.style.display = "block";
    //     fix_form_2.style.display = "none";
    //     profile_part.style.display = "none";

    // }

    function addFormAccount() {
        account_table.style.display = "none";
        add_form_3.style.display = "block";
        plus_3.style.display = "none";
        fix_form_3.style.display = "none";
        profile_part.style.display = "none";
    }

    function addFormRole() {
        role_table.style.display = "none";
        add_form_4.style.display = "block";
        plus_4.style.display = "none";
        fix_form_4.style.display = "none";
        profile_part.style.display = "none";

    }

    function addFormEmployee() {
        employee_table.style.display = "none";
        add_form_5.style.display = "block";
        plus_5.style.display = "none";
        fix_form_5.style.display = "none";
        profile_part.style.display = "none";
    }

    function addFormImport() {
        import_table.style.display = "none";
        add_form_6.style.display = "block";
        plus_6.style.display = "none";
        fix_form_6.style.display = "none";
        profile_part.style.display = "none";
    }

    function fixFormProduct() {
        product_table.style.display = "none";
        fix_form_1.style.display = "block";
        plus_1.style.display = "none";
        add_form_1.style.display = "none";
        profile_part.style.display = "none";
    }


    function fixFormCustomer() {
        customer_table.style.display = "none";
        fix_form_2.style.display = "block";
        add_form_2.style.display = "none";
        profile_part.style.display = "none";
    }

    function fixFormAccount() {
        account_table.style.display = "none";
        fix_form_3.style.display = "block";
        plus_3.style.display = "none";
        add_form_3.style.display = "none";
        profile_part.style.display = "none";
    }

    function fixFormRole() {
        role_table.style.display = "none";
        fix_form_4.style.display = "block";
        plus_4.style.display = "none";
        add_form_4.style.display = "none";
        profile_part.style.display = "none";
    }


    function fixFormEmployee() {
        employee_table.style.display = "none";
        fix_form_5.style.display = "block";
        plus_5.style.display = "none";
        add_form_5.style.display = "none";
        profile_part.style.display = "none";
    }

    function fixFormImport() {
        import_table.style.display = "none";
        fix_form_6.style.display = "block";
        plus_6.style.display = "none";
        add_form_6.style.display = "none";
        profile_part.style.display = "none";
    }

    function returnProduct() {
        product_table.removeAttribute("style");
        add_form_1.style.display = "none";
        plus_1.style.display = "block";
        fix_form_1.style.display = "none";
        delete_ovl_1.style.display = "none";
        profile_part.style.display = "none";
        import_part.style.display = "none";
    }

    function returnCustomer() {
        customer_table.removeAttribute("style");
        add_form_2.style.display = "none";
        fix_form_2.style.display = "none";
        delete_ovl_2.style.display = "none";
        profile_part.style.display = "none";
        order_history.style.display = "none";
    }

    function returnAcount() {
        account_table.removeAttribute("style");
        add_form_3.style.display = "none";
        plus_3.style.display = "block";
        fix_form_3.style.display = "none";
        delete_ovl_3.style.display = "none";
        profile_part.style.display = "none";
    }

    function returnRole() {
        role_table.removeAttribute("style");
        add_form_4.style.display = "none";
        plus_4.style.display = "block";
        fix_form_4.style.display = "none";
        delete_ovl_4.style.display = "none";
        profile_part.style.display = "none";
        account_ovl_4.style.display = "none";
    }

    function returnEmployee() {
        // console.log("Hủy overlay nhân viên");
        employee_table.removeAttribute("style");
        add_form_5.style.display = "none";
        plus_5.style.display = "block";
        fix_form_5.style.display = "none";
        delete_ovl_5.style.display = "none";
        profile_part.style.display = "none";
    }

    function returnImport() {
        import_table.removeAttribute("style");
        add_form_6.style.display = "none";
        plus_6.style.display = "block";
        fix_form_6.style.display = "none";
        delete_ovl_6.style.display = "none";
        profile_part.style.display = "none";
        import_detail.style.display = "none";
    }

    function showOrderHistory() {
        order_history.style.display = "block";
        customer_table.style.display = "none";
    }


    function showImportDetail() {
        import_table.style.display = "none";
        import_detail.style.display = "block";
        plus_6.style.display = "none";
    }

    function showNofiProduct() {
        delete_ovl_1.style.display = "block";
    }

    function showNofiCustomer() {
        delete_ovl_2.style.display = "block";
    }

    function showNofiAccount() {
        delete_ovl_3.style.display = "block";
    }

    function showNofiRole() {
        delete_ovl_4.style.display = "block";
    }

    function showNofiEmployee() {
        delete_ovl_5.style.display = "block";
    }

    function showNofiImport() {
        delete_ovl_6.style.display = "block";
    }

    function showUserRole() {
        account_ovl_4.style.display = "block";
    }


    plus_1.addEventListener("click", addFormProduct);
    plus_3.addEventListener("click", addFormAccount);
    plus_4.addEventListener("click", addFormRole);
    plus_5.addEventListener("click", addFormEmployee);
    plus_6.addEventListener("click", addFormImport);


    show_order_btn.forEach(button => {
        button.addEventListener("click", showOrderHistory);
    })


    import_detail_btn.forEach(button => {
        button.addEventListener("click", showImportDetail);
    })


    delete_btn_1.forEach(button => {
        button.addEventListener("click", showNofiProduct);
    })

    delete_btn_2.forEach(button => {
        button.addEventListener("click", showNofiCustomer);
    })

    delete_btn_3.forEach(button => {
        button.addEventListener("click", showNofiAccount);
    })

    delete_btn_4.forEach(button => {
        button.addEventListener("click", showNofiRole);
    })

    delete_btn_5.forEach(button => {
        button.addEventListener("click", showNofiEmployee);
    })

    delete_btn_6.forEach(button => {
        button.addEventListener("click", showNofiImport);
    })

    fix_btn_1.forEach(button => {
        button.addEventListener("click", fixFormProduct);
    })

    fix_btn_2.forEach(button => {
        button.addEventListener("click", fixFormCustomer);
    })

    fix_btn_3.forEach(button => {
        button.addEventListener("click", fixFormAccount);
    })

    fix_btn_4.forEach(button => {
        button.addEventListener("click", fixFormRole);
    })

    fix_btn_5.forEach(button => {
        button.addEventListener("click", fixFormEmployee);
    })

    fix_btn_6.forEach(button => {
        button.addEventListener("click", fixFormImport);
    })

    back_1.forEach(button => {
        button.addEventListener("click", returnProduct);
    })


    back_2.forEach(button => {
        button.addEventListener("click", returnCustomer);
    })

    back_3.forEach(button => {
        button.addEventListener("click", returnAcount);
    })

    back_4.forEach(button => {
        button.addEventListener("click", returnRole);
    })

    back_5.forEach(button => {
        button.addEventListener("click", returnEmployee);
    })

    back_6.forEach(button => {
        button.addEventListener("click", returnImport);
    })

    // back_history.addEventListener("click",returnCustomer);

    show_userrole.forEach(button => {
        button.addEventListener("click", showUserRole);
    })

    account_ovl_4.addEventListener("click", function (event) {
        if (event.target === account_ovl_4) {
            returnRole();
        }
    });

    delete_acp_1.addEventListener("click", returnProduct);
    delete_acp_2.addEventListener("click", returnCustomer);
    delete_acp_3.addEventListener("click", returnAcount);
    delete_acp_4.addEventListener("click", returnRole);
    delete_acp_5.addEventListener("click", returnEmployee);
    delete_acp_6.addEventListener("click", returnImport);

    cancel_btn_1.addEventListener("click", returnProduct);
    cancel_btn_2.addEventListener("click", returnCustomer);
    cancel_btn_3.addEventListener("click", returnAcount);
    cancel_btn_4.addEventListener("click", returnRole);
    cancel_btn_5.addEventListener("click", returnEmployee);
    cancel_btn_6.addEventListener("click", returnImport);

    // profile

    function showProfile() {
        profile_part.style.display = "block";
        admin_main.style.display = "none";
    }

    profile_img.addEventListener("click", showProfile);

    // customer

    // account
    const statusElements = document.querySelectorAll(".account-status, .customer-status");

    function ChangeStatus(event) {
        let select = event.target;

        if (select.value == "2") {
            select.style.boxShadow = "0 0 5px 1px red";
        }
        else {
            select.style.boxShadow = "0 0 5px 1px rgb(47, 218, 70)";
        }
    }

    statusElements.forEach(select => {
        select.addEventListener("change", ChangeStatus);
        ChangeStatus({ target: select });
    })


    // Phần chọn sản phẩm thêm vào phiếu nhập

    const rows = document.querySelectorAll(".import-table-show tbody tr");
    rows.forEach((row) => {
        row.addEventListener("click", function () {
            // Bỏ class 'selected' khỏi tất cả hàng khác
            rows.forEach(r => r.classList.remove("selected"));
            // Thêm class 'selected' cho hàng được click
            this.classList.add("selected");
        });
    });
});

// role popup show 
function togglePopup(event) {
    let popup = document.getElementById("role-popup");
    let icon = event.target;

    let rect = icon.getBoundingClientRect();
    let top = rect.bottom + window.scrollY + 10;
    let left = rect.left + window.scrollX;

    popup.style.top = `${top}px`;
    popup.style.left = `${left}px`;
    popup.style.display = popup.style.display === "block" ? "none" : "block";

    document.addEventListener("click", function hidePopup(e) {
        if (!popup.contains(e.target) && e.target !== icon) {
            popup.style.display = "none";
            document.removeEventListener("click", hidePopup);
        }
    });
}