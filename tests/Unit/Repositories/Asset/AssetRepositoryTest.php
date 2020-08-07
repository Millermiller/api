<?php


namespace Tests\Repositories\Asset;

use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Contract\Repository\AssetRepositoryInterface;
use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\User\Domain\Model\{Plan, User};
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

    /**
     * @var Language
     */
    private $language;

    /**
     * @var User
     */
    private $user;

    /**
     * @var Asset[]
     */
    private $assets;

    public function setUp()
    {
        parent::setUp();

        $this->language = entity(Language::class)->create();

        $this->user   = entity(User::class)->create();
        $this->assets = entity(Asset::class, 2)->create(['user' => $this->user, 'language' => $this->language])->toArray();

        $this->entityManager = app('Doctrine\ORM\EntityManager');

        $this->repository = $this->app->make(AssetRepositoryInterface::class);

    }

    public function testGetFirstAsset()
    {
        $asset = $this->repository->getFirstAsset($this->language, Asset::TYPE_WORDS);

        $this->assertInstanceOf( Asset::class, $asset);
    }

    public function testGetPublicAssets()
    {
        $assets = $this->repository->getPublicAssets($this->language);

        $this->assertIsArray($assets);

        $this->assertInstanceOf(Asset::class, $assets[0]);
    }

    //public function testGetPersonalAssets()
    //{
        // $user = entity(User::class)->create();
//
        // $assets = $this->repository->getPersonalAssets($this->language, $user);
//
        // $this->assertIsArray($assets);
//
        // $this->assertInstanceOf(Asset::class, $assets[0]);
    //}
}
