<?php

namespace App\Livewire;

use App\Mail\TestEmail;
use Livewire\Component;
use App\Models\UserSmtp;
use Illuminate\Support\Str;
use App\Models\EmailTracking;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;  // Add this line

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
        $user = Auth::user();
        if ($user) {
            $user->load('smtpSettings');
            $smtpSettings = $user->smtpSettings;
            if ($smtpSettings) {
                $this->smtp_host = $smtpSettings->smtp_host;
                $this->smtp_username = $smtpSettings->smtp_username;
                $this->smtp_password = $smtpSettings->smtp_password;
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

        $user_id = Auth::id();

        UserSmtp::updateOrCreate(
            ['user_id' => $user_id],
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
        notyf()->success('SMTP updated successfully.');

        $this->dispatch('smtp-saved');
    }

    public function sendTestEmail()
    {
        $user = Auth::user();
        if (!$user || !$user->smtpSettings) {
            notyf()->error('SMTP settings not found.');
            return;
        }

        $smtpSettings = $user->smtpSettings;

        // Configure mail settings dynamically
        Config::set('mail.mailers.smtp.host', $smtpSettings->smtp_host);
        Config::set('mail.mailers.smtp.port', $smtpSettings->smtp_port);
        Config::set('mail.mailers.smtp.username', $smtpSettings->smtp_username);
        Config::set('mail.mailers.smtp.password', $smtpSettings->smtp_password);
        Config::set('mail.from.address', $smtpSettings->smtp_from_email);
        Config::set('mail.from.name', $smtpSettings->smtp_from_name);

        $details = [
            'title' => 'Test Email',
            'body' => 'This is a test email to verify your SMTP settings.'
        ];

        $trackingId = Str::uuid();

        try {
            Mail::to($smtpSettings->smtp_from_email)->send(new TestEmail($details, $trackingId));

            EmailTracking::create([
                'user_id' => $user->user_id,
                'email' => $smtpSettings->smtp_from_email,
                'tracking_id' => $trackingId,
                'sent_at' => now(),
            ]);

            notyf()->success('Test email sent successfully.');
            $this->dispatch('email-sent');
        } catch (\Exception $e) {
            Log::error('Failed to send test email: ' . $e->getMessage());
            notyf()->error('Failed to send test email: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.smtp-form-component');
    }
}
