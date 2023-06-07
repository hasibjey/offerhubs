<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserDashboardController extends Controller
{
    public function index(Request $request)
    {
        if(User::where('phone', Auth::user()->phone)->exists() &&
            User::where('phone', Auth::user()->phone)->where('email_verified_at',  null)->first())
        {
            return redirect()->route('resendOTP');
        }
        else 
        {
            return view('dashboard');
        }
    }
}
