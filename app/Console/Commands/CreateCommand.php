<?php


namespace App\Console\Commands;

use Artisan;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class CreateCommand
 *
 * @package App\Console\Commands
 */
class CreateCommand extends GeneratorCommand
{

    protected $name = 'scandinaver:command';

    protected string $domain;

    /**
     * @var string
     */
    protected $commandPath = 'UI/Command';

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
     * @return bool|void|null
     * @throws FileNotFoundException
     */
    public function handle(): void
    {
        $this->domain = $this->ask('domain');

        $name = $this->getNameInput();

        $path = $this->getPath($name);

        $this->files->put($path, $this->buildClass($name . "Command"));

        $this->files->chmod($path, 0777);

        $this->info($this->type . ' created successfully.');

        Artisan::call('createCommandHandler',
            [
                'name'   => "{$name}CommandHandler",
                'domain' => $this->domain,
            ]);
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

        return "{$path}src/{$this->domain}/{$this->commandPath}/{$name}Command.php";
    }

    /**
     * @param  string  $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return "Scandinaver";
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub(): string
    {
        return __DIR__ . '/Stubs/custom-command.stub';
    }

    protected function getArguments(): array
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class'],
        ];
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     *
     * @return string
     */
    protected function replaceClass($stub, $name): string
    {
        $class            = str_replace($this->getNamespace($name) . '\\', '', $name);
        $handlerNamespace = str_replace('/', '\\', 'Application/Handler');
        $handlerClass     = $class . "Handler";
        $domainNamespace  = str_replace('/', '\\', $this->domain);

        return str_replace([
            'DummyClass',
            'DummyHandlerClass',
        ],
            [
                $class,
                "\\{$this->getDefaultNamespace($name)}\\$domainNamespace\\$handlerNamespace\\Command\\$handlerClass",
            ],
            $stub);
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
        $commandNamespace = str_replace('/', '\\', $this->commandPath);
        $domainNamespace = str_replace('/', '\\', $this->domain);

        return "{$this->getDefaultNamespace($name)}\\$domainNamespace\\$commandNamespace";
    }
}
