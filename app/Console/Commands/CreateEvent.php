<?php


namespace App\Console\Commands;


use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

class CreateEvent extends GeneratorCommand
{
    protected $name = 'scandinaver:event';

    protected string $domain;

    protected $description = 'Create a new Domain Event';

    protected $type = 'Event';

    protected string $eventPath = 'Domain/Events';

    protected function getStub()
    {
        return __DIR__ . '/Stubs/custom-event.stub';
    }

    protected function getArguments(): array
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the event'],
        ];
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return "Scandinaver";
    }

    public function handle()
    {
        $this->domain = $this->ask('domain');

        $name = $this->getNameInput();

        $path = $this->getPath($name);

        $this->files->put($path, $this->buildClass($name));

        $this->files->chmod($path, 0777);

        $this->info($this->type . ' created successfully.');

        $this->call('scandinaver:event:handler', [
            'name'   => "{$name}",
            'domain' => $this->domain
        ]);
    }

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->getDefaultNamespace($name), '', $name);
        $name = str_replace('\\', '/', $name);
        $path = Str::replaceFirst('app', '', $this->laravel['path']);

        return "{$path}src/{$this->getDefaultNamespace($name)}/{$this->domain}/{$this->eventPath}/{$name}.php";
    }

    protected function getNamespace($name)
    {
        $eventNamespace = str_replace('/', '\\', $this->eventPath);
        return "{$this->getDefaultNamespace($name)}\\$this->domain\\$eventNamespace";
    }

    protected function replaceClass($stub, $name)
    {
        $class            = str_replace($this->getNamespace($name) . '\\', '', $name);
        $handlerNamespace = str_replace('/', '\\', 'Application/Handler');
        $handlerClass     = str_replace('Command', 'Handler', $class);
        return str_replace([
            'DummyClass',
            'DummyHandlerClass',
        ], [$class, "\\{$this->getDefaultNamespace($name)}\\$this->domain\\$handlerNamespace\\Command\\$handlerClass"], $stub);
    }
}