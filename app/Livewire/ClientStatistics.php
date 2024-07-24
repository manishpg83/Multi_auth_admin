<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Client;
use Carbon\Carbon;

class ClientStatistics extends Component
{
    public $totalClients = 0;
    public $activeClients = 0;
    public $inactiveClients = 0;
    public $newClientsThisMonth = 0;

    public function mount()
    {
        $this->updateClientStats();
    }

    public function render()
    {
        return view('livewire.client-statistics');
    }

    public function updateClientStats()
    {
        $this->totalClients = Client::count();
        $this->activeClients = Client::where('status', 'Active')->count();
        $this->inactiveClients = Client::where('status', 'Inactive')->count();
        $this->newClientsThisMonth = Client::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
    }
}