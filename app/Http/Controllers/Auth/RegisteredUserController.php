<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\OtpEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
        'email' => ['required', 'string', 'email', 'max:255'],
    ]);

    // Check if the user already exists
    $user = User::where('email', $request->email)->first();

    if ($user) {
        // User already exists, generate a new OTP and send it to the user
        $otp = rand(100000, 999999);
        $user->otp = $otp;
        $user->otp_created_at = Carbon::now();
        $user->save();

        Mail::to($user->email)->send(new OtpEmail($otp));

        return redirect()->route('otp.verify', ['user' => $user->user_id]);
    } else {
        // Generate an OTP
        $otp = rand(100000, 999999);

        $user = User::create([
            'email' => $request->email,
            'otp' => $otp,
            'password' => Hash::make($otp), 
            'otp_created_at' => Carbon::now(),
        ]);

        // Send OTP to user
        Mail::to($user->email)->send(new OtpEmail($otp));

        return redirect()->route('otp.verify', ['user' => $user->user_id]);
    }
}
}
