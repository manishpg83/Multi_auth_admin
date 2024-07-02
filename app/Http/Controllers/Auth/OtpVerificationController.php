<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Carbon\Carbon;

class OtpVerificationController extends Controller
{
    /**
     * Display the OTP verification view.
     */
    public function create($userId): View
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

        // Find the user by ID
        $user = User::find($userId);

        // Validate OTP and expiration
        if ($user && $user->otp == $request->otp && Carbon::parse($user->otp_created_at)->addMinutes(10)->isFuture()) {
            // Clear OTP fields
            $user->update([
                'otp' => null,
                'otp_created_at' => null,
            ]);

            // Log in the user
            Auth::login($user);

            // Redirect to the profile completion form
            return redirect()->route('profile.complete');
        }

        // Redirect back with error if OTP is invalid or expired
        return back()->withErrors(['otp' => 'The provided OTP is invalid or expired.']);
    }
}
