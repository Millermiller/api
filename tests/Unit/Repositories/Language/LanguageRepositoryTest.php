<?php


namespace Tests\Repositories\Language;

use Doctrine\ORM\EntityManager;
use Scandinaver\Common\Domain\Contract\Repository\LanguageRepositoryInterface;
use Scandinaver\Common\Domain\Model\Language;
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
       /** @var Language $language */
       $language = entity(Language::class)->create();

       $this->assertInstanceOf( Language::class, $this->repository->getByName($language->getName()));
   }
}
