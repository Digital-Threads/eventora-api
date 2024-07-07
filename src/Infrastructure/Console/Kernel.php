<?php

namespace Infrastructure\Console;

use Illuminate\Console\Scheduling\Schedule;
use Infrastructure\Console\Commands\MakeCommands\MakeModuleFileCommand;
use Infrastructure\Console\Commands\MakeCommands\ModelMakeCommand;
use Infrastructure\Console\Commands\CiCommand;
use Infrastructure\Console\Commands\InstallCommand;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Infrastructure\Console\Commands\MakeCommands\ModuleMakeCommand;

/**
 * @codeCoverageIgnore
 */
final class Kernel extends ConsoleKernel
{
    protected $commands = [
        InstallCommand::class,
        CiCommand::class,
        ModelMakeCommand::class,
        ModuleMakeCommand::class,
        MakeModuleFileCommand::class
    ];

    protected function schedule(Schedule $schedule): void
    {
        $schedule
            ->command('queue:prune-batches', ['--hours' => 48])
            ->dailyAt('23:59')
            ->onOneServer()
            ->runInBackground();

        $schedule
            ->command('queue:prune-failed', ['--hours' => 48])
            ->dailyAt('23:59')
            ->onOneServer()
            ->runInBackground();
    }
}
