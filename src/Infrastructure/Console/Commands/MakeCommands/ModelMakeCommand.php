<?php

namespace Infrastructure\Console\Commands\MakeCommands;


use Illuminate\Foundation\Console\ModelMakeCommand as BaseModelMakeCommand;
use Illuminate\Support\Str;

class ModelMakeCommand extends BaseModelMakeCommand
{
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return base_path('src/Infrastructure/Eloquent/Models') . '/' . str_replace('\\', '/', $name) . '.php';
    }

    protected function getStub()
    {
        return base_path('stubs/model.stub');
    }
}
