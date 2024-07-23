<?php

namespace App\Notifications;

use App\Models\Festival;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewFestivalForApproval extends Notification
{
    use Queueable;

    protected $festival;

    public function __construct(Festival $festival)
    {
        $this->festival = $festival;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('A new festival has been submitted for approval.')
            ->action('Review Festival', url('/admin/festivals'))
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            'festival_id' => $this->festival->id,
            'festival_name' => $this->festival->name,
        ];
    }
}