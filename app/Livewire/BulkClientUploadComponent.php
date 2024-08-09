<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Client;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Traits\ChecksClientLimits;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        
        // Remove the header row
        array_shift($data);

        $numberOfClients = count($data);

        if (!$this->canAddClients($numberOfClients)) {
            notyf()->error("You can't add {$numberOfClients} clients. You have {$this->getRemainingClientSlots()} slots remaining.");
            return;
        }

        $user = User::find(Auth::id());
        $errors = [];

        foreach ($data as $index => $row) {
            // Validate email
            $validator = Validator::make(['email' => $row[2]], [
                'email' => 'required|email',
            ]);

            if ($validator->fails()) {
                $errors[] = "Row " . ($index + 2) . ": Invalid email address - " . $row[2];
                continue;
            }

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

        if (!empty($errors)) {
            $errorMessage = implode("\n", $errors);
            notyf()->error("Some clients couldn't be added due to invalid email addresses:\n" . $errorMessage);
        } else {
            notyf()->success('Bulk clients uploaded successfully.');
        }

        $this->dispatch('bulk-clients-uploaded');
        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.bulk-client-upload-component');
    }
}