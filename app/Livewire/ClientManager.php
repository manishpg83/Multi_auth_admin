<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Client;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ClientManager extends Component
{
    use WithPagination;

    protected $listeners = ['deleteClient' => 'delete', 'refreshComponent' => '$refresh'];

    public $first_name, $last_name, $email, $company_name, $status;
    public $editingClientId;
    public $isModalOpen = false;
    public $clients;
    public $search = '';
    public $sortField = 'client_id';
    public $sortDirection = 'asc';
    public $selectAll = false;
    public $selectedClients = [];
    public $totalClients = 0;
    public $activeClients = 0;
    public $inactiveClients = 0;
    public $newClientsThisMonth = 0;
    public $statusFilter = '';

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
        $query = User::find(auth()->id())->clients()->withTrashed()->where(function ($query) {
            $query->where('first_name', 'like', '%' . $this->search . '%')
                ->orWhere('last_name', 'like', '%' . $this->search . '%');
        });

        if ($this->statusFilter !== '') {
            $query->where('status', $this->statusFilter);
        }

        $query->orderBy($this->sortField, $this->sortDirection);

        $this->clients = $query->get();

        return view('livewire.client-manager', [
            'clientsPaginated' => $query->paginate(10)
        ]);
    }

    public function updateClientStats()
    {
        $query = Client::query();
        
        if ($this->statusFilter !== '') {
            $query->where('status', $this->statusFilter);
        }

        $this->totalClients = $query->count();
        $this->activeClients = $query->where('status', 'Active')->count();
        $this->inactiveClients = $query->where('status', 'Inactive')->count();
        $this->newClientsThisMonth = $query->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
    }
    public function updatedStatusFilter()
    {
        $this->updateClientStats();
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
        $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'company_name' => 'nullable|string|max:255',
            'status' => 'required|in:Active,Inactive',
        ]);

        // Check if client exists and retrieve it, or create a new one
        $client = Client::firstOrNew(['email' => $this->email]);
        $client->fill([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'company_name' => $this->company_name,
            'status' => $this->status,
        ]);
        $client->save();

        // Attach the client to the user without detaching other users
        $user = User::find(auth()->id());
        $user->clients()->syncWithoutDetaching([$client->client_id => ['is_subscribed' => true]]);

        notyf()->success('Client added successfully.');
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

    public function updatedSelectAll($value)
    {
        $this->selectAllClients();
    }

    public function selectAllClients()
    {
        if ($this->selectAll) {
            $query = Client::query();
            if ($this->statusFilter !== '') {
                $query->where('status', $this->statusFilter);
            }
            $this->selectedClients = $query->pluck('client_id')->map(fn($id) => (string) $id)->toArray();
        } else {
            $this->selectedClients = [];
        }
    }


    public function deleteSelected()
    {
        if (empty($this->selectedClients)) {
            // Show an error message if no clients are selected
            notyf()->info('Please select clients to delete.');
            return;
        }

        $clients = Client::whereIn('client_id', $this->selectedClients)->get();
        foreach ($clients as $client) {
            $client->status = 'Inactive';
            $client->save();
            $client->delete();
        }
        $this->selectedClients = [];
        $this->selectAll = false;
        notyf()->success('Selected clients deleted and set to inactive successfully.');
        $this->dispatch('refreshComponent');
    }

    public function restoreSelected()
    {
        if (empty($this->selectedClients)) {
            notyf()->info('Please select clients to restore.');
            return;
        }

        $clients = Client::withTrashed()->whereIn('client_id', $this->selectedClients)->get();
        foreach ($clients as $client) {
            $client->restore();
        }
        
        $this->selectedClients = [];
        $this->selectAll = false;
        notyf()->success('Selected clients restored successfully.');
        $this->dispatch('refreshComponent');
    }


    public function delete($id)
    {
        $client = Client::find($id);
        if ($client) {
            $client->status = 'Inactive';
            $client->save();
            $client->delete();
            notyf()->success('Client deleted and set to inactive successfully.');
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
            notyf()->success('Client restored successfully (status remains Inactive).');
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

    public function toggleStatusClient($clientId)
    {
        $client = Client::find($clientId);

        if ($client) {
            $client->status = $client->status === 'Active' ? 'Inactive' : 'Active';
            $client->save();
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