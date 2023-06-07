@extends('layouts.app')
@section('title', 'যাচাইকরণ - ')

@section('content')
    <main class="no-main">
        <section class="section--login">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6 offset-lg-3">
                        <div class="login__box">
                            <div class="login__content">
                                <div class="login__label">রেজিস্ট্রেশনের সময় আপনার দেওয়া ফোন নম্বরে একটি নতুন যাচাইকরণ OTP কোড পাঠানো হয়েছে।</div>
                                <form action="{{ route('verifyOTP') }}" method="post">
                                    @csrf
                                    <div class="form-group--block mb-3">
                                        <input class="form-control" type="text" placeholder="Verify Code"
                                            value="{{ old('login') }}" name="otp" required autofocu>
                                    </div>
                                    <button class="btn btn-login" type="submit">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
