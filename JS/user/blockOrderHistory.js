const closeBtn = document.querySelector('.close-history-modal');
const modalOverlay = document.querySelector('.modal-overlay-history');

function openOrderHistory() {
    loadOrders();
}

closeBtn.addEventListener('click', function () {
    modalOverlay.style.display = "none";
});

function loadOrders() {
    fetch('../../PHP/users/get_order_history.php')
        .then(response => response.text())
        .then(data => {
            document.querySelector('.orders-scroll-area').innerHTML = data;
            modalOverlay.style.display = "flex";

            document.querySelectorAll('.cancel-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const orderID = btn.getAttribute('data-order-id');
                    if (confirm(`Bạn có chắc muốn hủy đơn hàng #${orderID}?`)) {
                        fetch('../../PHP/users/cancelOrder.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'orderID=' + orderID
                        })
                        .then(res => res.text())
                        .then(msg => {
                            alert(msg);
                            loadOrders(); 
                        });
                    }
                });
            });
        })
        .catch(error => {
            console.error("Lỗi:", error);
        });
}
