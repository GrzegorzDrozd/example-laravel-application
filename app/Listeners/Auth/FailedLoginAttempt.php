<?php

namespace App\Listeners\Auth;

class FailedLoginAttempt extends AbstractAuthLog
{
    protected string $status = 'invalid_password';
}
