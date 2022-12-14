<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>WRSOS Volunteers</title>
    <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <!-- Styles -->

        <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
        <link rel="stylesheet" href="{{asset('css/app.css') }}">
        <link rel="stylesheet" href="{{asset('css/jquery-loader.css')}}">
        <link rel="stylesheet" href="{{asset('css/easy-autocomplete.css')}}">
        <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
         <link rel="stylesheet" href="{{asset('css/jquery-ui.structure.css')}}">

        <link rel="stylesheet" href="{{asset('css/fullcalendar.css')}}">
        <link rel="stylesheet" href="{{asset('css/custom-1.3.css')}}">
        <link rel="stylesheet" href="{{asset('css/hopscotch.css')}}">

        @yield('styles')
    <!-- Scripts -->
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
        <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
        <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/additional-methods.min.js"></script> -->
        <script src="{{asset('js/vendors/jquery.js')}}"></script>
        <script src="{{asset('js/vendors/jquery-ui.js')}}"></script>
        <script src="{{asset('js/vendors/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/vendors/moment.min.js')}}"></script>
        <script src="{{asset('js/vendors/jquery-ui-timepicker-addon.js')}}"></script>
        <script src="{{asset('js/vendors/jquery-loader.js')}}"></script>
        <script src="{{asset('js/vendors/jquery-tablesorter.js')}}"></script>
        <script src="{{asset('js/vendors/jquery-easy-autocomplete.js')}}"></script>
        <script defer src="{{asset('js/vendors/fontawesome-all.js')}}"></script>
        <script src="{{asset('js/vendors/fullcalendar.js')}}"></script>
        <script src="{{asset('js/vendors/export_table.js')}}"></script>
        <script src="{{asset('js/vendors/hopscotch.min.js')}}"></script>

    </head>
    <body >
        <div class='app'>
            @include('partials.header')
            <div class='container' style='padding-top:15px'>
                @include('partials.error')
                @yield('content')
            </div>
        </div>

        <!-- <script src="{{asset('js/welcome_tour.js')}}"></script> -->
        @yield('scripts')
    </body>

</html>
