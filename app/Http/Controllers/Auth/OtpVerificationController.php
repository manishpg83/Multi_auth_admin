<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;    
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'status' => ['required', 'string', 'max:255'],
            'plan_id' => ['required', 'integer'],
        ]);

        $user = User::find($userId);
        dd($user);
        if ($user && $user->otp == $request->otp && Carbon::parse($user->otp_created_at)->addMinutes(10)->isFuture()) {
            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'password' => Hash::make($request->password),
                'status' => $request->status,
                'plan_id' => $request->plan_id,
                'otp' => null,
                'otp_created_at' => null,
            ]);

            event(new Registered($user));

            Auth::login($user);

            // Add logging to check if it reaches here
            Log::info('User logged in successfully', ['user_id' => $user->id]);

            return redirect()->route('dashboard');
        }

        Log::error('OTP validation failed or expired', ['user_id' => $userId]);

        return back()->withErrors(['otp' => 'The provided OTP is invalid or expired.']);
    }
}
