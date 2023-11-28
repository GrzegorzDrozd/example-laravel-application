<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewDevice extends Notification
{
    public function __construct(protected User $user, protected string $url)
    {}

    public function via(object $notifiable): array
    {
        return [/*'mail', */'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('New device detected')
                    ->greeting('Hello!')
                    ->line('New device detected')
                    ->action('Authorize device', url($this->url))
                    ->line('Thank you for using our application!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'url'=>$this->url,
            'recipient'=>$notifiable->getKey(),
            'email'=>$notifiable->email,
        ];
    }
}
