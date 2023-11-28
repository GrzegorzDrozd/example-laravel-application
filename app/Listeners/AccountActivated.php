<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Verified;

class AccountActivated
{
    /**
     * Handle the event.
     */
    public function handle(Verified $event): void
    {
        session('status', 'Account activated');
    }
}
