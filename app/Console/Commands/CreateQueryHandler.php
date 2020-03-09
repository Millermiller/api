<?php


namespace App\Console\Commands;

use Artisan;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

class CreateQueryHandler extends GeneratorCommand
{
    protected $name = 'createQueryHandler';

    private $domain;

    /**
     * @inheritDoc
     */
    protected function getStub()
    {
        return __DIR__.'/Stubs/custom-query-handler.stub';
    }

    protected $queryHandlerPath = 'Application/Handlers';

    protected function getDefaultNamespace($rootNamespace)
    {
        return "Scandinaver";
    }

    protected $type = 'QueryHandler';

    public function handle()
    {
        $name = $this->getNameInput();

        $this->domain = $this->argument('domain');

        $path = $this->getPath($name);

        $this->files->put($path, $this->buildClass($name));

        $this->info($this->type.' created successfully.');

        Artisan::call('createQueryHandlerInterface', [
            'name' => "{$name}Interface",
            'domain' => $this->domain
        ]);
    }

    public function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class'],
            ['domain', InputArgument::REQUIRED, 'The name of the domain'],
        ];
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->getDefaultNamespace($name), '', $name);
        $name = str_replace('\\', '/', $name);
        $path = Str::replaceFirst('app', '', $this->laravel['path']);

        return "{$path}src/{$this->getDefaultNamespace($name)}/{$this->domain}/{$this->queryHandlerPath}/{$name}.php";
    }

    /**
     * Get the full namespace for a given class, without the class name.
     *
     * @param  string  $name
     * @return string
     */
    protected function getNamespace($name)
    {
        $queryNamespace = str_replace('/', '\\', $this->queryHandlerPath);
        return "{$this->getDefaultNamespace($name)}\\$this->domain\\$queryNamespace";
    }

    protected function replaceClass($stub, $name)
    {
        $class = str_replace($this->getNamespace($name).'\\', '', $name);
        $queryNamespace = str_replace('/', '\\', 'Application/Query');
        $queryClass = str_replace('Handler', 'Query', $class);
        return str_replace([
            'DummyClass',
            'DummyQueryClass',
            'DummyQueryNamespace'
        ], [$class, $queryClass, "{$this->getDefaultNamespace($name)}\\$this->domain\\$queryNamespace\\$queryClass"], $stub);
    }
}