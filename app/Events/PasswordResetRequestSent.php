<?php

namespace App\Events;

use App\Models\User;

class PasswordResetRequestSent
{
    public function __construct(public User $user){}
}
