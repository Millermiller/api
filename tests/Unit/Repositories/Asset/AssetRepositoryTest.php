<?php


namespace Tests\Unit\Repositories\Asset;

use Doctrine\ORM\EntityManager;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Contract\Repository\AssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\WordAssetRepositoryInterface;
use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Learn\Domain\Model\WordAsset;
use Scandinaver\User\Domain\Model\{User};
use Tests\TestCase;

/**
 * Class AssetRepositoryTest
 *
 * @package Tests\Repositories\Asset
 */
class AssetRepositoryTest extends TestCase
{

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var AssetRepositoryInterface
     */
    private $repository;

    private Language $language;

    /**
     * @var User
     */
    private $user;

    /**
     * @var WordAsset[]
     */
    private $wordassets;

    public function setUp(): void
    {
        parent::setUp();

        $this->language = entity(Language::class)->create(['letter' => 'is']);

        $this->user       = entity(User::class)->create();
        $this->wordassets = entity(WordAsset::class, 2)->create(['user'     => $this->user,
                                                                 'language' => $this->language,
        ])->toArray();

        $this->entityManager = app('Doctrine\ORM\EntityManager');

        $this->repository = $this->app->make(WordAssetRepositoryInterface::class);

    }

    public function testGetFirstAsset()
    {
        $asset = $this->repository->getFirstAsset($this->language, Asset::TYPE_WORDS);

        $this->assertInstanceOf(Asset::class, $asset);
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
