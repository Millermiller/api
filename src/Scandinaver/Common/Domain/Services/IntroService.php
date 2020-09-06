<?php


namespace Scandinaver\Common\Domain\Services;

use Scandinaver\Common\Domain\Contract\Repository\IntroRepositoryInterface;
use Scandinaver\Common\Domain\Model\Intro;

/**
 * Class IntroService
 *
 * @package Scandinaver\Common\Domain\Services
 */
class IntroService
{
    private IntroRepositoryInterface $introRepository;

    /**
     * IntroService constructor.
     *
     * @param  IntroRepositoryInterface  $introRepository
     */
    public function __construct(IntroRepositoryInterface $introRepository)
    {
        $this->introRepository = $introRepository;
    }

    public function all()
    {
        return $this->introRepository->all();
    }

    public function one(int $id): Intro
    {
        return $this->introRepository->find($id);
    }

    public function create(array $data): Intro
    {
        $intro = IntroFactory::build($data);

        return $this->introRepository->save($intro);
    }
}