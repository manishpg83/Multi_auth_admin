<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminPasswordUpdate extends Component
{
    public $current_password;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'current_password' => 'required|string',
        'password' => 'required|string|confirmed|min:8',
        'password_confirmation' => 'required_with:password|same:password',
    ];

    public function updatePassword()
    {
        $this->validate();

        $admin = Auth::guard('admin')->user();

        if (!Hash::check($this->current_password, $admin->password)) {
            return $this->addError('current_password', 'Current password is incorrect.');
        }

        $admin->password = Hash::make($this->password);
        $admin->save();
        notyf()->success('Client Uploaded');
        session()->flash('status', 'password-updated');
    }

    public function render()
    {
        return view('livewire.admin.admin-password-update');
    }
}
