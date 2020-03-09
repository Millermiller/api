<?php


namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

class CreateQueryHandlerInterface extends GeneratorCommand
{
    protected $name = 'createQueryHandlerInterface';

    private $domain;

    /**
     * @inheritDoc
     */
    protected function getStub()
    {
        return __DIR__.'/Stubs/custom-query-handler-interface.stub';
    }

    protected $queryHandlerPath = 'Application/Handlers';

    protected $type = 'QueryHandlerInterface';

    protected function getDefaultNamespace($rootNamespace)
    {
        return "Scandinaver";
    }

    public function handle()
    {
        $name = $this->getNameInput();

        $this->domain = $this->argument('domain');

        $path = $this->getPath($name);

        $this->files->put($path, $this->buildClass($name));

        $this->info($this->type.' created successfully.');
    }

    public function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class'],
            ['domain', InputArgument::REQUIRED, 'The name of the domain'],
        ];
    }

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->getDefaultNamespace($name), '', $name);
        $name = str_replace('\\', '/', $name);
        $path = Str::replaceFirst('app', '', $this->laravel['path']);

        return "{$path}src/{$this->getDefaultNamespace($name)}/{$this->domain}/{$this->queryHandlerPath}/{$name}.php";
    }

    protected function getNamespace($name)
    {
        $queryNamespace = str_replace('/', '\\', $this->queryHandlerPath);
        return "{$this->getDefaultNamespace($name)}\\$this->domain\\$queryNamespace";
    }
}