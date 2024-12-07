<?php

namespace Modules\Frontend\Dashboard\Invitation\InvitationDelivery;

use Domain\InvitationDelivery\Repositories\InvitationDeliveryCommandRepositoryInterface;
use Domain\InvitationDelivery\Repositories\InvitationDeliveryQueryRepositoryInterface;
use Infrastructure\Eloquent\Repositories\InvitationDelivery\EloquentInvitationDeliveryCommandRepository;
use Infrastructure\Eloquent\Repositories\InvitationDelivery\EloquentInvitationDeliveryQueryRepository;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
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


        $this->app->singleton(InvitationDeliverySendService::class, function () {
            $channels = [
                'email' => new EmailInvitationChannelStrategy(),
                // Добавляйте другие стратегии по мере необходимости
            ];

            return new InvitationDeliverySendService($channels);
        });
    }
}
