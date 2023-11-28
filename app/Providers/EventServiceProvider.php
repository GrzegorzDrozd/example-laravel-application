<?php

namespace App\Providers;

use App\Events\DeviceAuthorizedSuccessfully;
use App\Events\PasswordResetRequestSent;
use App\Listeners\AccountActivated;
use App\Listeners\Auth\FailedLoginAttempt;
use App\Listeners\Auth\PasswordResetRequested;
use App\Listeners\Auth\SuccessfulLogin;
use App\Listeners\DeviceAuthorized;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Failed::class => [
            FailedLoginAttempt::class,
        ],
        Login::class => [
            SuccessfulLogin::class,
        ],
        Verified::class => [
            AccountActivated::class,
        ],
        PasswordResetRequestSent::class => [
            PasswordResetRequested::class
        ],
        DeviceAuthorizedSuccessfully::class => [
            DeviceAuthorized::class
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
