@extends('layouts.app')
@section('title', 'আমার অ্যাকাউন্ট - ')

@section('content')
    <main class="no-main">
        <section class="section--login">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="login__box">
                            <div class="login__header">
                                <h3 class="login__login">লগইন</h3>
                            </div>
                            <div class="login__content">
                                <div class="login__label">আপনার অ্যাকাউন্টে লগ ইন করুন।</div>
                                <form action="{{ route('login') }}" method="post">
                                    @csrf
                                    <div class="form-group--block mb-3">
                                        <input class="form-control" type="text" placeholder="Email / Phone Number"
                                            value="{{ old('login') }}" name="login" required autofocu>
                                        @error('login')
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="input-group form-group--block mb-3 group-password">
                                        <input class="form-control" type="password" placeholder="Password" name="password">
                                        <div class="input-group-append">
                                            <button class="btn forgot-pass" type="button">Forgot?</button>
                                        </div>
                                        @error('password')
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="input-group form-check">
                                        <input class="form-check-input" type="checkbox" name="remember">
                                        <label class="form-check-label">Remember me</label>
                                    </div>
                                    <button class="btn btn-login" type="submit">Login</button>
                                </form>
                                <div class="login__conect">
                                    <hr>
                                    <p>Or login with</p>
                                    <hr>
                                </div>
                                <button class="btn btn-social btn-facebook"> <i class="fa fa-facebook-f"></i>Login with
                                    Facebook</button>
                                <button class="btn btn-social btn-google"> <i class="fa fa-google-plus"></i>Login with
                                    Google</button>
                                <a href="{{ route('register') }}" class="btn btn-social btn-facebook"> <i
                                        class="fa-solid fa-envelope"></i>Login with
                                    Email</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <h3 class="login__title">Advantages Of Becoming A Member</h3>
                        <p class="login__description"> <b>Famart Buyer Protection </b>has you covered from click to
                            delivery.<br>Sign up or sign in and you will be able to: </p>
                        <div class="login__orther">
                            <p> <i class="icon-truck"></i>Easily Track Orders, Hassle free Returns</p>
                            <p> <i class="icon-alarm2"></i>Get Relevant Alerts and Recommendation</p>
                            <p><i class="icon-star"></i>Wishlist, Reviews, Ratings and more.</p>
                        </div>
                        <div class="login__vourcher">
                            <div class="vourcher-money"><span class="unit">$</span><span class="number">25</span></div>
                            <div class="vourcher-content">
                                <h4 class="vourcher-title">GIFT VOURCHER FOR FISRT PURCHASE</h4>
                                <p>We give $25 as a small gift for your first purchase.<br>Welcome to Farmart Market!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
