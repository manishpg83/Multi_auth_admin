<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class UserAdditionalInfoComponent extends Component
{
    use WithFileUploads;

    public $phone;
    public $designation;
    public $website;
    public $logo;
    public $address;
    public $telegram;
    public $whatsapp;
    public $skype;
    public $imo;
    public $active_social;
    public $newLogo;

    public function mount()
    {
        $user = Auth::user();
        $this->phone = $user->phone;
        $this->designation = $user->designation;
        $this->website = $user->website;
        $this->logo = $user->logo ?? null;
        $this->address = $user->address;
        $this->telegram = $user->telegram;
        $this->whatsapp = $user->whatsapp;
        $this->skype = $user->skype;
        $this->imo = $user->imo;
        $this->active_social = $user->active_social;

    }

    public function updateAdditionalInfo()
    {
        $this->validate([
            'phone' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'newLogo' => 'nullable|image|max:12288',
            'address' => 'nullable|string|max:255',
            'telegram' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
            'skype' => 'nullable|string|max:255',
            'imo' => 'nullable|string|max:255',
            'active_social' => 'nullable|string|in:skype,telegram,imo,whatsapp',
        ]);

        $user = Auth::user();
        $user->phone = $this->phone;
        $user->designation = $this->designation;
        $user->website = $this->website;
        $user->address = $this->address;
        $user->telegram = $this->telegram;
        $user->whatsapp = $this->whatsapp;
        $user->skype = $this->skype;
        $user->imo = $this->imo;
        $user->active_social = $this->active_social;

        if ($this->newLogo) {
            $path = $this->newLogo->store('logos', 'public');
            if ($user->logo) {
                Storage::disk('public')->delete($user->logo);
            }
            $user->logo = $path;
            $this->logo = $path; // Update the logo property
        }

        $user->save();
        $this->newLogo = null;
        notyf()->success('Additional information updated successfully.');
        $this->dispatch('saved');
    }
    public function removeNewLogo()
    {
        $this->newLogo = null;
    }

    public function removeLogo()
    {
        // Delete the current logo from storage
        Storage::delete($this->logo);
        $user = Auth::user();
        $user->logo = null;
        $user->save();
        $this->logo = null;
    }
    public function render()
    {
        return view('livewire.user-additional-info-component');
    }
}