<?php

namespace App\Listeners;

use App\Events\DeviceAuthorizedSuccessfully;

class DeviceAuthorized
{
    /**
     * Handle the event.
     */
    public function handle(DeviceAuthorizedSuccessfully $event): void
    {
        session('status', 'Device authorized');
    }
}
