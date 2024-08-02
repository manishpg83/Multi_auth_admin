<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckProfileCompletion
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if (!$user->first_name || !$user->last_name || !$user->company_name) {
                if ($request->route()->getName() !== 'profile.edit') {
                    return redirect()->route('profile.edit')->with('message', 'Please complete your profile.');
                }
            }
        }

        return $next($request);
    }
}