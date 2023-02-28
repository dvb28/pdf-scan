<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Module Excel</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://unpkg.com/read-excel-file@4.x/bundle/read-excel-file.min.js"></script>

       {{-- Laravel Vite - CSS File --}}
       {{-- {{ module_vite('build-excel', 'Resources/assets/sass/app.scss') }} --}}

    </head>
    <body>
        @yield('content')

        {{-- Laravel Vite - JS File --}}
        {{-- {{ module_vite('build-excel', 'Resources/assets/js/app.js') }} --}}
    </body>
</html>
