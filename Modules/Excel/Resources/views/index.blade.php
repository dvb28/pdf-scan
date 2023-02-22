@extends('excel::layouts.master')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://unpkg.com/read-excel-file@4.x/bundle/read-excel-file.min.js"></script>

<div class="">
    <input type="file" id="file-input" accept=".xlsx">
    <table class="table table-bordered" id="excel-table">
    </table>
</div>

<script>
    const input = document.getElementById('file-input');
    const table = document.getElementById('excel-table');

    input.addEventListener('change', (event) => {
        const file = event.target.files[0];
 
        readXlsxFile(file).then((rows) => {
            // Clear the table
            table.innerHTML = '';
 
            // Add the rows to the table
            rows.forEach((row) => {
                const tr = document.createElement('tr');
                row.forEach((cell) => {
                    const td = document.createElement('td');
                    td.textContent = cell;
                    tr.appendChild(td);
                });
                table.appendChild(tr);
            });
        });
    });
</script>

@endsection
