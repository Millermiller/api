<?php


namespace Tests\Unit\Repositories\Language;

use Doctrine\ORM\EntityManager;
use Scandinaver\Common\Domain\Contract\Repository\LanguageRepositoryInterface;
use Scandinaver\Common\Domain\Entity\Language;
use Tests\TestCase;

/**
 * Class LanguageRepositoryTest
 *
 * @package Tests\Repositories\Language
 */
class LanguageRepositoryTest extends TestCase
{

    private EntityManager $entityManager;

    private LanguageRepositoryInterface $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->entityManager = app('Doctrine\ORM\EntityManager');

        $this->repository = $this->app->make(LanguageRepositoryInterface::class);
    }

    public function testGetByName()
    {
        /** @var Language $language */
        $language = entity(Language::class)->create(['letter' => 'is']);

        $result = $this->repository->findOneBy([
            'letter' => $language->getLetter()
        ]);

        $this->assertInstanceOf(Language::class, $result);

        $this->assertEquals($language->getLetter(), $result->getLetter());
    }
}
