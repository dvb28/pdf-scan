<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}"></meta>
        <title>Module ImportExcel</title>

        {{-- Icon --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        {{-- Css --}}
        <link rel="stylesheet" href="{{mix('/resources/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{mix('/resources/css/atlantis.min.css')}}">

        {{-- JS --}}
        <script src="{{mix('/resources/js/core/jquery.3.2.1.min.js')}}"></script>
        <script src="{{mix('/resources/js/core/popper.min.js')}}"></script>
        <script src="{{mix('/resources/js/core/bootstrap.min.js')}}"></script>
        <script src="{{mix('/resources/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
       
        {{-- Laravel Vite - CSS File --}}
        {{-- {{ module_vite('build-importexcel', 'Resources/assets/sass/app.scss') }} --}}

    </head>
    <body>
        @yield('content')

        {{-- Laravel Vite - JS File --}}
        {{-- {{ module_vite('build-createfile', 'Resources/assets/js/app.js') }} --}}
    </body>

        <!-- jQuery UI -->
        {{-- <script src="{{mix('/resources/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
        <script src="{{mix('/resources/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>

        <!-- jQuery Scrollbar -->
        <script src="{{mix('/resources/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>

        <!-- Moment JS -->
        <script src="{{mix('/resources/js/plugin/moment/moment.min.js')}}"></script>

        <!-- Chart JS -->
        <script src="{{mix('/resources/js/plugin/chart.js/chart.min.js')}}"></script>

        <!-- jQuery Sparkline -->
        <script src="{{mix('/resources/js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>

        <!-- Chart Circle -->
        <script src="{{mix('/resources/js/plugin/chart-circle/circles.min.js')}}"></script>

        <!-- Datatables -->
        <script src="{{mix('/resources/js/plugin/datatables/datatables.min.js')}}"></script>

        <!-- Bootstrap Notify -->
        <script src="{{mix('/resources/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

        <!-- Bootstrap Toggle -->
        <script src="{{mix('/resources/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js')}}"></script>

        <!-- jQuery Vector Maps -->
        <script src="{{mix('/resources/js/plugin/jqvmap/jquery.vmap.min.js')}}"></script>
        <script src="{{mix('/resources/js/plugin/jqvmap/maps/jquery.vmap.world.js')}}"></script>

        <!-- Google Maps Plugin -->
        <script src="{{mix('/resources/js/plugin/gmaps/gmaps.js')}}"></script>

        <!-- Dropzone -->
        <script src="{{mix('/resources/js/plugin/dropzone/dropzone.min.js')}}"></script>

        <!-- Fullcalendar -->
        <script src="{{mix('/resources/js/plugin/fullcalendar/fullcalendar.min.js')}}"></script>

        <!-- DateTimePicker -->
        <script src="{{mix('/resources/js/plugin/datepicker/bootstrap-datetimepicker.min.js')}}"></script>

        <!-- Bootstrap Tagsinput -->
        <script src="{{mix('/resources/js/plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>

        <!-- Bootstrap Wizard -->
        <script src="{{mix('/resources/js/plugin/bootstrap-wizard/bootstrapwizard.js')}}"></script>

        <!-- jQuery Validation -->
        <script src="{{mix('/resources/js/plugin/jquery.validate/jquery.validate.min.js')}}"></script>

        <!-- Summernote -->
        <script src="{{mix('/resources/js/plugin/summernote/summernote-bs4.min.js')}}"></script>

        <!-- Select2 -->
        <script src="{{mix('/resources/js/plugin/select2/select2.full.min.js')}}"></script>

        <!-- Sweet Alert -->
        <script src="{{mix('/resources/js/plugin/sweetalert/sweetalert.min.js')}}"></script>

        <!-- Owl Carousel -->
        <script src="{{mix('/resources/js/plugin/owl-carousel/owl.carousel.min.js')}}"></script>

        <!-- Magnific Popup -->
        <script src="{{mix('/resources/js/plugin/jquery.magnific-popup/jquery.magnific-popup.min.js')}}"></script>

        <!-- Atlantis JS -->
        <script src="{{mix('/resources/js/atlantis.min.js')}}"></script> --}}
</html>