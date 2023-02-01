<?php

namespace Infrastructure\Console\Commands;

use Illuminate\Console\Command;

/**
 * @codeCoverageIgnore
 */
final class InstallCommand extends Command
{
    protected $signature = 'install {--p|production}';

    protected $description = 'Project initial setup command';

    public function handle(): int
    {
        if (!$this->confirm('The application data will be pruned, are you sure you want to continue?')) {
            return 0;
        }

        if ($this->option('production')) {
            $this->call('config:cache');
            $this->call('cache:clear');
            $this->call('optimize');
            $this->call('route:cache');
            $this->call('view:cache');
        } else {
            $this->call('optimize:clear');
            $this->call('config:clear');
            $this->call('cache:clear');
            $this->call('route:clear');
            $this->call('key:generate', ['--force' => true]);
            $this->call('storage:link');
        }

        $this->call('migrate:fresh', ['--force' => true, '--seed' => true]);
        $this->call('l5-swagger:generate');

        return 0;
    }
}
