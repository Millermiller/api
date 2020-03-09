<?php


namespace Scandinaver\Common\Domain\Services;

use Scandinaver\Common\Domain\Contracts\IntroRepositoryInterface;
use Scandinaver\Common\Domain\Intro;

/**
 * Class IntroService
 * @package Scandinaver\Common\Domain\Services
 */
class IntroService
{
    /**
     * @var IntroRepositoryInterface
     */
    private $introRepository;

    /**
     * IntroService constructor.
     * @param IntroRepositoryInterface $introRepository
     */
    public function __construct(IntroRepositoryInterface $introRepository)
    {
        $this->introRepository = $introRepository;
    }


    public function all()
    {
        return $this->introRepository->all();
    }

    /**
     * @param $id
     * @return Intro
     */
    public function one($id): object
    {
        return $this->introRepository->find($id);
    }

    /**
     * @param array $data
     * @return Intro
     */
    public function create(array $data): Intro
    {
        $intro = new Intro();

        $intro->setPage($data['page']);
        $intro->setElement($data['element']);
        $intro->setPosition($data['position']);
        $intro->setIntro($data['intro']);

        return $this->introRepository->save($intro);
    }
}