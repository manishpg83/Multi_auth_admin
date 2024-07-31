<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Client;
use Livewire\Component;
use App\Traits\ChecksClientLimits;
use Illuminate\Support\Facades\Auth;

class ClientFormComponent extends Component
{
    public $first_name;
    public $last_name;
    public $email;
    public $company_name;
    public $status = 'Active';
    public $mail_status = 0;
    use ChecksClientLimits;
    protected $rules = [
        'first_name' => 'required|string|max:100',
        'last_name' => 'required|string|max:100',
        'email' => 'required|email|unique:clients,email',
        'company_name' => 'required|string|max:255',
    ];

    public function submit()
    {
        $this->validate();
        
        if (!$this->checkClientLimit()) {
            notyf()->error('You have reached your client limit. Please upgrade your plan.');
            return;
        }
        // Create a new client with user_id
        $client = Client::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'company_name' => $this->company_name,
            'status' => 'Active',
            'user_id' => auth()->id(),
        ]);

        // Associate the client with the current user via the pivot table
        $user = User::find(Auth::id());
        $user->clients()->syncWithoutDetaching([$client->client_id => ['is_subscribed' => true]]);

        notyf()->success('Client Uploaded');
        return redirect()->route('dashboard');
    }


    public function render()
    {
        return view('livewire.client-form-component');
    }
}