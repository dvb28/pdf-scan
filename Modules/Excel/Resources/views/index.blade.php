@extends('excel::layouts.master')

@section('content')

<style>
    /* #excel-table {
        border: 0;
    } */

    .excel-table__box {
        margin: 20px;
        overflow: auto;
    }

    .excel-table__box .row {
        position: relative;
        overflow: auto;
    }

    #excel-table th, #excel-table td {
        min-width: 200px;
        padding: 0 20px;
        text-align: justify;
    }
    

    #excel-table td, #excel-table .sorting_1 {
        max-height: 25px!important;
    }
</style>

<div class="root">
    <input type="file" id="file-input" accept=".xlsx">
    <div class="excel-table__box">
        <table class="excel-table table-bordered table-hover" id="excel-table">
            <thead></thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<script src="{{mix('/Modules/Excel/Resources/assets/js/app.js')}}"></script>

@endsection
