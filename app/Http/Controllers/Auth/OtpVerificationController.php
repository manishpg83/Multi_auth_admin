<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Carbon\Carbon;
use App\Mail\OtpEmail;
use Illuminate\Support\Facades\Mail;

class OtpVerificationController extends Controller
{
    /**
     * Send OTP to the user's email.
     */
    public function sendOtp(User $user)
    {
         // Generate OTP
         $otp = rand(100000, 999999);
 
         // Store OTP in the database
         $user->update([
             'otp' => $otp,
             'otp_created_at' => now(),
         ]);
 
         // Send OTP email
         Mail::to($user->email)->send(new OtpEmail($otp));
    }

    /**
     * Display the OTP verification view.
     */
    public function create($userId)
    {
        return view('auth.verify-otp', ['userId' => $userId]);
    }

    /**
     * Handle OTP verification and complete user registration.
     */
    public function store(Request $request, $userId)
    {
        $request->validate([
            'otp' => ['required', 'integer'],
        ]);

        // Find the user by ID or throw an exception if not found
        $user = User::findOrFail($userId);

        // Validate OTP and expiration
        if ($user->otp != $request->otp || ! Carbon::parse($user->otp_created_at)->addMinutes(10)->isFuture()) {
            throw ValidationException::withMessages(['otp' => 'The provided OTP is invalid or expired.']);
        }

        // Update user's information and clear OTP fields
        $user->update([       
            'otp' => null,
            'otp_created_at' => null,
        ]);

        // Dispatch the Registered event (if needed)
        // event(new Registered($user));

        // Log in the user
        Auth::login($user);
       
        // Redirect to the dashboard or another appropriate route
        return redirect()->route('dashboard');
    }
}

