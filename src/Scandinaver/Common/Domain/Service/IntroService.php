<?php


namespace Scandinaver\Common\Domain\Service;

use Scandinaver\Common\Domain\Contract\Repository\IntroRepositoryInterface;
use Scandinaver\Common\Domain\DTO\IntroDTO;
use Scandinaver\Common\Domain\Exception\IntroNotFoundException;
use Scandinaver\Common\Domain\Model\Intro;
use Scandinaver\Shared\Contract\BaseServiceInterface;

/**
 * Class IntroService
 *
 * @package Scandinaver\Common\Domain\Service
 */
class IntroService implements BaseServiceInterface
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

    public function all(): array
    {
        return $this->introRepository->findAll();
    }

    /**
     * @param  int  $id
     *
     * @return Intro
     * @throws IntroNotFoundException
     */
    public function one(int $id): Intro
    {
        return $this->getIntro($id);
    }

    public function active(): array
    {
        return $this->introRepository->findBy([
            'active' => TRUE,
        ],
            [
                'sort' => 'ASC',
            ]);
    }

    /**
     * @param  IntroDTO  $introDTO
     *
     * @return Intro
     */
    public function create(IntroDTO $introDTO): Intro
    {
        $intro = IntroFactory::fromDTO($introDTO);

        $this->introRepository->save($intro);

        return $intro;
    }

    /**
     * @param  int       $id
     * @param  IntroDTO  $introDTO
     *
     * @return Intro
     * @throws IntroNotFoundException
     */
    public function update(int $id, IntroDTO $introDTO): Intro
    {
        $intro = $this->getIntro($id);

        $intro = IntroFactory::update($intro, $introDTO);

        $this->introRepository->save($intro);

        return $intro;
    }

    /**
     * @param  int  $id
     *
     * @throws IntroNotFoundException
     */
    public function delete(int $id)
    {
        $intro = $this->getIntro($id);

        $this->introRepository->delete($intro);
    }

    /**
     * @param  int  $id
     *
     * @return Intro
     * @throws IntroNotFoundException
     */
    private function getIntro(int $id): Intro
    {
        /** @var  Intro $intro */
        $intro = $this->introRepository->find($id);

        if ($intro === NULL) {
            throw new IntroNotFoundException();
        }

        return $intro;
    }
}