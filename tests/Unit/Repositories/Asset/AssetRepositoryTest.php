<?php


namespace Tests\Repositories\Asset;

use Scandinaver\Common\Domain\Language;
use Scandinaver\Learn\Domain\Asset;
use Scandinaver\Learn\Domain\Contracts\AssetRepositoryInterface;
use Scandinaver\User\Domain\{Plan, User};
use Tests\TestCase;

/**
 * Class AssetRepositoryTest
 * @package Tests\Repositories\Asset
 */
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

        $user = new User();
        $user->setId(1);
        $user->setLogin('admin');
        $user->setEmail('john@scandinaver.org');
        $user->setPassword('$2y$10$wHzJJzCmyoI0hZUgoHGOI.6IXwc7p289G4DIbhpzvRiGCc5fZRt8W');
        $user->setPlan($plan);

        $assets = $this->repository->getPersonalAssets($language, $user);

        $this->assertIsArray($assets);

        $this->assertInstanceOf(Asset::class, $assets[0]);
    }
}
