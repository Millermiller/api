<?php


namespace App\Console\Commands;

use Artisan;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class CreateQuery
 *
 * @package App\Console\Commands
 */
class CreateQuery extends GeneratorCommand
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'scandinaver:query';

    /**
     * @var string
     */
    protected $domain;

    /**
     * @var string
     */
    protected $queryPath = 'UI/Query';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new query class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Query';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub(): string
    {
        return __DIR__ . '/Stubs/custom-query.stub';
    }

    /**
     * @return array
     */
    public function getArguments(): array
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class'],
        ];
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
        $this->domain = $this->ask('domain');

        $name = $this->getNameInput();

        $path = $this->getPath($name);

        $this->files->put($path, $this->buildClass($name . "Query"));

        $this->files->chmod($path, 0777);

        $this->info($this->type . ' created successfully.');

        Artisan::call('createQueryHandler',
            [
                'name'   => "{$name}QueryHandler",
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

        return "{$path}src/{$this->domain}/{$this->queryPath}/{$name}Query.php";
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
                "\\{$this->getDefaultNamespace($name)}\\$domainNamespace\\$handlerNamespace\\Query\\$handlerClass",
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
        $queryNamespace = str_replace('/', '\\', $this->queryPath);
        $domainNamespace = str_replace('/', '\\', $this->domain);

        return "{$this->getDefaultNamespace($name)}\\$domainNamespace\\$queryNamespace";
    }
}
