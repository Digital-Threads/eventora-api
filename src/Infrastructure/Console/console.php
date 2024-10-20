<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('queue:prune-batches', ['--hours' => 48])
    ->dailyAt('23:59')
    ->onOneServer()
    ->runInBackground();

Schedule::command('queue:prune-failed', ['--hours' => 48])
    ->dailyAt('23:59')
    ->onOneServer()
    ->runInBackground();
