<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ENGLISH NOW CRUD</title>
    <link href="{{ asset('css/theme/vendors/bootstrap4.min.css') }}" rel="stylesheet">

    <!-- FooTable: For product list page -->
    <link href="{{ asset('css/theme/vendors/footable/footable.core.css') }}" rel="stylesheet">
    <link href="{{ asset('css/theme/fonts/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/theme/vendors/dataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/theme/vendors/datapicker/datepicker3.css') }}" rel="stylesheet">

    @stack('plugin_css')

    <link href="{{ asset('css/theme/vendors/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/theme/vendors/style.css') }}" rel="stylesheet">

    <!-- My css -->
    <link href="{{ asset('css/theme/common.css') }}" rel="stylesheet">
    <link href="{{ asset('css/theme/style.css') }}" rel="stylesheet">

    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">

    @stack('styles')
</head>

<body>

<div id="wrapper">
    <section id="app2">
        xx
    </section>
</div>

{{--@include('layouts.backend.elements._modal')--}}

<!-- Mainly scripts -->
<script src="{{ asset('js/theme/vendors/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('js/theme/vendors/popper.min.js') }}"></script>
<script src="{{ asset('js/theme/vendors/bootstrap4.js') }}"></script>
<script src="{{ asset('js/theme/vendors/loadingoverlay.min.js') }}"></script>
<script src="{{ asset('js/theme/vendors/dataTables/datatables.min.js') }}"></script>
<script src="{{ asset('js/theme/vendors/dataTables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/theme/vendors/datapicker/bootstrap-datepicker.js') }}"></script>

@stack('plugin_js')

<script src="{{ asset('js/theme/common.js') }}"></script>

<!-- For vuejs -->
<script src="{{ asset('js/login.js') }}"></script>

@stack('scripts')

</body>
</html>

