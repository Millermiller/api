<?php


namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class CreateCommandHandler
 *
 * @package App\Console\Commands
 */
class CreateCommandHandler extends GeneratorCommand
{

    protected $name = 'createCommandHandler';

    protected string $commandHandlerPath = 'Application/Handler/Command';

    protected $type = 'CommandHandler';

    private ?string $domain;

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub(): string
    {
        return __DIR__ . '/Stubs/custom-command-handler.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return "Scandinaver";
    }

    /**
     * @return array[]
     */
    protected function getArguments(): array
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class'],
            ['domain', InputArgument::REQUIRED, 'The name of the domain'],
        ];
    }

    /**
     * @throws FileNotFoundException
     */
    public function handle(): void
    {
        $name = $this->getNameInput();

        $this->domain = $this->argument('domain');

        $path = $this->getPath($name);

        $this->files->put($path, $this->buildClass($name));

        $this->files->chmod($path, 0777);

        $this->info($this->type . ' created successfully.');
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     *
     * @return string
     */
    protected function getPath($name): string
    {
        $name = Str::replaceFirst($this->getDefaultNamespace($name), '', $name);
        $name = str_replace('\\', '/', $name);
        $path = Str::replaceFirst('app', '', $this->laravel['path']);

        return "{$path}src/{$this->domain}/{$this->commandHandlerPath}/{$name}.php";
    }

    /**
     * Get the full namespace for a given class, without the class name.
     *
     * @param  string  $name
     *
     * @return string
     */
    protected function getNamespace($name): string
    {
        $commandNamespace = str_replace('/', '\\', $this->commandHandlerPath);
        $domainNamespace = str_replace('/', '\\', $this->domain);

        return "{$this->getDefaultNamespace($name)}\\$domainNamespace\\$commandNamespace";
    }

    /**
     * @param  string  $stub
     * @param  string  $name
     *
     * @return string|string[]
     */
    protected function replaceClass($stub, $name)
    {
        $class            = str_replace($this->getNamespace($name) . '\\', '', $name);
        $commandNamespace = str_replace('/', '\\', 'UI/Command');
        $commandClass     = str_replace('Handler', '', $class);
        $domainNamespace  = str_replace('/', '\\', $this->domain);

        return str_replace([
            'DummyClass',
            'DummyCommandClass',
            'DummyCommandNamespace',
        ],
            [
                $class,
                $commandClass,
                "{$this->getDefaultNamespace($name)}\\$domainNamespace\\$commandNamespace\\$commandClass",
            ],
            $stub);
    }
}