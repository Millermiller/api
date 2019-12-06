<?php

namespace Tests\Repositories\Asset;

use App\Entities\Asset;
use App\Entities\Language;
use App\Entities\Plan;
use App\Entities\User;
use App\Repositories\Asset\AssetRepositoryInterface;
use App\Repositories\Result\ResultRepositoryInterface;
use Tests\TestCase;

class ResultRepositoryTest extends TestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * @var AssetRepositoryInterface
     */
    private $repository;

    public function setUp()
    {
        parent::setUp();

        $this->entityManager = app('Doctrine\ORM\EntityManager');

        $this->repository = $this->app->make(ResultRepositoryInterface::class);

    }

    public function testGetActiveIds()
    {
        $language = new Language(1, 'is');

        $plan = new Plan();
        $plan->setId(1);

        $user = new User();
        $user->setId(1);
        $user->setLogin('admin');
        $user->setEmail('john@scandinaver.org');
        $user->setPassword('$2y$10$wHzJJzCmyoI0hZUgoHGOI.6IXwc7p289G4DIbhpzvRiGCc5fZRt8W');
        $user->setPlan($plan);

        $assets = $this->repository->getActiveIds($user, $language);

        $this->assertIsArray($assets);
    }
}
