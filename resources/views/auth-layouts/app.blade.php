<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{dirs()}}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ !empty($title)? $title:' '}} - {{ trans('admin.adminpanel') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:500,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/stylesheets/vendor/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/Font-Awesome/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/stylesheets/vendor/bootstrapltr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/stylesheets/main-ltr.css') }}">

    <!-- For Arabic Language -->
    <!-- <link rel="stylesheet" href="stylesheets/vendor/bootstrapRTL.min.css">
        <link rel="stylesheet" href="stylesheets/main-rtl.scss"> -->


</head>

<body>

    @yield('content')


    <!-- Start Global Script -->
        <script src="{{ asset('assets/scripts/vendor/jquery-3.4.1.min.js') }}"></script>
        <script src="{{ asset('assets/scripts/vendor/popper.min.js') }}"></script>
        <script src="{{ asset('assets/scripts/vendor/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/scripts/vendor/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('assets/Font-Awesome/all.min.js') }}"></script>
    <!-- End Global Script -->
    <!-- Start Custem Pages Script -->
    <script src="{{ asset('assets/scripts/modules/login-page/login-page.js') }}"></script>
    <!-- End Custem Pages Script -->
</body>

</html>
