<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class ClientManager extends Component
{
    use WithPagination;

    protected $listeners = ['deleteClient' => 'delete', 'refreshComponent' => '$refresh'];

    public $first_name, $last_name, $email, $company_name, $status;
    public $editingClientId;
    public $isModalOpen = false;
    public $search = '';
    public $sortField = 'client_id';
    public $sortDirection = 'asc';

    // Statistics properties
    public $totalClients = 0;
    public $activeClients = 0;
    public $inactiveClients = 0;
    public $newClientsThisMonth = 0;

    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email',
        'company_name' => 'nullable|string|max:255',
        'status' => 'required|in:Active,Inactive',
    ];

    public function mount()
    {
        $this->updateClientStats();
    }

    public function render()
    {
        $this->updateClientStats();

        return view('livewire.client-manager', [
            'clients' => Client::withTrashed()->where(function ($query) {
                $query->where('first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('last_name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10)
        ]);
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

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function store()
    {
        $this->validate();

        Client::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'company_name' => $this->company_name,
            'status' => $this->status,
        ]);

        notyf()->success('Client Created successfully.');
        $this->closeModal();
        $this->resetInputFields();
        $this->updateClientStats();
        $this->dispatch('refreshComponent');
    }

    public function edit($id)
    {
        $client = Client::withTrashed()->findOrFail($id);
        $this->editingClientId = $id;
        $this->first_name = $client->first_name;
        $this->last_name = $client->last_name;
        $this->email = $client->email;
        $this->company_name = $client->company_name;
        $this->status = $client->status;

        $this->openModal();
    }

    public function update()
    {
        $this->validate();

        $client = Client::withTrashed()->find($this->editingClientId);
        $client->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'company_name' => $this->company_name,
            'status' => $this->status,
        ]);

        notyf()->success('Client Updated successfully.');
        $this->closeModal();
        $this->resetInputFields();
        $this->updateClientStats();
        $this->dispatch('refreshComponent');
    }

    public function toggleStatusClient($id)
    {
        $client = Client::withTrashed()->find($id);
        $client->status = $client->status === 'Active' ? 'Inactive' : 'Active';
        $client->save();
        $this->dispatch('refreshComponent');
    }

    public function delete($id)
    {
        $client = Client::find($id);
        if ($client) {
            $client->delete();
            notyf()->success('Client Deleted successfully.');
            $this->dispatch('refreshComponent');
        } else {
            notyf()->error('Client not found.');
        }
    }

    public function restore($id)
    {
        $client = Client::withTrashed()->find($id);
        if ($client) {
            $client->restore();
            notyf()->success('Client Restored successfully.');
            $this->dispatch('refreshComponent');
        } else {
            notyf()->error('Client not found.');
        }
    }

    public function forceDelete($id)
    {
        $client = Client::withTrashed()->find($id);
        if ($client) {
            $client->forceDelete();
            notyf()->success('Client Permanently Deleted.');
            $this->dispatch('refreshComponent');
        } else {
            notyf()->error('Client not found.');
        }
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    private function resetInputFields()
    {
        $this->first_name = '';
        $this->last_name = '';
        $this->email = '';
        $this->status = '';
        $this->company_name = '';
        $this->editingClientId = null;
    }
}
