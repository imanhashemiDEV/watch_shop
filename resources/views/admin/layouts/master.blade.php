<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>پنل مدیریت</title>
    <link rel="shortcut icon" href="{{url('panel/assets/media/image/favicon.png')}}">
    <meta name="theme-color" content="#5867dd">
    <link rel="stylesheet" href="{{url('panel/vendors/bundle.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('panel/vendors/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{url('panel/plugins/sweet_alert/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{url('panel/plugins/dropzone/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{url('/css/kamadatepicker.min.css')}}">
    <link rel="stylesheet" href="{{ url('panel/vendors/colorpicker/css/bootstrap-colorpicker.min.css') }}"
        type="text/css">
    <link rel="stylesheet" href="{{url('panel/assets/css/app.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('css/custom.css')}}" type="text/css">
    @livewireStyles
</head>

<body>
    @include('admin.partials.navigations')
    @yield('content')
    <!-- begin::global scripts -->
    <script src="{{url('panel/vendors/bundle.js')}}"></script>
    <script src="{{url('panel/vendors/select2/select2.full.min.js')}}"></script>
    <script src="{{url('panel/plugins/sweet_alert/sweetalert2.all.min.js')}}"></script>
    <script src="{{url('panel/plugins/dropzone/js/dropzone.js')}}"></script>
    <script src="{{url('panel/assets/js/custom.js')}}"></script>
    <script src="{{url('panel/assets/js/app.js')}}"></script>
    <script src="{{url('panel/vendors/ckeditor/ckeditor.js')}}"></script>
    <script src="{{url('js/kamadatepicker.min.js')}}"></script>
    <script src="{{url('js/kamadatepicker.holidays.js')}}"></script>
    <script src="{{ url('panel/vendors/colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ url('panel/assets/js/examples/colorpicker.js') }}"></script>
    <script src="{{url('js/custom.js')}}"></script>
    @livewireScripts
    <script>
        $('select').select2({
        dir: "rtl",
        dropdownAutoWidth: true,
        dropdownParent: $('#parent')
    });

    </script>
    @yield('scripts')
</body>

</html>
