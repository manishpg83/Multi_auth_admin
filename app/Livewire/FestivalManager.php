<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Admin;
use Livewire\Component;
use App\Models\Festival;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewFestivalForApproval;

class FestivalManager extends Component
{
    use WithPagination;

    protected $listeners = ['deleteFestival' => 'delete', 'refreshComponent' => '$refresh'];

    public $name, $date, $status, $email_scheduled, $subject_line, $email_body;
    public $editingFestivalId;
    public $isModalOpen = false;
    public $search = '';
    public $sortField = 'festival_id';
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
        $isAdmin = $this->isAdmin();

        $festivalsQuery = Festival::withTrashed()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('subject_line', 'like', '%' . $this->search . '%');
            })
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            });

        if (!$isAdmin) {
            $festivalsQuery->where('approved', true);
        }

        $festivals = $festivalsQuery->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.festival-manager', [
            'festivals' => $festivals,
            'isAdmin' => $isAdmin,
        ]);
    }

    public function restore($id)
    {
        $festival = Festival::withTrashed()->findOrFail($id);
        $festival->restore();
        notyf()->success('Festival restored successfully.');
        $this->dispatch('refreshComponent');
    }

    public function forceDelete($id)
    {
        $festival = Festival::withTrashed()->findOrFail($id);
        $festival->forceDelete();
        notyf()->success('Festival permanently deleted.');
        $this->dispatch('refreshComponent');
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

    private function isAdmin()
    {
        if (Auth::guard('web')->check()) {
            return false; // Regular users are not admins
        } elseif (Auth::guard('admin')->check()) {
            return true; // All authenticated admins are considered admins
        }
        return false; // Default case
    }


    public function store()
    {
        $this->validate();

        $isAdmin = $this->isAdmin();

        $festival = Festival::create([
            'name' => $this->name,
            'date' => $this->date,
            'status' => $isAdmin ? $this->status : 'Inactive',
            'email_scheduled' => $this->email_scheduled,
            'subject_line' => $this->subject_line,
            'email_body' => $this->email_body,
            'approved' => $isAdmin,
            'submitted_by' => Auth::id(),
        ]);

        if (!$isAdmin) {
            // Send notification to admin
            Admin::all()->each(function ($admin) use ($festival) {
                $admin->notify(new NewFestivalForApproval($festival));
            });
            notyf()->success('Festival submitted for approval.');
        } else {
            notyf()->success('Festival created successfully.');
        }

        $this->closeModal();
        $this->resetInputFields();
        $this->dispatch('refreshComponent');
    }

    public function approveFestival($id)
    {
        if ($this->isAdmin()) {
            $festival = Festival::findOrFail($id);
            $festival->update([
                'approved' => true,
                'status' => 'Active'
            ]);
            notyf()->success('Festival approved successfully.');
        }
    }

    public function rejectFestival($id)
    {
        if ($this->isAdmin()) {
            $festival = Festival::findOrFail($id);
            $festival->delete();
            notyf()->success('Festival rejected and deleted.');
        }
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

        notyf()->success('Festival updated successfully.');
        $this->closeModal();
        $this->resetInputFields();
        $this->dispatch('refreshComponent');
    }

    public function delete($id)
    {
        $festival = Festival::findOrFail($id);
        $festival->delete();
        notyf()->success('Festival deleted successfully.');
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