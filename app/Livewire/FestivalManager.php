<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\Client;
use Livewire\Component;
use App\Models\Festival;
use App\Models\EmailTask;
use Livewire\WithPagination;
use App\Mail\FestivalNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
            });

        if ($this->statusFilter !== '') {
            $festivalsQuery->where('status', $this->statusFilter);
        }

        if (!$isAdmin) {
            $festivalsQuery->where('approved', true);
        }

        $festivals = $festivalsQuery->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        $this->updateFestivalStats();

        return view('livewire.festival-manager', [
            'festivals' => $festivals,
            'isAdmin' => $isAdmin,
            'isLoading' => $this->isLoading,
        ]);
    }

    public function updateFestivalStats()
    {
        $query = Festival::query();
        
        if ($this->statusFilter !== '') {
            $query->where('status', $this->statusFilter);
        }
    }

    public function updatedStatusFilter()
    {
        $this->resetPage();
        $this->updateFestivalStats();
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
        $this->updateFestivalStats();
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
            notyf()->info('No festivals selected for email.');
            return;
        }

        $festivals = Festival::whereIn('festival_id', $this->selectedFestivalIds)
            ->where('status', 'Active')
            ->get();

        if ($festivals->isEmpty()) {
            notyf()->info('No active festivals selected for email.');
            return;
        }

        $clients = Client::where('status', 'Active')->get();

        if ($clients->isEmpty()) {
            notyf()->info('No active clients found.');
            return;
        }

        foreach ($festivals as $festival) {
            foreach ($clients as $client) {
                EmailTask::create([
                    'festival_id' => $festival->festival_id,
                    'client_id' => $client->client_id,
                    'status' => 'pending',
                ]);
            }
        }

        $this->selectedFestivalIds = []; // Reset the selection
        notyf()->success('Festival emails scheduled successfully for active festivals.');
    }

    public function scheduleSelectedFestivalsEmail()
    {
        if (empty($this->selectedFestivalIds)) {
            notyf()->info('No festivals selected for email scheduling.');
            return;
        }

        $festivals = Festival::whereIn('festival_id', $this->selectedFestivalIds)
            ->where('status', 'Active')
            ->get();

        if ($festivals->isEmpty()) {
            notyf()->info('No active festivals selected for email scheduling.');
            return;
        }

        $clients = Client::where('status', 'Active')->get();

        foreach ($festivals as $festival) {
            foreach ($clients as $client) {
                EmailTask::create([
                    'festival_id' => $festival->festival_id,
                    'client_id' => $client->client_id,
                    'status' => 'pending',
                    'scheduled_at' => now()->addMinutes(5), // Schedule for 5 minutes from now
                ]);
            }
        }

        $this->selectedFestivalIds = []; // Reset the selection
        notyf()->success('Festival emails scheduled successfully for active festivals.');
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
        $this->updateFestivalStats();
        $this->dispatch('refreshComponent');
    }

    public function delete($id)
    {
        $festival = Festival::findOrFail($id);
        $festival->delete();
        notyf()->success('Festival deleted successfully.');
        $this->dispatch('refreshComponent');
        $this->updateFestivalStats();
    }

    public function toggleStatus($id)
    {
        $festival = Festival::find($id);
        $festival->status = $festival->status === 'Active' ? 'Inactive' : 'Active';
        $festival->save();
        $this->dispatch('refreshComponent');
        $this->updateFestivalStats();
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