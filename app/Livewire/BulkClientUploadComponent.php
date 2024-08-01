<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Client;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Traits\ChecksClientLimits;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class BulkClientUploadComponent extends Component
{
    use WithFileUploads;
    use ChecksClientLimits;
    public $csv_file;

    protected $rules = [
        'csv_file' => 'required|mimes:csv,txt',
    ];

    public function submit()
    {
        $this->validate();

        $path = $this->csv_file->store('csv_files');

        // Process CSV file
        $data = array_map('str_getcsv', file(storage_path('app/' . $path)));
        // $data = $this->getCSVData();
        $numberOfClients = count($data);

        if (!$this->canAddClients($numberOfClients)) {
            notyf()->error("You can't add {$numberOfClients} clients. You have {$this->getRemainingClientSlots()} slots remaining.");
            return;
        }
        $user = User::find(Auth::id());

        foreach ($data as $row) {
            // Create or update the client
            $client = Client::updateOrCreate(
                ['email' => $row[2]],
                [
                    'first_name' => $row[0],
                    'last_name' => $row[1],
                    'company_name' => $row[3],
                    'status' => 'Active',
                ]
            );

            // Associate the client with the current user via the pivot table
            $user->clients()->syncWithoutDetaching([$client->client_id => ['is_subscribed' => true]]);
        }
        notyf()->success('bulk-clients-uploaded');
        return redirect()->route('dashboard');
    }


    public function render()
    {
        return view('livewire.bulk-client-upload-component');
    }
}
