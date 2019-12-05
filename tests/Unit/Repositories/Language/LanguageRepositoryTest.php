<?php

namespace Tests\Repositories\Language;

use App\Entities\Language;
use App\Repositories\Language\LanguageRepository;
use App\Repositories\Language\LanguageRepositoryInterface;
use EntityManager;
use Tests\TestCase;

class LanguageRepositoryTest extends TestCase
{

    /**
     * @var \Doctrine\ORM\EntityManager
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
