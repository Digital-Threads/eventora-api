<?php

namespace Infrastructure\Events;


use Exception;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;

trait RegisterListeners
{
    protected function registerListeners(): void
    {
        foreach ($this->listeners as $event => $listeners) {
            if (is_array($listeners)) {
                foreach ($listeners as $listener) {
                    Event::listen($event, function ($payload) use ($listener) {
                        try {
                            (new $listener)->handle($payload);
                        } catch(Exception $e) {
                            Log::error("Listener error: {$listener}, {$e->getMessage()}");
                        }
                    });
                }
            } else {
                Event::listen($event, function ($payload) use ($listeners) {
                    try {
                        (new $listeners)->handle($payload);
                    } catch(Exception $e) {
                        Log::error("Listener error: {$listeners}, {$e->getMessage()}");
                    }
                });
            }
        }
    }
}
