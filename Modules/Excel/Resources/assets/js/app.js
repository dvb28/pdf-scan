$(document).ready(function () {
    const input = document.getElementById("file-input");
    const table = document.getElementById("excel-table");
    const thead = document.querySelector("#excel-table thead");
    const tbody = document.querySelector("#excel-table tbody");

    // Sự kiện xảy ra khi file excel được tải lên
    input.addEventListener("change", (event) => {
        const file = event.target.files[0];

        // Hàm thêm row vào table
        function addRow(row, parent, element) {
            const tr = document.createElement("tr");
            row.forEach((cell) => {
                const elem = document.createElement(element);
                elem.textContent = cell;
                tr.appendChild(elem);
            });
            parent.appendChild(tr);
        }

        // Đọc file excel và render ra HTML
        readXlsxFile(file).then((rows) => {
            // Add the rows to the table
            rows.forEach((row, index) => {
                if (index === 0) {
                    addRow(row, thead, "th");
                } else {
                    addRow(row, tbody, "td");
                }
            });

            // Datatable
            $("#excel-table").DataTable({
                "autoWidth": true
            });
        });
    });
});
