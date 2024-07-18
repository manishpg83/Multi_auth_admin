<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

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
    public function updateNames(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->company_name = $request->company_name;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully',
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'company_name' => $user->company_name,
        ]);
    }



    public function updateDetails(Request $request)
    {
        // Validation
        $validatedData = $request->validate([
            'phone' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file
            'address' => 'nullable|string|max:255',
            'telegram' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
            'skype' => 'nullable|string|max:255',
            'imo' => 'nullable|string|max:255',
            'active_social' => 'nullable|string|max:255',
        ]);

        // Process updating the user details here
        // Example:
        $user = auth()->user();
        $user->phone = $request->phone;
        $user->designation = $request->designation;
        $user->website = $request->website;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $path = $file->store('logos', 'public');
            $user->logo = $path;
        }
        $user->address = $request->address;
        $user->telegram = $request->telegram;
        $user->whatsapp = $request->whatsapp;
        $user->skype = $request->skype;
        $user->imo = $request->imo;
        $user->active_social = $request->active_social;

        $user->save();

        return redirect()->back()->with('status', 'details-updated');
    }

    public function upload()
    {
        $this->validate();

        try {
            $client = Client::create([
                'user_id' => Auth::id(),
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'company_name' => $this->company_name,
            ]);

            if ($client) {
                $this->reset(['first_name', 'last_name', 'email', 'company_name']);
                session()->flash('message', 'Client uploaded successfully.');
            } else {
                session()->flash('error', 'Failed to create client.');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Error: ' . $e->getMessage());
        }
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