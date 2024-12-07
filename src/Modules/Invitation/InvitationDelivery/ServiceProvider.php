<?php

namespace Modules\Invitation\InvitationDelivery;

use Modules\Invitation\InvitationDelivery\Services\InvitationDeliverySendService;
use Modules\Invitation\InvitationDelivery\Strategies\EmailInvitationChannelStrategy;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

final class ServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {
        // Загружаем маршруты подмодуля
    }

    public function register(): void
    {
        // Регистрация репозиториев


        $this->app->singleton(InvitationDeliverySendService::class, function () {
            $channels = [
                'email' => new EmailInvitationChannelStrategy(),
                // Добавляйте другие стратегии по мере необходимости
            ];

            return new InvitationDeliverySendService($channels);
        });
    }
}
