<?php


namespace App\Console\Commands;

use Artisan;
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

    protected string $serviceProviderPath = 'Infrastructure';

    protected $type = 'Event service provider';

    protected function getStub(): string
    {
        return __DIR__ . '/Stubs/custom-event-service-provider.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return "Scandinaver";
    }

    protected function getArguments(): array
    {
        return [
            ['domain', InputArgument::REQUIRED, 'The name of the domain']
        ];
    }

    public function handle(): void
    {
        $this->domain = $this->argument('domain');
        $name = "EventServiceProvider";
        $path = $this->getPath($name);

        $rootPath = Str::replaceFirst('app', '', $this->laravel['path']);

        $events = $this->files->files("$rootPath/src/Scandinaver/$this->domain/Domain/Events");

        $eventBindings = [];

        foreach ($events as $event) {
            $class = Str::replaceFirst('.php', '', $event->getFilename());
            $classHandler = "{$class}Listener";

            $eventBindings[] =
                '\'Scandinaver\\'.$this->domain.'\Domain\Events\\'.$class.'\' => ['.PHP_EOL."            ".
                '\'Scandinaver\\'.$this->domain.'\Domain\Events\Listeners\\'.$classHandler.'\','.PHP_EOL."        ".
            '],';
        }

        $serviceprovider = $this->buildClass($name);

        $serviceprovider = Str::replaceFirst('events', implode(PHP_EOL."        ", $eventBindings), $serviceprovider);

        $this->files->replace($path, $serviceprovider);

        $this->files->chmod($path, 0777);

        $this->info($name . ' created successfully.');
    }

    protected function getPath($name): string
    {
        $path = Str::replaceFirst('app', '', $this->laravel['path']);

        return "{$path}src/Scandinaver/{$this->domain}/Infrastructure/{$name}.php";
    }

    protected function getNamespace($name): string
    {
        $serviceProviderNamespace = str_replace('/', '\\', $this->serviceProviderPath);
        return "{$this->getDefaultNamespace($name)}\\$this->domain\\$serviceProviderNamespace";
    }

    protected function replaceClass($stub, $name)
    {
        $class = str_replace($this->getNamespace($name) . '\\', '', $name);

        return str_replace([
            'DummyClass',
            'DummyNamespace',
        ], [
            $class,
            "{$this->getDefaultNamespace($name)}\\$this->domain\\Infrastructure",
        ], $stub);
    }
}