<?php

// app/Http/Controllers/Auth/LoginController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email not found']);
        }

        // Generate OTP and send it to the user's email
        $otp = rand(100000, 999999);
        $user->otp = $otp;
        $user->save();

        // Send OTP to user's email
        // (use your preferred method to send email)

        return redirect()->route('verifyOtp')->with(['email' => $user->email]);
    }

    public function showVerifyOtpForm(Request $request)
    {
        return view('auth.verify-otp')->with(['email' => $request->session()->get('email')]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|integer',
        ]);

        $user = User::where('email', $request->email)->where('otp', $request->otp)->first();

        if (!$user) {
            return back()->withErrors(['otp' => 'Invalid OTP']);
        }

        // Login the user
        Auth::login($user);

        return redirect()->route('profile.edit');
    }
}
