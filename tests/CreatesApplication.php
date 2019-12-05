<?php

namespace Tests;

use App\Entities\User;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Artisan;
use Doctrine\ORM\EntityManagerInterface;
use EntityManager;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Console\Kernel;
use \Illuminate\Container\Container as Container;
use \Illuminate\Support\Facades\Facade as Facade;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        Hash::setRounds(4);

        return $app;
    }
}
