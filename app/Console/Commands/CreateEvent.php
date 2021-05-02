<?php


namespace App\Console\Commands;


use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class CreateEvent
 *
 * @package App\Console\Commands
 */
class CreateEvent extends GeneratorCommand
{
    protected $name = 'scandinaver:event';

    protected string $domain;

    protected $description = 'Create a new Domain Event';

    protected $type = 'Event';

    protected string $eventPath = 'Domain/Event';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub(): string
    {
        return __DIR__ . '/Stubs/custom-event.stub';
    }

    protected function getArguments(): array
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the event'],
        ];
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
     * Execute the console command.
     *
     * @return bool|null
     *
     * @throws FileNotFoundException
     */
    public function handle(): ?bool
    {
        $this->domain = $this->ask('domain');

        $name = $this->getNameInput();

        $path = $this->getPath($name);

        $this->files->put($path, $this->buildClass($name));

        $this->files->chmod($path, 0777);

        $this->info($this->type . ' created successfully.');

        $this->call('scandinaver:event:handler', [
                'name'   => "{$name}",
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

        return "{$path}src/{$this->getDefaultNamespace($name)}/{$this->domain}/{$this->eventPath}/{$name}.php";
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
        $eventNamespace = str_replace('/', '\\', $this->eventPath);

        return "{$this->getDefaultNamespace($name)}\\$this->domain\\$eventNamespace";
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
        $handlerClass     = str_replace('Command', 'Handler', $class);

        return str_replace([
            'DummyClass',
            'DummyHandlerClass',
        ], [$class, "\\{$this->getDefaultNamespace($name)}\\$this->domain\\$handlerNamespace\\Command\\$handlerClass"],
            $stub);
    }
}