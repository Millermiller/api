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
class UpdateServiceProvider extends GeneratorCommand
{
    /**
     * @var string
     */
    protected $name = 'updateServiceProvides';

    /**
     * @var string
     */
    private ?string $domain;

    /**
     * @var string
     */
    protected string $commandHandlerPath = 'Domain/Contract';

    /**
     * @var string
     */
    protected $type = 'CommandHandlerInterface';

    /**
     * @inheritDoc
     */
    protected function getStub(): string
    {
        return __DIR__ . '/Stubs/custom-command-handler-interface.stub';
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

        $data = '';

        $this->files->append(
          "/src/Scandinaver/$this->domain/Application/$this->domain.ServiceProvider",
            $data
        );

        $this->info($this->type . ' created successfully.');

        Artisan::call('updateServiceProvides', [
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
     * @param string $name
     *
     * @return string
     */
    protected function getNamespace($name): string
    {
        $commandNamespace = str_replace('/', '\\', $this->commandHandlerPath);
        return "{$this->getDefaultNamespace($name)}\\$this->domain\\$commandNamespace";
    }
}