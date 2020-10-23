@extends('auth-layouts.app')

@section('content')

<main class="login-page">
    <div class="container-fluid">
        <div class="row align-items-center">
            <!-- Logo -->
            <div class="col-12 col-lg-6 pb-lg-5 pb-0">
                <div class="text-center logo-login">
                    <img class="img-fluid" src="{{ asset('assets/imgs/logo2.png') }}" alt="logo">
                </div>
            </div>
            <!-- Login Form -->
            <div class="col-12 col-lg-6 ">
                <form method="POST" class="login-form" action="{{ route('login') }}">
                    @csrf
                    <h1 class="text-center form-heading mb-5">Login</h1>
                    <h3 class="text-center sub-heading text-left">Welcome back</h3>

                    <div class="form-group validation-message">
                        <i class="fa fa-user icon"></i>
                        <input name="email" id="email" class="form-control" type="text"
                            autocomplete="email" placeholder="UserName" minlength="2" required>
                    </div>

                    <div class="form-group validation-message">
                        <i class="fa fa-lock icon"></i>
                        
                        <input name="password" id="password" class="form-control" type="password"
                            placeholder="Password" required>
                            <button type="button" class="show-pass"><i class="fas fa-eye-slash"></i></button>
                            @error('email')
                                <br>
                                <label id="email-error" class="error" for="email">{{ $message }}.</label>
                            @enderror
                            @error('password')
                                <label id="password-error" class="error" for="password">{{ $message }}.</label>
                            @enderror
                    </div>
                    <div class="form-group form-check text-left remember-checkbox">
                        <input type="checkbox" name="checkbox" class="form-check-input" name="remember" id="remMe">
                        <label class="form-check-label" for="remMe">Remember Me</label>
                    </div>
                    <button type="submit" class="btn btn-lg form-btn d-block" id="log">Login</button>
                </form>
            </div>
        </div>
    </div>
    <div class="login-bg"></div>
    {{-- <img class="wavy-shape" src="{{ asset('assets/imgs/wavy.png') }}" alt="wavy-shape"> --}}
</main>


@endsection
