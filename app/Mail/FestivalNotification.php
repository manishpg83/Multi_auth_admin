<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class FestivalNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $festival;
    public $userAdditionalInfo;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Festival  $festival
     * @param  \App\Models\User|null $user
     * @return void
     */
    public function __construct($festival, User $user = null)
    {
        $this->festival = $festival;

        // Fetch additional user info
        $user = $user ?? auth()->user();
        $this->userAdditionalInfo = [
            'phone' => $user->phone ?? 'N/A',
            'designation' => $user->designation ?? 'N/A',
            'website' => $user->website ?? 'N/A',
            'address' => $user->address ?? 'N/A',
            'telegram' => $user->telegram ?? 'N/A',
            'whatsapp' => $user->whatsapp ?? 'N/A',
            'skype' => $user->skype ?? 'N/A',
            'imo' => $user->imo ?? 'N/A',
        ];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.festival_notification')
            ->with([
                'festival' => $this->festival,
                'userAdditionalInfo' => $this->userAdditionalInfo,
            ]);
    }
}
