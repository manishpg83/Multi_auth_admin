<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ClientFormComponent extends Component
{
    public $first_name;
    public $last_name;
    public $email;
    public $company_name;
    public $status = 'Active';
    public $mail_status = 0;

    protected $rules = [
        'first_name' => 'required|string|max:100',
        'last_name' => 'required|string|max:100',
        'email' => 'required|email|unique:clients,email',
        'company_name' => 'required|string|max:255',
    ];

    public function submit()
    {
        $this->validate();

        // Create a new client without user_id
        $client = Client::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'company_name' => $this->company_name,
            'status' => 'Active', // Add default status or handle as needed
        ]);

        // Associate the client with the current user via the pivot table
        $user = User::find(Auth::id());
        $user->clients()->syncWithoutDetaching([$client->client_id => ['is_subscribed' => true]]);

        notyf()->success('Client Uploaded');
        return redirect()->route('dashboard'); // Redirect as necessary
    }


    public function render()
    {
        return view('livewire.client-form-component');
    }
}
