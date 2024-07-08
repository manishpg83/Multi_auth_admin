<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Carbon\Carbon;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    { 
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        // Generate an OTP
        $otp = rand(100000, 999999);

        $user = User::create([
            'email' => $request->email,
            'otp' => $otp,
            'password' => Hash::make($otp),
            'otp_created_at' => Carbon::now(),
        ]);

        // Send OTP to user (placeholder, implement actual OTP sending logic)
        // Mail::to($user->email)->send(new OtpMail($otp));

        return redirect()->route('otp.verify', ['user' => $user->user_id]);
    }

}
