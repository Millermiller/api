<?php


namespace App\Console\Commands;

use Artisan;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

class CreateCommandHandler extends GeneratorCommand
{
    protected $name = 'createCommandHandler';

    private $domain;

    /**
     * @inheritDoc
     */
    protected function getStub()
    {
        return __DIR__.'/Stubs/custom-command-handler.stub';
    }

    protected $commandHandlerPath = 'Application/Handlers';

    protected function getDefaultNamespace($rootNamespace)
    {
        return "Scandinaver";
    }

    protected $type = 'CommandHandler';

    public function handle()
    {
        $name = $this->getNameInput();

        $this->domain = $this->argument('domain');

        $path = $this->getPath($name);

        $this->files->put($path, $this->buildClass($name));

        $this->info($this->type.' created successfully.');

        Artisan::call('createCommandHandlerInterface', [
            'name' => "{$name}Interface",
            'domain' => $this->domain
        ]);
    }

    public function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class'],
            ['domain', InputArgument::REQUIRED, 'The name of the domain'],
        ];
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->getDefaultNamespace($name), '', $name);
        $name = str_replace('\\', '/', $name);
        $path = Str::replaceFirst('app', '', $this->laravel['path']);

        return "{$path}src/{$this->getDefaultNamespace($name)}/{$this->domain}/{$this->commandHandlerPath}/{$name}.php";
    }

    /**
     * Get the full namespace for a given class, without the class name.
     *
     * @param  string  $name
     * @return string
     */
    protected function getNamespace($name)
    {
        $commandNamespace = str_replace('/', '\\', $this->commandHandlerPath);
        return "{$this->getDefaultNamespace($name)}\\$this->domain\\$commandNamespace";
    }

    protected function replaceClass($stub, $name)
    {
        $class = str_replace($this->getNamespace($name).'\\', '', $name);
        $commandNamespace = str_replace('/', '\\', 'Application/Commands');
        $commandClass = str_replace('Handler', 'Command', $class);
        return str_replace([
            'DummyClass',
            'DummyCommandClass',
            'DummyCommandNamespace'
        ], [$class, $commandClass, "{$this->getDefaultNamespace($name)}\\$this->domain\\$commandNamespace\\$commandClass"], $stub);
    }
}