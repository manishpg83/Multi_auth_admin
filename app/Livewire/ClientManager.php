<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Client;
use Livewire\WithPagination;

class ClientManager extends Component
{
    use WithPagination;

    protected $listeners = ['deleteClient' => 'delete', 'refreshComponent' => '$refresh'];

    public $first_name, $last_name, $email, $company_name;
    public $editingClientId;
    public $isModalOpen = false;
    public $search = '';
    public $sortField = 'client_id';
    public $sortDirection = 'asc';

    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email',
        'company_name' => 'nullable|string|max:255',
        'status' => 'required|in:Active,Inactive',
    ];

    public function render()
    {
        return view('livewire.client-manager', [
            'clients' => Client::where(function ($query) {
                $query->where('first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('last_name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10)
        ]);
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
        $this->dispatch('refreshComponent');
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
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

        $client = Client::find($this->editingClientId);
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
        $this->dispatch('refreshComponent');
    }

    public function toggleStatusClient($id)
    {
        $client = Client::find($id);
        $client->status = $client->status === 'Active' ? 'Inactive' : 'Active';
        $client->save();
        $this->dispatch('refreshComponent');
    }

    public function delete($id)
    {
        Client::find($id)->delete();
        notyf()->success('Client Deleted successfully.');
        $this->dispatch('refreshComponent');
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