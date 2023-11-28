<?php

namespace App\Events;

use App\Models\User;

class DeviceAuthorizedSuccessfully
{
    public function __construct(public User $user){}
}
