<?php

namespace Infrastructure\Eloquent\Models;

use Illuminate\Support\Carbon;
use Infrastructure\Utils\WebUrl;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\AuthPassword\Mail\AuthPasswordResetLinkMail;

/**
 * @property int                   $id
 * @property string|null           $email
 * @property string|null           $email_verification_token
 * @property string|null           $password
 * @property string|null           $google_id
 * @property string|null           $facebook_id
 * @property string|null           $first_name
 * @property string|null           $last_name
 * @property string|null           $google_2fa_secret
 * @property string|null           $google_2fa_recovery_code
 * @property bool                  $google_2fa_enabled
 * @property Carbon|null           $email_verified_at
 * @property Carbon|null           $password_changed_at
 * @property Carbon|null           $registered_at
 * @property int                   $role_id
 * @property int|null              $subscription_plan_id
 * @property int|null              $company_id
 * @property Role                  $role
 * @property SubscriptionPlan|null $subscriptionPlan
 * @property Company|null          $company
 */
final class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Отключение timestamps, если не используются стандартные столбцы created_at/updated_at
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array<int, string>
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
        'company_id',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password_changed_at' => 'datetime',
        'registered_at' => 'datetime',
    ];

    /**
     * Отправка уведомления для восстановления пароля
     *
     * @param string $token
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
     * Связь с таблицей trusted devices
     */
    public function userTrustedDevices(): HasMany
    {
        return $this->hasMany(UserTrustedDevice::class);
    }

    /**
     * Связь с таблицей компаний
     */
    public function ownCompanies(): HasMany
    {
        return $this->hasMany(Company::class, 'user_id', 'id');
    }

    /**
     * Связь с ролью
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Связь с подписками пользователя
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(UserSubscription::class);
    }

    /**
     * Получить активную подписку пользователя
     */
    public function activeSubscription(): HasOne
    {
        return $this->hasOne(UserSubscription::class)->where('is_active', true);
    }

    /**
     * Связь с компанией
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     */
    public function socialProviders(): HasMany
    {
        return $this->hasMany(SocialProvider::class);
    }

    /**
     */
    public function isAdmin(): bool
    {
        return $this->role->name === Role::ADMIN;
    }
}
