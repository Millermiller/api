<?php


namespace App\Console\Commands;

use Artisan;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class CreateCommandHandlerInterface
 *
 * @package App\Console\Commands
 */
class CreateCommandHandlerInterface extends GeneratorCommand
{
    protected $name = 'createCommandHandlerInterface';

    private ?string $domain;

    protected string $commandHandlerPath = 'Domain/Contract/Command';

    protected $type = 'CommandHandlerInterface';

    protected function getStub(): string
    {
        return __DIR__ . '/Stubs/custom-command-handler-interface.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return "Scandinaver";
    }

    protected function getArguments(): array
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class'],
            ['domain', InputArgument::REQUIRED, 'The name of the domain'],
        ];
    }

    public function handle(): void
    {
        $name = $this->getNameInput();

        $this->domain = $this->argument('domain');

        $path = $this->getPath($name);

        $this->files->put($path, $this->buildClass($name));

        $this->files->chmod($path, 0777);

        $this->info($this->type . ' created successfully.');

        Artisan::call('scandinaver:rebuild:commands', [
          'domain' => $this->domain
        ]);
    }

    protected function getPath($name): string
    {
        $name = Str::replaceFirst($this->getDefaultNamespace($name), '', $name);
        $name = str_replace('\\', '/', $name);
        $path = Str::replaceFirst('app', '', $this->laravel['path']);

        return "{$path}src/{$this->getDefaultNamespace($name)}/{$this->domain}/{$this->commandHandlerPath}/{$name}.php";
    }

    protected function getNamespace($name): string
    {
        $commandNamespace = str_replace('/', '\\', $this->commandHandlerPath);
        return "{$this->getDefaultNamespace($name)}\\$this->domain\\$commandNamespace";
    }
}