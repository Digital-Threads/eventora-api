<?php

namespace Modules\Frontend\Dashboard\Invitation\InvitationDelivery;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Repositories\EloquentInvitationDeliveryCommandRepository;
use Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Repositories\EloquentInvitationDeliveryQueryRepository;
use Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Repositories\Interfaces\InvitationDeliveryCommandRepositoryInterface;
use Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Repositories\Interfaces\InvitationDeliveryQueryRepositoryInterface;
use Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Services\InvitationDeliverySendService;
use Modules\Frontend\Dashboard\Invitation\InvitationDelivery\Strategies\EmailInvitationChannelStrategy;

final class ServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {
        // Загружаем маршруты подмодуля

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
