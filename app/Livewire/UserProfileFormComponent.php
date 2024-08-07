<?php 
namespace App\Livewire;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserProfileFormComponent extends Component
{
    public $first_name;
    public $last_name;
    public $email;
    public $company_name;

    public function mount()
    {
        $user = Auth::user();
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->company_name = $user->company_name;
    }

    public function updateProfile()
    {
        $userId = Auth::user()->user_id;

        $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$userId.',user_id',
            'company_name' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->company_name = $this->company_name;
        $user->save();
        notyf()->success('The process was completed successfully.');        
    }
 
    public function render()
    {
        return view('livewire.user-profile-form');
    }
}
