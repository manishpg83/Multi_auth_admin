<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Update user's profile fields
        $user->fill($request->validated());

        // Check if email address has changed and reset email verification
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'Profile updated successfully.');
    }

    public function updateNames(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file
            'website' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'skype' => 'nullable|string|max:255',
            'telegram' => 'nullable|string|max:255',
            'imo' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
            'active_social' => 'nullable|string|in:skype,telegram,imo,whatsapp',

        ]);

        $user = Auth::user();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->company_name = $request->company_name;
        $user->designation = $request->designation;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $path = $file->store('logos', 'public');
            $user->logo = $path;
        }
        $user->website = $request->website;
        $user->address = $request->address;
        $user->skype = $request->skype;
        $user->telegram = $request->telegram;
        $user->imo = $request->imo;
        $user->whatsapp = $request->whatsapp;
        $user->active_social = $request->active_social;


        $user->save();

        return Redirect::back()->with('status', 'names-updated');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => 'required',
        ]);

        $user = $request->user();

        // Check if the provided password matches the user's password
        if (!Auth::attempt(['email' => $user->email, 'password' => $request->password])) {
            return Redirect::back()->withErrors(['password' => 'Incorrect password.']);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('status', 'Your account has been deleted.');
    }
}
