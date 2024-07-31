<?php

namespace App\Livewire;

use App\Models\Client;
use Livewire\Component;
use App\Models\EmailTracking;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public $clients;
    public $emailsSent;
    public $emailsOpened;

    public function mount()
    {
        $this->updateStats();
    }

    public function updateStats()
    {
        $user = Auth::user();
        $this->clients = Client::where('client_id', $user->user_id)->count();
        $this->emailsSent = EmailTracking::where('user_id', $user->user_id)->count();
        $this->emailsOpened = EmailTracking::where('user_id', $user->user_id)->where('opened', true)->count();
    }

    public function render()
    {
        $this->updateStats();  // Refresh stats on each render
        return view('livewire.dashboard');
    }
}