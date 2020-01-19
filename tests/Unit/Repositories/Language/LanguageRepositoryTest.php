<?php


namespace Tests\Repositories\Language;

use Doctrine\ORM\EntityManager;
use Scandinaver\Common\Domain\Contracts\LanguageRepositoryInterface;
use Scandinaver\Common\Domain\Language;
use Tests\TestCase;

/**
 * Class LanguageRepositoryTest
 * @package Tests\Repositories\Language
 */
class LanguageRepositoryTest extends TestCase
{

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var LanguageRepositoryInterface
     */
    private $repository;

    public function setUp()
    {
        parent::setUp();

        $this->entityManager = app('Doctrine\ORM\EntityManager');

        $this->repository = $this->app->make(LanguageRepositoryInterface::class);

    }

    public function testGetByName()
    {
        $this->assertInstanceOf( Language::class, $this->repository->getByName('is'));
    }
}
