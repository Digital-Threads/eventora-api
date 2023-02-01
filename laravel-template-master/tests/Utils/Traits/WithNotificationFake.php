<?php

namespace Tests\Utils\Traits;

use Illuminate\Support\Facades\Notification;

trait WithNotificationFake
{
    protected function setUpWithNotificationFake(): void
    {
        Notification::fake();
    }
}
