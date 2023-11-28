<?php

namespace App\Listeners\Auth;

use App\Events\PasswordResetRequestSent;
use App\Models\AccessLog;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Symfony\Component\HttpFoundation\Request;

class AbstractAuthLog
{
    protected string $status = 'unknown';

    public function __construct(protected Request $request)
    {
    }

    /**
     * Handle the event.
     */
    public function handle(Failed|PasswordResetRequestSent|Login $event): void
    {
        $log = new AccessLog();
        $log->user_id = $event->user->getKey();
        $log->login_ip = $this->request->getClientIp();
        $log->status = $this->status;
        $log->save();
    }
}
