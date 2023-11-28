<?php

namespace App\Listeners\Auth;

class PasswordResetRequested extends AbstractAuthLog
{
    protected string $status = 'password_recovery';
}
