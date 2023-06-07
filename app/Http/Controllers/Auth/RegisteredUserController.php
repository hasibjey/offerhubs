<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Helpers\SMS;
use App\Models\User;
use Nette\Utils\Random;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Queue\RedisQueue;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;

class RegisteredUserController extends Controller
{
    protected $user_phone;
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'phone' => ['required', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        $this->generatorOTP($user->phone);
        Session::put('user', $user);
        Session::put('user_phone', $user->phone);
        return redirect()->route('otp');
    }

    public function resendOTP(): View
    {
        return view('auth.otp-resend');
    }

    public function newOTP()
    {
        $phone = Auth::user()->phone;
        $this->generatorOTP($phone);
        session::put('user_phone', $phone);
        session::forget('user');
        return redirect()->route('otp');
    }

    public function generatorOTP($phone)
    {
        $otp = mt_rand(1000, 9999);

        User::where('phone', $phone)->update([
            'otp' => $otp
        ]);
        $message = "Welcome to Tara Hura Life. Your registration verify code is " . $otp;
        SMS::SMS_API($phone, $message);
    }

    public function OTP()
    {
        return view('auth.otp-verify');
    }

    public function verifyOTP(Request $request)
    {
        if (Session::exists('user')) {
            $phone = Session::pull('user.phone');
            $user = Session::pull('user');

            if (User::where('phone', $phone)->where('otp', $request->otp)->exists()) {
                User::where('phone', $phone)->first()->update([
                    'email_verified_at' => Carbon::now()
                ]);
                User::where('phone', $phone)->first()->update([
                    'otp' => NULL
                ]);

                Auth::login($user);
                Session::forget('user');

                return redirect(RouteServiceProvider::HOME);
            }
        } else if (Session::exists('user_phone')) {
            $phone = Session::pull('user_phone');
            User::where('phone', $phone)->first()->update([
                'email_verified_at' => Carbon::now()
            ]);
            User::where('phone', $phone)->first()->update([
                'otp' => NULL
            ]);

            return redirect()->route('dashboard');
        } else {
            return redirect()->route('welcome');
        }
    }
}
