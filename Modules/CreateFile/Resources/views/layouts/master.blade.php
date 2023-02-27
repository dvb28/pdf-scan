<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}"></meta>
        <title>Module Create File</title>

        {{-- Icon --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        {{-- Css --}}
        <link rel="stylesheet" href="{{mix('/resources/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{mix('/resources/css/atlantis.min.css')}}">

        <link href="{{mix('/node_modules/quill/dist/quill.snow.css')}}" rel="stylesheet">
        
        <!--   Core JS Files   -->
        <script src="{{mix('/resources/js/core/jquery.3.2.1.min.js')}}"></script>
        <script src="{{mix('/resources/js/core/popper.min.js')}}"></script>
        <script src="{{mix('/resources/js/core/bootstrap.min.js')}}"></script>
        <script src="{{mix('/resources/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

        <script src="{{mix('/node_modules/quill/dist/quill.js')}}"></script>

        <script src="{{mix('/node_modules/quill-image-resize-module/image-resize.min.js')}}"></script>
        
        
        {{-- Laravel Vite - CSS File --}}
        {{-- {{ module_vite('build-createfile', 'Resources/assets/sass/app.scss') }} --}}

    </head>
    <body>
        @yield('content')

        {{-- Laravel Vite - JS File --}}
        {{-- {{ module_vite('build-createfile', 'Resources/assets/js/app.js') }} --}}
    </body>
</html>
