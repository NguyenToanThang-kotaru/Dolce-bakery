    const filterFormST = document.getElementById("filter-form-statistic");
    const tableBodyST = document.querySelector(".statistic-table tbody");

    filterFormST.addEventListener("submit", function (event) {
        event.preventDefault();

        const startDate = document.getElementById("statistic-start-date").value;
        const endDate = document.getElementById("statistic-end-date").value;
        const sort_statistic = document.getElementById("statistic-sort").value;

        const formData = new URLSearchParams();
        formData.append("start_date", startDate);
        formData.append("end_date", endDate);
        formData.append("sort", sort_statistic);

        fetch("../../PHP/ST-Manager.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: formData.toString()
        })
        .then(response => response.text())
        .then(html => {
            tableBodyST.innerHTML = html;
            updateStatusColorEffect();
        })
        .catch(error => console.error("Lỗi thống kê:", error));
    });