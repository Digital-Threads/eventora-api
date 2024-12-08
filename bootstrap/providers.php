<?php
return [
    /*
     * Laravel Framework Service Providers...
     */
    Illuminate\Auth\AuthServiceProvider::class,
    Illuminate\Broadcasting\BroadcastServiceProvider::class,
    Illuminate\Bus\BusServiceProvider::class,
    Illuminate\Cache\CacheServiceProvider::class,
    Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
    Illuminate\Database\DatabaseServiceProvider::class,
    Illuminate\Encryption\EncryptionServiceProvider::class,
    Illuminate\Filesystem\FilesystemServiceProvider::class,
    Illuminate\Foundation\Providers\FoundationServiceProvider::class,
    Illuminate\Hashing\HashServiceProvider::class,
    Illuminate\Mail\MailServiceProvider::class,
    Illuminate\Notifications\NotificationServiceProvider::class,
    Illuminate\Pagination\PaginationServiceProvider::class,
    Illuminate\Pipeline\PipelineServiceProvider::class,
    Illuminate\Queue\QueueServiceProvider::class,
    Illuminate\Redis\RedisServiceProvider::class,
    Illuminate\Translation\TranslationServiceProvider::class,
    Illuminate\Validation\ValidationServiceProvider::class,
    Illuminate\View\ViewServiceProvider::class,
    Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
    L5Swagger\L5SwaggerServiceProvider::class,

    /*
     * Infrastructure Service Providers...
     */

    Infrastructure\Eloquent\ServiceProvider::class,
    Infrastructure\View\ServiceProvider::class,
    Infrastructure\Faker\ServiceProvider::class,
    Infrastructure\Http\ServiceProvider::class,
    Infrastructure\Google2FA\ServiceProvider::class,
    /*
     * Module Service Providers...
     */
    Modules\HealthCheck\ServiceProvider::class,
    \Modules\Auth\AuthProfile\ServiceProvider::class,
    Modules\OAuth\ServiceProvider::class,
    \Modules\Auth\AuthEmail\ServiceProvider::class,
    \Modules\Auth\AuthPassword\ServiceProvider::class,
    \Modules\Auth\AuthFacebook\ServiceProvider::class,
    \Modules\Auth\AuthGoogle\ServiceProvider::class,
    \Modules\Auth\AuthTrustedDevice\ServiceProvider::class,
    \Modules\Auth\AuthGoogle2FA\ServiceProvider::class,
    \Modules\User\ServiceProvider::class,
    \Modules\Event\ServiceProvider::class,
    \Modules\Invitation\ServiceProvider::class,
    \Modules\Company\ServiceProvider::class,
    \Modules\Ticket\ServiceProvider::class,
    \Modules\EventMetric\ServiceProvider::class,
];
