<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;

class ViewUserDetails extends Component
{
    public $userId;
    public $user;

    public function mount($userId)
    {
        $this->userId = $userId;
        $this->user = User::findOrFail($userId);
    }

    public function render()
    {
        return view('livewire.admin.view-user-details');
    }
}