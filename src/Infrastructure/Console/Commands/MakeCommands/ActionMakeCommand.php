<?php

namespace Infrastructure\Console\Commands\MakeCommands;

use Illuminate\Support\Str;

class ActionMakeCommand extends BaseControllerMakeCommand
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
