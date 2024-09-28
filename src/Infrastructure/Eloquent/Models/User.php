<?php

namespace Infrastructure\Eloquent\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Infrastructure\Utils\WebUrl;
use Laravel\Passport\HasApiTokens;
use Modules\AuthPassword\Mail\AuthPasswordResetLinkMail;

/**
 * @method static UserFactory factory()
 */
final class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'email_verification_token',
        'password',
        'google_2fa_secret',
        'google_2fa_recovery_code',
        'google_2fa_enabled',
        'google_id',
        'facebook_id',
        'email_verified_at',
        'password_changed_at',
        'registered_at',
        'role_id',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'email_verified_at'   => 'datetime',
        'password_changed_at' => 'datetime',
        'registered_at'       => 'datetime',
    ];

    /**
     * @param       $token
     *
     * @return void
     */
    public function sendPasswordResetNotification($token): void
    {
        Mail::to($this->email)->send(new AuthPasswordResetLinkMail(
            $this->first_name,
            $this->last_name,
            WebUrl::getResetPasswordUrl($this->email, $token),
        ));
    }

    /**
     * @return HasMany
     */
    public function userTrustedDevices(): HasMany
    {
        return $this->hasMany(UserTrustedDevice::class);
    }

    /**
     * @return HasMany
     */
    public function ownCompanies(): HasMany
    {
        return $this->hasMany(Company::class, 'user_id', 'id');
    }



    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
