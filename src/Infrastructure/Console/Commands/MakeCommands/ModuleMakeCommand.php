<?php

namespace Infrastructure\Console\Commands\MakeCommands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ModuleMakeCommand extends GeneratorCommand
{
    protected $name = 'make:module';

    protected $description = 'Create a new module with the necessary structure';

    protected $type = 'Module';

    public function __construct(Filesystem $files)
    {
        parent::__construct($files);
    }

    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the module'],
        ];
    }

    protected function getOptions()
    {
        return [
            ['directory', 'd', InputOption::VALUE_OPTIONAL, 'The directory to create the module in', ''],
        ];
    }

    protected function getStub()
    {
        // We won't use a stub for the whole module, so just return null
        return null;
    }

    protected function getPath($name)
    {
        $directory = $this->option('directory');
        $path = 'src/Modules/';
        if ($directory) {
            $path .= str_replace('\\', '/', $directory) . '/';
        }
        $path .= str_replace('\\', '/', $name);

        return base_path($path);
    }

    public function handle()
    {
        $moduleName = $this->argument('name');
        $directory = $this->option('directory');
        $modulePath = $this->getPath($moduleName);

        $this->createDirectoryStructure($modulePath);
        $this->createFiles($modulePath, $moduleName, $directory);
        $this->registerServiceProvider($moduleName, $directory);

        $this->info("Module $moduleName created successfully.");
    }

    protected function createDirectoryStructure($modulePath)
    {
        $directories = [
            'Dto',
            'Http/Actions',
            'Http/Requests',
            'Http/Resources',
            'Http/Schemas',
            'Services',
        ];

        foreach ($directories as $dir) {
            $this->files->makeDirectory("$modulePath/$dir", 0755, true, true);
        }

        // Create the Http directory
        $this->files->makeDirectory("$modulePath/Http", 0755, true, true);
    }

    protected function createFiles($modulePath, $moduleName, $directory)
    {
        $files = [
            "Dto/{$moduleName}QueryRequestDto.php"        => 'module.dto.stub',
            "Dto/{$moduleName}QueryRequestDto.php"        => 'module.dto.stub',
            "Http/Actions/QueryAction.php"                => 'module.action.stub',
            "Http/Requests/{$moduleName}QueryRequest.php" => 'module.request.stub',
            "Http/Resources/{$moduleName}Resource.php"    => 'module.resource.stub',
            "Http/Schemas/{$moduleName}Schema.php"        => 'module.schema.stub',
            "Http/routes.php"                             => 'module.routes.stub',
            "Services/{$moduleName}QueryService.php"      => 'module.service.stub',
            "ServiceProvider.php"                         => 'module.serviceprovider.stub',
        ];

        foreach ($files as $path => $stub) {
            $filePath = "$modulePath/$path";
            if ($this->files->exists($filePath)) {
                if (!$this->confirm("The file [$filePath] already exists. Do you want to overwrite it?")) {
                    $this->info("Skipped: [$filePath]");
                    continue;
                }
            }

            $content = $this->buildFileContent($stub, $moduleName, $directory);
            $this->files->put($filePath, $content);
            $this->info("Created: [$filePath]");
        }
    }


    protected function buildFileContent($stub, $moduleName, $directory)
    {
        $stubPath    = base_path("stubs/$stub");
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

    protected function registerServiceProvider($moduleName, $directory)
    {
        $appConfigPath = base_path('config/app.php');
        $configContents = $this->files->get($appConfigPath);

        $providerClass = 'Modules';
        if ($directory) {
            $providerClass .= '\\' . str_replace('/', '\\', $directory);
        }
        $providerClass .= '\\' . $moduleName . '\\ServiceProvider::class';

        if (strpos($configContents, $providerClass) === false) {
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

