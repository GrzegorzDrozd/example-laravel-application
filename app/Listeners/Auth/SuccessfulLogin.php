<?php

namespace App\Listeners\Auth;

class SuccessfulLogin extends AbstractAuthLog
{
    protected string $status = 'logged_in';
}
