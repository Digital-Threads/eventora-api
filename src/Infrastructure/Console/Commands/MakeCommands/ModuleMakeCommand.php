<?php

namespace Infrastructure\Console\Commands\MakeCommands;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ModuleMakeCommand extends GeneratorCommand
{
    protected $name = 'make:module';

    protected $description = 'Create a new module with the necessary structure';

    protected $type = 'Module';

    public function __construct(Filesystem $files)
    {
        parent::__construct($files);
    }

    protected function getArguments(): array
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the module'],
        ];
    }

    protected function getOptions(): array
    {
        return [
            ['directory', 'd', InputOption::VALUE_OPTIONAL, 'The directory to create the module in', ''],
        ];
    }

    protected function getStub()
    {
        return '';
    }

    protected function getPath($name): string
    {
        $directory = $this->option('directory');
        $path = 'src/Modules/';
        if ($directory) {
            $path .= str_replace('\\', '/', $directory) . '/';
        }
        $path .= str_replace('\\', '/', $name);

        return base_path($path);
    }

    public function handle(): bool|null
    {
        $moduleName = $this->argument('name');
        $directory = $this->option('directory');
        $modulePath = $this->getPath($moduleName);

        $this->createDirectoryStructure($modulePath);
        $this->createFiles($modulePath, $moduleName, $directory);
        $this->registerServiceProvider($moduleName, $directory);

        $this->info("Module $moduleName created successfully.");

        return null;
    }

    protected function createDirectoryStructure($modulePath): void
    {
        $directories = [
            'Dto',
            'Http/Actions',
            'Http/Requests',
            'Http/Resources',
            'Http/Schemas',
            'Services',
            'Repositories', // Добавляем директорию Repositories
            'Repositories/Interfaces', // Добавляем директорию для интерфейсов репозиториев
        ];

        foreach ($directories as $dir) {
            $this->files->makeDirectory("$modulePath/$dir", 0755, true, true);
        }

        // Create the Http directory
        $this->files->makeDirectory("$modulePath/Http", 0755, true, true);
    }

    protected function createFiles($modulePath, $moduleName, $directory): void
    {
        $files = [
            "Dto/{$moduleName}CreateRequestDto.php" => 'module.dto.stub',
            "Http/Actions/CreateAction.php" => 'module.action.stub',
            "Http/Requests/{$moduleName}CreateRequest.php" => 'module.request.stub',
            "Http/Resources/{$moduleName}Resource.php" => 'module.resource.stub',
            "Http/Schemas/{$moduleName}Schema.php" => 'module.schema.stub',
            'Http/routes.php' => 'module.routes.stub',
            "Services/{$moduleName}CommandService.php" => 'module.command.service.stub',
            'ServiceProvider.php' => 'module.serviceprovider.stub',
            "Repositories/Eloquent{$moduleName}CommandRepository.php" => 'module.repository.stub',
            "Repositories/Interfaces/{$moduleName}CommandRepositoryInterface.php" => 'module.repository.interface.stub',
        ];

        foreach ($files as $path => $stub) {
            $filePath = "$modulePath/$path";

            // Создаем директорию, если она не существует
            $this->makeDirectory(dirname($filePath));

            $content = $this->buildFileContent($stub, $moduleName, $directory);
            $this->files->put($filePath, $content);
        }
    }

    protected function buildFileContent($stub, $moduleName, $directory): array|string
    {
        $stubPath = base_path("stubs/$stub");
        $stubContent = $this->files->get($stubPath);

        $namespace = 'Modules';
        if ($directory) {
            $namespace .= '\\' . str_replace('/', '\\', $directory);
        }
        $namespace .= '\\' . str_replace('/', '\\', $moduleName);

        return str_replace(
            ['{{ module }}', '{{ moduleLower }}', '{{ namespace }}'],
            [$moduleName, strtolower($moduleName), $namespace],
            $stubContent
        );
    }

    protected function registerServiceProvider($moduleName, $directory): void
    {
        $appConfigPath = base_path('config/app.php');
        $configContents = $this->files->get($appConfigPath);

        $providerClass = 'Modules';
        if ($directory) {
            $providerClass .= '\\' . str_replace('/', '\\', $directory);
        }
        $providerClass .= '\\' . $moduleName . '\\ServiceProvider::class';

        if (!str_contains($configContents, $providerClass)) {
            // Ищем место вставки
            $search = 'Modules\HealthCheck\ServiceProvider::class,';
            $replace = "$search\n        $providerClass,";

            $configContents = str_replace($search, $replace, $configContents);
            $this->files->put($appConfigPath, $configContents);

            $this->info("ServiceProvider for $moduleName registered in config/app.php.");
        } else {
            $this->info("ServiceProvider for $moduleName already exists in config/app.php.");
        }
    }
}
