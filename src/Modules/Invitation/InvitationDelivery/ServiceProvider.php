<?php

namespace Modules\Invitation\InvitationDelivery;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Modules\Invitation\InvitationDelivery\Repositories\EloquentInvitationDeliveryCommandRepository;
use Modules\Invitation\InvitationDelivery\Repositories\EloquentInvitationDeliveryQueryRepository;
use Modules\Invitation\InvitationDelivery\Repositories\Interfaces\InvitationDeliveryCommandRepositoryInterface;
use Modules\Invitation\InvitationDelivery\Repositories\Interfaces\InvitationDeliveryQueryRepositoryInterface;
use Modules\Invitation\InvitationDelivery\Services\InvitationDeliverySendService;
use Modules\Invitation\InvitationDelivery\Strategies\EmailInvitationChannelStrategy;

final class ServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {
        // Загружаем маршруты подмодуля
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
    }

    public function register(): void
    {
        // Регистрация репозиториев
        $this->app->bind(InvitationDeliveryCommandRepositoryInterface::class, EloquentInvitationDeliveryCommandRepository::class);
        $this->app->bind(InvitationDeliveryQueryRepositoryInterface::class, EloquentInvitationDeliveryQueryRepository::class);

        $this->app->singleton(InvitationDeliverySendService::class, function () {
            $channels = [
                'email' => new EmailInvitationChannelStrategy(),
                // Добавляйте другие стратегии по мере необходимости
            ];

            return new InvitationDeliverySendService($channels);
        });
    }
}
