<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Module Excel</title>

        <link rel="stylesheet" href="{{mix('/resources/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{mix('/resources/css/atlantis.min.css')}}">

        <script src="{{mix('/resources/js/core/jquery.3.2.1.min.js')}}"></script>
        <script src="{{mix('/resources/js/core/bootstrap.min.js')}}"></script>
        
        <script src="https://unpkg.com/read-excel-file@4.x/bundle/read-excel-file.min.js"></script>

        <!-- Datatables -->
        <script src="{{mix('/resources/js/plugin/datatables/datatables.min.js')}}"></script>

       {{-- Laravel Vite - CSS File --}}
       {{-- {{ module_vite('build-excel', 'Resources/assets/sass/app.scss') }} --}}

    </head>
    <body>
        @yield('content')

        {{-- Laravel Vite - JS File --}}
        {{-- {{ module_vite('build-excel', 'Resources/assets/js/app.js') }} --}}
    </body>
</html>
