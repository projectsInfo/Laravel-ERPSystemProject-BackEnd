<!DOCTYPE html>
<html lang="{{ lang()}}" dir="{{dirs()}}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ !empty($title)? $title:' '}} - {{ trans('admin.adminpanel') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:500,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/stylesheets/vendor/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/Font-Awesome/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/stylesheets/vendor/bootstrap'.dirs().'.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css">
    @yield('styles')
    <link rel="stylesheet" href="{{ asset('assets/stylesheets/main-'.dirs().'.css') }}">

    <!-- For Arabic Language -->
    <!-- <link rel="stylesheet" href="stylesheets/vendor/bootstrapRTL.min.css">
        <link rel="stylesheet" href="stylesheets/main-rtl.scss"> -->


</head>

<body>
<div class="back-loader">
    <div class="loader">
        <div class="spinner spinner__1"></div>
    </div>
</div>
<div class="sidebar-overlay"></div>

    <section class="wrapper">
            <!-- sidebar -->
            <nav class="sidebar pb-5">

                <!-- Sidebar header (logo and comp name -->
                <div class="sidebar-header">
                    <div class="container">
                        <div class="row position-relative">
                            <div class="col-sm-12 logo d-flex justify-content-center">
                                <img class="img-fluid" src="{{ asset('assets/imgs/logo.png') }}" alt="logo">
                            </div>
                            <div class="col-sm-12 logo-text justify-content-center">
                                <h3 class="display-1">Achilles Shoes</h3>
                            </div>
                            <span class="close-sidebar"><i class="fa fa-times"></i></span>
                        </div>
                    </div>
                </div>
@include('layouts.navbar')
