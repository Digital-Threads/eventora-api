<?php

namespace Tests\Utils\Traits;

use Illuminate\Support\Facades\Mail;

trait WithMailFake
{
    protected function setUpWithMailFake(): void
    {
        Mail::fake();
    }
}
