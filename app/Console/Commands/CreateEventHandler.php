<?php


namespace App\Console\Commands;


use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

class CreateEventHandler extends GeneratorCommand
{
    protected $name = 'scandinaver:event:handler';

    protected ?string $domain;

    protected $type = 'EventHandler';

    protected string $eventPath = 'Domain/Events/Listeners';

    protected function getStub()
    {
        return __DIR__ . '/Stubs/custom-event-handler.stub';
    }

    protected function getArguments(): array
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the event'],
            ['domain', InputArgument::REQUIRED, 'The name of the domain'],
        ];
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return "Scandinaver";
    }

    public function handle()
    {
        $name = $this->getNameInput();

        $this->domain = $this->argument('domain');

        $path = $this->getPath($name);

        $this->files->put($path, $this->buildClass($name));

        $this->files->chmod($path, 0777);

        $this->info($this->type . ' created successfully.');

        $this->call('scandinaver:rebuild:events', [
            'domain' => $this->domain
        ]);
    }

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->getDefaultNamespace($name), '', $name);
        $name = str_replace('\\', '/', $name);
        $path = Str::replaceFirst('app', '', $this->laravel['path']);

        return "{$path}src/{$this->getDefaultNamespace($name)}/{$this->domain}/{$this->eventPath}/{$name}Listener.php";
    }

    protected function getNamespace($name)
    {
        $eventNamespace = str_replace('/', '\\', $this->eventPath);
        return "{$this->getDefaultNamespace($name)}\\$this->domain\\$eventNamespace";
    }

    protected function replaceClass($stub, $name)
    {
        $class            = str_replace($this->getNamespace($name) . '\\', '', $name);

        return str_replace([
            'DummyClass',
            'DummyEventClass',
            'DummyEventNamespace',
        ], ["{$class}Listener",
            $class,
            "\\{$this->getDefaultNamespace($name)}\\$this->domain\\Domain\\Events\\{$class}",
        ], $stub);
    }
}