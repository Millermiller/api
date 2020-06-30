<?php


namespace Tests\Repositories\Asset;

use Scandinaver\Common\Domain\Language;
use Scandinaver\Learn\Domain\Contracts\{AssetRepositoryInterface, ResultRepositoryInterface};
use Scandinaver\User\Domain\{Plan, User};
use Tests\TestCase;

/**
 * Class ResultRepositoryTest
 * @package Tests\Repositories\Asset
 */
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
        $language = entity(Language::class)->create();
        $user = entity(User::class)->create();

        $assets = $this->repository->getActiveIds($user, $language);

        $this->assertIsArray($assets);
    }
}
