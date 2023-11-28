<?php

namespace App\Models;

use App\Events\PasswordResetRequestSent;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Event;

/**
 * @method static find(mixed $primaryKeyValue)
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function terms(): BelongsToMany
    {
        return $this->belongsToMany(Terms::class, 'terms_acceptance_log', 'user_id', 'terms_id');
    }

    public function userDevices(): HasMany
    {
        return $this->hasMany(UserDevice::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
        Event::dispatch(new PasswordResetRequestSent($this));
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);

    }

    public function getLatestApprovedTermsAndConditionsId()
    {
        return $this->terms()->where('required_from', '<=', now())->orderBy('terms_acceptance_log.created_at', 'desc')->first()?->getKey();
    }
}
