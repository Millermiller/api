<?php


namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class CreateCommandHandlerInterface
 *
 * @package App\Console\Commands
 */
class RebuildEventsProvider extends GeneratorCommand
{
    protected $name = 'scandinaver:rebuild:events';

    protected $description = 'Update events provider bindings';

    private ?string $domain;

    protected string $serviceProviderPath = 'Application/Provider';

    protected $type = 'Event service provider';

    protected function getStub(): string
    {
        return __DIR__ . '/Stubs/custom-event-service-provider.stub';
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

    protected function getArguments(): array
    {
        return [
            ['domain', InputArgument::REQUIRED, 'The name of the domain'],
        ];
    }

    public function handle(): void
    {
        $this->domain = $this->argument('domain');
        $name         = "EventServiceProvider";
        $path         = $this->getPath($name);

        $rootPath = Str::replaceFirst('app', '', $this->laravel['path']);

        $events = $this->files->files("$rootPath/src/Scandinaver/$this->domain/Domain/Event");

        $eventBindings = [];

        foreach ($events as $event) {
            $class        = Str::replaceFirst('.php', '', $event->getFilename());
            $classHandler = "{$class}Listener";

            $eventBindings[] = '\'Scandinaver\\' . $this->domain . '\Domain\Event\\' . $class . '\' => [' . PHP_EOL . "            " . '\'Scandinaver\\' . $this->domain . '\Domain\Event\Listener\\' . $classHandler . '\',' . PHP_EOL . "        " . '],';
        }

        $serviceprovider = $this->buildClass($name);

        $serviceprovider = Str::replaceFirst('events', implode(PHP_EOL . "        ", $eventBindings), $serviceprovider);

        $this->files->replace($path, $serviceprovider);

        $this->files->chmod($path, 0777);

        $this->info($name . ' created successfully.');
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
        $path = Str::replaceFirst('app', '', $this->laravel['path']);

        return "{$path}src/Scandinaver/{$this->domain}/Application/Provider/{$name}.php";
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
        $serviceProviderNamespace = str_replace('/', '\\', $this->serviceProviderPath);

        return "{$this->getDefaultNamespace($name)}\\$this->domain\\$serviceProviderNamespace";
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
        $class = str_replace($this->getNamespace($name) . '\\', '', $name);

        return str_replace([
            'DummyClass',
            'DummyNamespace',
        ], [
                $class,
                "{$this->getDefaultNamespace($name)}\\$this->domain\\Application\\Provider",
            ], $stub);
    }
}