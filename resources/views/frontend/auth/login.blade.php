@extends('layouts.front_app')

@section('title')
Login | wabegadgets | Surgical Instruments & Medical Supplies
@endsection

@section('meta_title', 'Our Products · Surgical Instruments & Medical Supplies in Nairobi Kenya.')      

@section('content')
<main>
    <!-- breadcrumb area start -->
    <section class="breadcrumb__area include-bg text-center pt-95 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="breadcrumb__content p-relative z-index-1">
                        <h3 class="breadcrumb__title">My account</h3>
                        <div class="breadcrumb__list">
                            <span><a href="#">Home</a></span>
                            <span>My account</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb area end -->

    <!-- login area start -->
    <section class="tp-login-area pb-140 p-relative z-index-1 fix">
        <div class="tp-login-shape">
            <img class="tp-login-shape-1" src="assets/img/login/login-shape-1.png" alt="">
            <img class="tp-login-shape-2" src="assets/img/login/login-shape-2.png" alt="">
            <img class="tp-login-shape-3" src="assets/img/login/login-shape-3.png" alt="">
            <img class="tp-login-shape-4" src="assets/img/login/login-shape-4.png" alt="">
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                    <div class="tp-login-wrapper">
                        <div class="tp-login-top text-center mb-30">
                            <h3 class="tp-login-title">Login to wabegadgets.</h3>
                            <p>Don’t have an account? <span><a href="{{route('client.register')}}">Create a free account</a></span></p>
                        </div>
                        <div class="tp-login-option">
                            <div class="tp-login-social mb-10 d-flex flex-wrap align-items-center justify-content-center">
                                <!-- Social login options here -->
                            </div>

                            <div id="error-messages" class="text-danger">
                                <!-- Laravel validation errors -->
                                @if ($errors->any())
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <div class="tp-login-mail text-center mb-40">
                                <p>or Sign in with <a href="#">Email</a></p>
                            </div>

                            <form id="login-form" method="POST" action="{{ route('client.login.post') }}">
                                @csrf
                                <div class="tp-login-input-wrapper">
                                    <div class="tp-login-input-box">
                                        <div class="tp-login-input">
                                            <input id="email" name="email" type="email" placeholder="Enter your email">
                                        </div>
                                        <div class="tp-login-input-title">
                                            <label for="email">Your Email</label>
                                        </div>
                                    </div>
                                    <div class="tp-login-input-box">
                                        <div class="tp-login-input">
                                            <input id="password" name="password" type="password" placeholder="Enter your password">
                                        </div>
                                        <div class="tp-login-input-title">
                                            <label for="password">Password</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="tp-login-suggetions d-sm-flex align-items-center justify-content-between mb-20">
                                    <!-- You can add remember me option here if needed -->
                                    <div class="tp-login-forgot">
                                        <a href="forgot.html">Forgot Password?</a>
                                    </div>
                                </div>
                                <div class="tp-login-bottom">
                                    <button type="submit" class="tp-login-btn w-100">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- login area end -->
</main>
@endsection
