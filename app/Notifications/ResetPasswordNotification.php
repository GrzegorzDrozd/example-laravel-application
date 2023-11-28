<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;

class ResetPasswordNotification extends ResetPassword
{
    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return [/*'mail', */'database'];
    }

    public function toArray($notifiable)
    {
        return [
            'url' => $this->resetUrl($notifiable)
        ];
    }
}
