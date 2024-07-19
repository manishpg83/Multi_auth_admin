<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Festival;
use Livewire\WithPagination;

class FestivalManager extends Component
{
    use WithPagination;

    protected $listeners = ['deleteFestival' => 'delete', 'refreshComponent' => '$refresh'];

    public $name, $date, $status, $email_scheduled, $subject_line, $email_body;
    public $editingFestivalId;
    public $isModalOpen = false;
    public $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $statusFilter = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'date' => 'required|date',
        'status' => 'required|in:Active,Inactive',
        'email_scheduled' => 'nullable|in:Yes,No',
        'subject_line' => 'nullable|string|max:255',
        'email_body' => 'nullable|string',
    ];

    public function render()
    {
        return view('livewire.festival-manager', [
            'festivals' => Festival::where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('subject_line', 'like', '%' . $this->search . '%');
            })
                ->when($this->statusFilter, function ($query) {
                    $query->where('status', $this->statusFilter);
                })
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10)
        ]);
    }
    public function updatedStatusFilter($value)
    {
        dd($value); // Check if this is fired and shows the correct value
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

        Festival::create([
            'name' => $this->name,
            'date' => $this->date,
            'status' => $this->status,
            'email_scheduled' => $this->email_scheduled,
            'subject_line' => $this->subject_line,
            'email_body' => $this->email_body,
        ]);

        session()->flash('message', 'Festival created successfully.');
        $this->closeModal();
        $this->resetInputFields();
        $this->dispatch('refreshComponent');
    }

    public function edit($id)
    {
        $festival = Festival::findOrFail($id);
        $this->editingFestivalId = $id;
        $this->name = $festival->name;
        $this->date = $festival->date;
        $this->status = $festival->status;
        $this->email_scheduled = $festival->email_scheduled;
        $this->subject_line = $festival->subject_line;
        $this->email_body = $festival->email_body;

        $this->openModal();
    }

    public function update()
    {
        $this->validate();

        $festival = Festival::find($this->editingFestivalId);
        $festival->update([
            'name' => $this->name,
            'date' => $this->date,
            'status' => $this->status,
            'email_scheduled' => $this->email_scheduled,
            'subject_line' => $this->subject_line,
            'email_body' => $this->email_body,
        ]);

        session()->flash('message', 'Festival updated successfully.');
        $this->closeModal();
        $this->resetInputFields();
        $this->dispatch('refreshComponent');
    }

    public function delete($id)
    {
        Festival::find($id)->delete();
        session()->flash('message', 'Festival deleted successfully.');
        $this->dispatch('refreshComponent');
    }

    public function toggleStatus($id)
    {
        $festival = Festival::find($id);
        $festival->status = $festival->status === 'Active' ? 'Inactive' : 'Active';
        $festival->save();
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
        $this->name = '';
        $this->date = '';
        $this->status = '';
        $this->email_scheduled = '';
        $this->subject_line = '';
        $this->email_body = '';
        $this->editingFestivalId = null;
    }
}
