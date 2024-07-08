<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Send OTP to the user's email.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email not found']);
        }

        // Generate OTP and save it to the user's record
        $otp = rand(100000, 999999);
        $user->otp = $otp;
        $user->save();

        // Send OTP to user's email (you need to implement this part)

        // Redirect to OTP verification form
        return redirect()->route('verifyOtp')->with(['email' => $user->email]);
    }

    /**
     * Show OTP verification form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function showVerifyOtpForm(Request $request)
    {
        return view('auth.verify-otp')->with(['email' => $request->session()->get('email')]);
    }

    /**
     * Verify OTP and login the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

        // Clear OTP from user's record after successful verification
        $user->otp = null;
        $user->save();

        // Login the user
        Auth::login($user);

        // Redirect to the desired location after login
        return redirect()->route('profile.edit');
    }
}
