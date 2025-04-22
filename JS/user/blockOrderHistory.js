const closeBtn = document.querySelector('.close-history-modal');
const modalOverlay = document.querySelector('.modal-overlay-history');
function openOrderHistory()
{
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
        })
        .catch(error => {
            console.error("Lỗi:", error);
        });
}
