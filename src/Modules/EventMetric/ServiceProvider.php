<?php

namespace Modules\EventMetric;

use Domain\Event\Events\EventSubscribed;
use Domain\Event\Events\EventViewed;
use Domain\Ticket\Events\TicketPurchased;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Infrastructure\Events\RegisterListeners;
use Modules\EventMetric\Listeners\UpdateEventSubscriptions;
use Modules\EventMetric\Listeners\UpdateEventTicketsSold;
use Modules\EventMetric\Listeners\UpdateEventViews;

final class ServiceProvider extends BaseServiceProvider
{
    use RegisterListeners;

    protected array $listeners = [
              EventViewed::class => [
                  UpdateEventViews::class,
              ],
              TicketPurchased::class => [
                  UpdateEventTicketsSold::class,
              ],
              EventSubscribed::class => [
                  UpdateEventSubscriptions::class,
              ],
    ];
    public function boot(): void
    {
        $this->registerListeners();
    }

    public function register(): void
    {

    }
}
