<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Festival;

class FestivalApproved extends Notification
{
    use Queueable;

    protected $festival;

    public function __construct(Festival $festival)
    {
        $this->festival = $festival;
    }
  
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Your festival has been approved!')
                    ->line('Festival Name: ' . $this->festival->name)
                    ->line('Festival Date: ' . $this->festival->date)
                    ->line('Discription: ' . $this->festival->email_body)
                    ->action('View Festival', url('/festivals/' . $this->festival->id))
                    ->line('Thank you for using our application!');
    }
}