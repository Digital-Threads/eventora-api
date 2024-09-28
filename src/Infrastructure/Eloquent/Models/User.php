<?php

namespace Infrastructure\Eloquent\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Infrastructure\Utils\WebUrl;
use Laravel\Passport\HasApiTokens;
use Modules\AuthPassword\Mail\AuthPasswordResetLinkMail;

/**
 * @property int $id
 * @property string|null $email
 * @property string|null $email_verification_token
 * @property string|null $password
 * @property string|null $google_id
 * @property string|null $facebook_id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $google_2fa_secret
 * @property string|null $google_2fa_recovery_code
 * @property Carbon|null $email_verified_at
 * @property Carbon|null $password_changed_at
 * @property Carbon|null $registered_at
 * @property int $role_id
 * @property int|null $subscription_plan_id
 * @property int|null $company_id
 * @property \Infrastructure\Eloquent\Models\Role $role
 * @property \Infrastructure\Eloquent\Models\SubscriptionPlan|null $subscriptionPlan
 * @property \Infrastructure\Eloquent\Models\Company|null $company
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
        'company_id',
    ];

    /**
     * Преобразование столбцов в типы данных
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at'   => 'datetime',
        'password_changed_at' => 'datetime',
        'registered_at'       => 'datetime',
    ];

    /**
     * Отправка уведомления для восстановления пароля
     *
     * @param  string  $token
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
     *
     * @return HasMany
     */
    public function userTrustedDevices(): HasMany
    {
        return $this->hasMany(UserTrustedDevice::class);
    }

    /**
     * Связь с таблицей компаний
     *
     * @return HasMany
     */
    public function ownCompanies(): HasMany
    {
        return $this->hasMany(Company::class, 'user_id', 'id');
    }

    /**
     * Связь с ролью
     *
     * @return BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Связь с подписками пользователя
     *
     * @return HasMany
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(UserSubscription::class);
    }

    /**
     * Получить активную подписку пользователя
     *
     * @return HasOne
     */
    public function activeSubscription(): HasOne
    {
        return $this->hasOne(UserSubscription::class)->where('is_active', true);
    }

    /**
     * Связь с компанией
     *
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

}
