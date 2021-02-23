<?php


namespace App\Console\Commands;

use Artisan;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class CreateQueryHandlerInterface
 *
 * @package App\Console\Commands
 */
class CreateQueryHandlerInterface extends GeneratorCommand
{

    /**
     * @var string
     */
    protected $name = 'createQueryHandlerInterface';

    /**
     * @var string
     */
    private $domain;

    /**
     * @var string
     */
    protected $queryHandlerPath = 'Domain/Contract/Query';

    /**
     * @var string
     */
    protected $type = 'QueryHandlerInterface';

    /**
     * @inheritDoc
     */
    protected function getStub()
    {
        return __DIR__ . '/Stubs/custom-query-handler-interface.stub';
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

        Artisan::call('scandinaver:rebuild:commands', [
                'domain' => $this->domain,
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
     * @param  string  $name
     *
     * @return string
     */
    protected function getPath($name): string
    {
        $name = Str::replaceFirst($this->getDefaultNamespace($name), '', $name);
        $name = str_replace('\\', '/', $name);
        $path = Str::replaceFirst('app', '', $this->laravel['path']);

        return "{$path}src/{$this->getDefaultNamespace($name)}/{$this->domain}/{$this->queryHandlerPath}/{$name}.php";
    }

    /**
     * @param  string  $name
     *
     * @return string
     */
    protected function getNamespace($name): string
    {
        $queryNamespace = str_replace('/', '\\', $this->queryHandlerPath);

        return "{$this->getDefaultNamespace($name)}\\$this->domain\\$queryNamespace";
    }

}