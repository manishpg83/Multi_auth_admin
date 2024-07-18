<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class BulkClientUploadComponent extends Component
{
    use WithFileUploads;

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

        foreach ($data as $row) {
            Client::create([
                'user_id' => Auth::id(),
                'first_name' => $row[0],
                'last_name' => $row[1],
                'email' => $row[2],
                'company_name' => $row[3],
            ]);
        }

        session()->flash('status', 'bulk-clients-uploaded');
        return redirect()->route('dashboard'); // Redirect as necessary
    }

    public function render()
    {
        return view('livewire.bulk-client-upload-component');
    }
}
