<?php

namespace App\Console\Commands;

use Artisan;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

class CreateCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'scandinaver:command';

    protected $domain;

    protected $commandPath = 'Application/Commands';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service  class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Command';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/Stubs/custom-command.stub';
    }

    /**
     * @return array
     */
    public function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class'],
        ];
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return "Scandinaver";
    }

    public function handle()
    {
        $this->domain = $this->ask('domain');

        $name = $this->getNameInput();

        $path = $this->getPath($name);

        $this->files->put($path, $this->buildClass($name."Command"));

        $this->info($this->type.' created successfully.');

        Artisan::call('createCommandHandler', [
            'name' => "{$name}Handler",
            'domain' => $this->domain
        ]);
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

        return "{$path}src/{$this->getDefaultNamespace($name)}/{$this->domain}/{$this->commandPath}/{$name}Command.php";
    }

    /**
     * Get the full namespace for a given class, without the class name.
     *
     * @param  string  $name
     * @return string
     */
    protected function getNamespace($name)
    {
        $commandNamespace = str_replace('/', '\\', $this->commandPath);
        return "{$this->getDefaultNamespace($name)}\\$this->domain\\$commandNamespace";
    }
}