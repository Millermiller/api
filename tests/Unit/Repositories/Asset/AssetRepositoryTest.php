<?php

namespace Tests\Repositories\Asset;

use App\Entities\Asset;
use App\Entities\Language;
use App\Entities\Plan;
use App\Entities\User;
use App\Repositories\Asset\AssetRepository;
use App\Repositories\Asset\AssetRepositoryInterface;
use Doctrine\Common\Collections\Collection;
use Tests\TestCase;

class AssetRepositoryTest extends TestCase
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

        $this->repository = $this->app->make(AssetRepositoryInterface::class);

    }

    public function testGetFirstAsset()
    {
        $language = new Language(1, 'is');

        $this->assertInstanceOf( Asset::class, $this->repository->getFirstAsset($language, Asset::TYPE_WORDS));
    }

    public function testGetPublicAssets()
    {
        $language = new Language(1, 'is');

        $assets = $this->repository->getPublicAssets($language);

        $this->assertIsArray($assets);

        $this->assertInstanceOf(Asset::class, $assets[0]);
    }

    public function testGetPersonalAssets()
    {
        $language = new Language(1, 'is');

        $plan = new Plan();
        $plan->setId(1);

        $user = new User('admin', 'john@scandinaver.org', '$2y$10$wHzJJzCmyoI0hZUgoHGOI.6IXwc7p289G4DIbhpzvRiGCc5fZRt8W', $plan);
        $user->setId(1);

        $assets = $this->repository->getPersonalAssets($language, $user);

        $this->assertIsArray($assets);

        $this->assertInstanceOf(Asset::class, $assets[0]);
    }
}
