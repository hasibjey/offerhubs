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
                                <h3 class="login__login">রেজিস্টার</h3>
                            </div>
                            <div class="login__content">
                                <form action="{{ route('register') }}" method="post">
                                    @csrf
                                    <div class="form-group--block mb-3">
                                        <input class="form-control" type="text" placeholder="User Full Name"
                                            value="{{ old('name') }}" name="name" required autofocu>
                                        @error('name')
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="form-group--block mb-3">
                                        <input class="form-control" type="email" placeholder="Email Address"
                                            value="{{ old('email') }}" name="email" required>
                                        @error('email')
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="form-group--block mb-3">
                                        <input class="form-control" type="text" placeholder="Phone Number" name="phone"
                                            value="{{ old('phone') }}" required>
                                        @error('phone')
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="form-group--block mb-3 group-password">
                                        <input class="form-control" type="password" placeholder="Password" name="password">
                                        @error('password')
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="form-group--block mb-3 group-password">
                                        <input class="form-control" type="password" placeholder="Confirm Password"
                                            name="password_confirmation">
                                        @error('password')
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                    <button class="btn btn-login" type="submit">রেজিস্টার</button>
                                </form>
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
