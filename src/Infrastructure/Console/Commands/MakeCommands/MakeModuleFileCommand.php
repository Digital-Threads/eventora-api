<?php

namespace Infrastructure\Console\Commands\MakeCommands;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class MakeModuleFileCommand extends GeneratorCommand
{
    protected $name = 'make:module-file';

    protected $description = 'Create a new file in the specified module';

    protected $type = 'ModuleFile';

    public function __construct(Filesystem $files)
    {
        parent::__construct($files);
    }

    protected function getArguments()
    {
        return [
            ['module', InputArgument::REQUIRED, 'The name of the module (e.g. Frontend/Example)'],
            ['name', InputArgument::REQUIRED, 'The name of the file'],
        ];
    }

    protected function getOptions()
    {
        return [
            ['action', 'a', InputOption::VALUE_NONE, 'Create an Action'],
            ['dto', 'd', InputOption::VALUE_NONE, 'Create a DTO'],
            ['request', 'r', InputOption::VALUE_NONE, 'Create a Request'],
            ['resource', 'e', InputOption::VALUE_NONE, 'Create a Resource'],
            ['schema', 'c', InputOption::VALUE_NONE, 'Create a Schema'],
            ['service', 's', InputOption::VALUE_NONE, 'Create a Service'],
        ];
    }

    protected function getStub()
    {
        $typeMap = [
            'action' => 'action',
            'dto' => 'dto',
            'request' => 'request',
            'resource' => 'resource',
            'schema' => 'schema',
            'service' => 'service',
        ];

        foreach ($typeMap as $option => $type) {
            if ($this->option($option)) {
                return base_path("stubs/{$type}.stub");
            }
        }

        throw new \InvalidArgumentException('You must specify one of the file types using the appropriate flag.');
    }

    protected function getPath($name)
    {
        $module = $this->argument('module');
        $type = $this->getFileTypeOption();

        $path = 'src/Modules/';
        $path .= str_replace('\\', '/', $module) . '/';

        $typeMap = [
            'action' => 'Http/Actions/',
            'dto' => 'Dto/',
            'request' => 'Http/Requests/',
            'resource' => 'Http/Resources/',
            'schema' => 'Http/Schemas/',
            'service' => 'Services/',
        ];

        $path .= isset($typeMap[$type]) ? $typeMap[$type] : '';

        $path .= class_basename($name) . '.php';

        return base_path($path);
    }

    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());
        $module = $this->argument('module');

        $namespace = 'Modules';
        $namespace .= '\\' . str_replace('/', '\\', $module);

        $className = class_basename($name);

        return str_replace(
            ['{{ namespace }}', '{{ class }}'],
            [$namespace, $className],
            $stub
        );
    }

    protected function alreadyExists($rawName)
    {
        return $this->files->exists($this->getPath($rawName));
    }

    public function handle()
    {
        $name = $this->argument('name');

        // Check if the file already exists and confirm overwriting
        if ($this->alreadyExists($name)) {
            if (!$this->confirm("The file [{$this->getPath($name)}] already exists. Do you want to overwrite it?")) {
                $this->info("Skipped: [{$this->getPath($name)}]");
                return false;
            }
        }

        $this->makeDirectory($this->getPath($name));
        $this->files->put($this->getPath($name), $this->buildClass($name));

        $this->info('File created successfully.');
    }

    protected function makeDirectory($path)
    {
        if (!$this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0755, true, true);
        }
    }

    protected function getFileTypeOption()
    {
        $typeOptions = ['action', 'dto', 'request', 'resource', 'schema', 'service'];

        foreach ($typeOptions as $option) {
            if ($this->option($option)) {
                return $option;
            }
        }

        throw new \InvalidArgumentException('You must specify one of the file types using the appropriate flag.');
    }

    public function getHelp(): string
    {
        return <<<'EOT'
Usage:
  make:module-file [options] [--] <module> <name>

Arguments:
  <module>                The name of the module (e.g. Frontend/Example)
  <name>                  The name of the file

Options:
  -a, --action            Create an Action
  -d, --dto               Create a DTO
  -r, --request           Create a Request
  -e, --resource          Create a Resource
  -c, --schema            Create a Schema
  -s, --service           Create a Service

Examples:
  php artisan make:module-file Frontend/Example NewAction -a
  php artisan make:module-file Frontend/Example NewDto -d
  php artisan make:module-file Frontend/Example NewRequest -r
  php artisan make:module-file Frontend/Example NewResource -e
  php artisan make:module-file Frontend/Example NewSchema -c
  php artisan make:module-file Frontend/Example NewService -s
EOT;
    }
}
