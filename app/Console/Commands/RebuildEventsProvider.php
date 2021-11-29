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

        $events = $this->files->files("$rootPath/src/$this->domain/Domain/Event");

        $eventBindings = [];

        $domainNamespace = Str::replace('/', '\\', $this->domain);
        foreach ($events as $event) {
            $class        = Str::replaceFirst('.php', '', $event->getFilename());
            $classHandler = "{$class}Listener";

            $eventBindings[] = '\'Scandinaver\\' . $domainNamespace . '\Domain\Event\\' . $class . '\' => [' . PHP_EOL . "            " . '\'Scandinaver\\' . $domainNamespace . '\Domain\Event\Listener\\' . $classHandler . '\',' . PHP_EOL . "        " . '],';
        }

        $subscribers = $this->files->files("$rootPath/src/$this->domain/Application/Subscriber");

        $subscriberBindings = [];

        foreach ($subscribers as $subscriber) {
            $class        = Str::replaceFirst('.php', '', $subscriber->getFilename());
            $subscriberBindings[] = "'\Scandinaver\\$domainNamespace\Application\Subscriber\\$class'," . PHP_EOL;
        }

        $serviceProvider = $this->buildClass($name);
        $serviceProvider = Str::replaceFirst('eventsData', implode(PHP_EOL . "        ", $eventBindings), $serviceProvider);
        $serviceProvider = Str::replaceFirst('subscriptionsData', implode(PHP_EOL . "        ", $subscriberBindings), $serviceProvider);

        $this->files->replace($path, $serviceProvider);

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

        return "{$path}src/{$this->domain}/Application/Provider/{$name}.php";
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
        $domainNamespace = Str::replace('/', '\\', $this->domain);

        return "{$this->getDefaultNamespace($name)}\\$domainNamespace\\$serviceProviderNamespace";
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
            'DummyDomain',
            'DummyClass',
            'DummyNamespace',
        ], [
                $this->domain,
                $class,
                "{$this->getDefaultNamespace($name)}\\$this->domain\\Application\\Provider",
            ], $stub);
    }
}