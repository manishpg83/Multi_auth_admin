<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\UserSmtp;
use Illuminate\Support\Facades\Auth;

class SmtpFormComponent extends Component
{
    public $smtp_host;
    public $smtp_username;
    public $smtp_password;
    public $smtp_port;
    public $smtp_from_name;
    public $smtp_from_email;
    public $mailer_type;

    public function mount()
    {
        // Fetch existing SMTP settings for the authenticated user, if any
        $user = Auth::user();
        if ($user) {
            $smtpSettings = $user->smtpSettings; // Assuming you have a relationship defined
            if ($smtpSettings) {
                $this->smtp_host = $smtpSettings->smtp_host;
                $this->smtp_username = $smtpSettings->smtp_username;
                $this->smtp_password = $smtpSettings->smtp_password;
                $this->smtp_port = $smtpSettings->smtp_port;
                $this->smtp_from_name = $smtpSettings->smtp_from_name;
                $this->smtp_from_email = $smtpSettings->smtp_from_email;
                $this->mailer_type = $smtpSettings->mailer_type;
            }
        }
    }

    public function updateSmtpSettings()
    {
        $this->validate([
            'smtp_host' => 'required|string',
            'smtp_username' => 'required|string',
            'smtp_password' => 'required|string',
            'smtp_port' => 'required|integer',
            'smtp_from_name' => 'required|string',
            'smtp_from_email' => 'required|email',
            'mailer_type' => 'required|string|in:Gmail,Brevo,GetResponse',
        ]);

        // Get the authenticated user's ID
        $user_id = Auth::id();

        // Update or create SMTP settings for the user
        UserSmtp::updateOrCreate(
            ['user_id' => $user_id], // Use authenticated user's ID
            [
                'smtp_host' => $this->smtp_host,
                'smtp_username' => $this->smtp_username,
                'smtp_password' => $this->smtp_password,
                'smtp_port' => $this->smtp_port,
                'smtp_from_name' => $this->smtp_from_name,
                'smtp_from_email' => $this->smtp_from_email,
                'mailer_type' => $this->mailer_type,
            ]
        );

        // Flash success message
        notyf()->success('SMTP settings updated successfully.');

        // Redirect or refresh the component
        $this->dispatch('saved');
    }

    public function render()
    {
        return view('livewire.smtp-form-component');
    }
}