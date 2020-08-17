<?php


namespace App\Console\Commands;

use Artisan;
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
    /**
     * @var string
     */
    protected $name = 'createCommandHandler';

    /**
     * @var string
     */
    private $domain;

    /**
     * @var string
     */
    protected $commandHandlerPath = 'Application/Handler/Command';

    /**
     * @var string
     */
    protected $type = 'CommandHandler';

    /**
     * @inheritDoc
     */
    protected function getStub()
    {
        return __DIR__ . '/Stubs/custom-command-handler.stub';
    }

    /**
     * @param string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return "Scandinaver";
    }

    /**
     * @return bool|void|null
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

        Artisan::call('createCommandHandlerInterface', [
            'name'   => "{$name}Interface",
            'domain' => $this->domain
        ]);
    }

    /**
     * @return array
     */
    public function getArguments(): array
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class'],
            ['domain', InputArgument::REQUIRED, 'The name of the domain'],
        ];
    }

    /**
     * Get the destination class path.
     *
     * @param string $name
     *
     * @return string
     */
    protected function getPath($name): string
    {
        $name = Str::replaceFirst($this->getDefaultNamespace($name), '', $name);
        $name = str_replace('\\', '/', $name);
        $path = Str::replaceFirst('app', '', $this->laravel['path']);

        return "{$path}src/{$this->getDefaultNamespace($name)}/{$this->domain}/{$this->commandHandlerPath}/{$name}.php";
    }

    /**
     * Get the full namespace for a given class, without the class name.
     *
     * @param string $name
     *
     * @return string
     */
    protected function getNamespace($name): string
    {
        $commandNamespace = str_replace('/', '\\', $this->commandHandlerPath);
        return "{$this->getDefaultNamespace($name)}\\$this->domain\\$commandNamespace";
    }

    /**
     * @param string $stub
     * @param string $name
     *
     * @return string|string[]
     */
    protected function replaceClass($stub, $name)
    {
        $class            = str_replace($this->getNamespace($name) . '\\', '', $name);
        $commandNamespace = str_replace('/', '\\', 'UI/Command');
        $commandClass     = str_replace('Handler', 'Command', $class);
        $commandInterface = $class.'Interface';

        return str_replace([
            'DummyClass',
            'DummyCommandClass',
            'DummyCommandNamespace',
            'DummyInterface'
        ], [
          $class,
          $commandClass,
          "{$this->getDefaultNamespace($name)}\\$this->domain\\$commandNamespace\\$commandClass",
          "{$this->getDefaultNamespace($name)}\\$this->domain\\Domain\\Contract\\Command\\$commandInterface"
        ], $stub);
    }
}