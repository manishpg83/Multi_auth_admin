<?php

namespace App\Livewire;

use App\Mail\TestEmail;
use App\Models\DefaultSmtpSetting;
use App\Models\EmailTracking;
use App\Models\UserSmtp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;

class SmtpFormComponent extends Component
{
    public $smtp_host;
    public $smtp_username;
    public $smtp_password;
    public $smtp_port;
    public $smtp_from_name;
    public $smtp_from_email;
    public $mailer_type;
    public $passwordVisibility = false; // Default to hidden


    public function mount()
    {
        $user = Auth::user();
        if ($user) {
            $user->load('smtpSettings');
            $smtpSettings = $user->smtpSettings;
            if ($smtpSettings) {
                $this->smtp_host = $smtpSettings->smtp_host;
                $this->smtp_username = $smtpSettings->smtp_username;
                $this->smtp_password = Crypt::decryptString($smtpSettings->smtp_password); // Decrypt the password for the form
                $this->smtp_port = $smtpSettings->smtp_port;
                $this->smtp_from_name = $smtpSettings->smtp_from_name;
                $this->smtp_from_email = $smtpSettings->smtp_from_email;
                $this->mailer_type = $smtpSettings->mailer_type;
            } else {
                Log::info('No SMTP Settings found for user ID ' . $user->id);
            }
        } else {
            Log::info('No authenticated user found');
        }
    }

    public function changeMailerType($value)
    {
        $this->mailer_type = $value;
        $defaultSetting = DefaultSmtpSetting::where('mailer_type', $value)->first();

        if ($defaultSetting) {
            $this->smtp_host = $defaultSetting->smtp_host;
            $this->smtp_port = $defaultSetting->smtp_port;
        }
    }

    private function validateSmtpSettings()
    {
        try {
            // Configure the mailer with the current settings
            Config::set('mail.mailers.smtp.host', $this->smtp_host);
            Config::set('mail.mailers.smtp.port', $this->smtp_port);
            Config::set('mail.mailers.smtp.username', $this->smtp_username);
            Config::set('mail.mailers.smtp.password', $this->smtp_password);
            Config::set('mail.from.address', $this->smtp_from_email);
            Config::set('mail.from.name', $this->smtp_from_name);
            Config::set('mail.default', 'smtp');

            // Try to verify the SMTP connection
            $transport = Mail::getSymfonyTransport();
            $transport->start();

            return true;
        } catch (\Exception $e) {
            Log::error('SMTP validation failed: ' . $e->getMessage());
            return false;
        }
    }
    
    public function saveSmtpSettings($showSuccessMessage = true)
    {
        $user_id = Auth::id();

        UserSmtp::updateOrCreate(
            ['user_id' => $user_id],
            [
                'smtp_host' => $this->smtp_host,
                'smtp_username' => $this->smtp_username,
                'smtp_password' => Crypt::encryptString($this->smtp_password),
                'smtp_port' => $this->smtp_port,
                'smtp_from_name' => $this->smtp_from_name,
                'smtp_from_email' => $this->smtp_from_email,
                'mailer_type' => $this->mailer_type,
            ]
        );

        if ($showSuccessMessage) {
            notyf()->success('SMTP settings saved successfully.');
            $this->dispatch('smtp-saved');
        }
}

    public function saveAndSendTestEmail()
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

        if ($this->validateSmtpSettings()) {
            $this->saveSmtpSettings(false); // Pass false to prevent showing a success message
            $this->sendTestEmail();
        } else {
            notyf()->error('Invalid SMTP settings. Please check your credentials and try again.');
            $this->dispatch('smtp-validation-failed');
        }
    }

    private function sendTestEmail()
    {
        $details = [
            'title' => 'Test Email',
            'body' => 'This is a test email to verify your SMTP settings.'
        ];
        $trackingId = Str::uuid();

        try {
            $testEmail = new TestEmail($details, $trackingId);
            Mail::to($this->smtp_from_email)->send($testEmail);

            EmailTracking::create([
                'user_id' => Auth::id(),
                'email' => $this->smtp_from_email,
                'tracking_id' => $trackingId,
                'sent_at' => now(),
            ]);

            notyf()->success('SMTP settings saved and test email sent successfully.');
            $this->dispatch('smtp-saved-and-email-sent');
        } catch (\Exception $e) {
            Log::error('Failed to send test email: ' . $e->getMessage());
            notyf()->error('SMTP settings saved, but failed to send test email: ' . $e->getMessage());
            $this->dispatch('email-sent-failed');
        }
    }

    
    public function togglePasswordVisibility()
    {
        $this->passwordVisibility = !$this->passwordVisibility;
    }   

    public function render()
    {
        return view('livewire.smtp-form-component');
    }
}