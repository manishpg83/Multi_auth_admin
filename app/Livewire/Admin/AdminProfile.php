<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AdminProfile extends Component
{
    public $name;
    public $email;

    public function mount()
    {
        $this->name = Auth::guard('admin')->user()->name;
        $this->email = Auth::guard('admin')->user()->email;
    }

    public function updateProfile()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        $admin = Auth::guard('admin')->user();
        $admin->update($validatedData);
        notyf()->success('Profile Updated');
        session()->flash('status', 'profile-updated');
    }

    public function sendVerificationEmail()
    {
        Auth::guard('admin')->user()->sendEmailVerificationNotification();

        session()->flash('status', 'verification-link-sent');
    }

    public function render()
    {
        return view('livewire.admin.admin-profile');
    }
}
