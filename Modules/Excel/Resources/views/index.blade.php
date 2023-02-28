@extends('excel::layouts.master')

@section('content')

<div class="">
    <input type="file" id="file-input" accept=".xlsx">
    <table class="table table-bordered" id="excel-table">
    </table>
</div>

<script src="{{mix('/Modules/Excel/Resources/assets/js/app.js')}}"></script>

@endsection
