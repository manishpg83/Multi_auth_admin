<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Admin;
use App\Models\Festival;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\FestivalNotification;
use App\Models\Client;
use App\Notifications\FestivalApproved;
use App\Notifications\NewFestivalForApproval;

class FestivalManager extends Component
{
    use WithPagination;

    protected $listeners = [
        'deleteFestival' => 'delete',
        'refreshComponent' => '$refresh'
    ];

    public $search = '';
    public $statusFilter = '';
    public $selectAll = false;
    public $selectedFestivalIds = [];
    public $selectedFestivalId = '';
    public $isLoading = false;
    public $isModalOpen = false;
    public $sortDirection = 'asc';
    public $sortField = 'festival_id';
    public $editingFestivalId;
    public $name, $date, $status, $subject_line, $email_body, $email_scheduled;

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
            'isLoading' => $this->isLoading,
        ]);
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectAllFestivals();
        } else {
            $this->selectedFestivalIds = [];
        }
    }

    public function selectAllFestivals()
    {
        $this->selectedFestivalIds = Festival::pluck('festival_id')->map(fn($id) => (string) $id)->toArray();
    }

    public function updatedSelectedFestivalIds()
    {
        $this->selectAll = count($this->selectedFestivalIds) === Festival::count();
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
        return Auth::guard('admin')->check();
    }

    public function store()
    {
        $this->validate();

        $isAdmin = $this->isAdmin();
        $userId = Auth::id();

        $festival = Festival::create([
            'name' => $this->name,
            'date' => $this->date,
            'status' => $isAdmin ? $this->status : 'Inactive',
            'email_scheduled' => $this->email_scheduled,
            'subject_line' => $this->subject_line,
            'email_body' => $this->email_body,
            'approved' => $isAdmin,
            'submitted_by' => $userId,
            'user_id' => $userId,
        ]);

        if (!$isAdmin) {
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

            $user = User::find($festival->user_id);
            if ($user) {
                try {
                    $user->notify(new FestivalApproved($festival));
                    notyf()->success('Festival approved successfully and notification sent to the user.');
                } catch (\Exception $e) {
                    notyf()->error('Festival approved but failed to send notification: ' . $e->getMessage());
                }
            } else {
                notyf()->warning('Festival approved but user not found for notification.');
            }
        }
    }

    public function selectFestivalForEmail($festivalId)
    {
        if (in_array($festivalId, $this->selectedFestivalIds)) {
            $this->selectedFestivalIds = array_diff($this->selectedFestivalIds, [$festivalId]);
        } else {
            $this->selectedFestivalIds[] = $festivalId;
        }
    }

    public function sendSelectedFestivalsEmail()
    {
        if (empty($this->selectedFestivalIds)) {
            $this->addError('email', 'No festivals selected for email.');
            return;
        }

        $festivals = Festival::whereIn('festival_id', $this->selectedFestivalIds)
            ->where('status', 'Active')
            ->get();

        if ($festivals->isEmpty()) {
            $this->addError('email', 'No active festivals selected for email.');
            return;
        }

        $clients = Client::where('status', 'Active')->get();

        if ($clients->isEmpty()) {
            $this->addError('email', 'No active clients found.');
            return;
        }

        foreach ($clients as $client) {
            foreach ($festivals as $festival) {
                try {
                    Mail::to($client->email)->send(new FestivalNotification($festival));
                } catch (\Exception $e) {
                    $this->addError('email', 'Failed to send email to ' . $client->email . ': ' . $e->getMessage());
                }
            }
        }

        $this->selectedFestivalIds = []; // Reset the selection
        notyf()->success('Festival emails sent successfully for active festivals.');
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
