<?php

namespace App\Notifications;

use App\Models\User;

class VerifyEmail extends \Illuminate\Auth\Notifications\VerifyEmail
{
    public function via($notifiable)
    {
        return [/*'mail', */'database'];
    }

    public function toArray(User $notifiable)
    {
        return [
            'id'=>$notifiable->getKey(),
            'email'=>$notifiable->email,
            'name'=>$notifiable->name,
            'url'=>$this->verificationUrl($notifiable)
        ];
    }
}
