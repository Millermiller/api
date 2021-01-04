<?php


namespace Scandinaver\Common\Domain\Services;

use Scandinaver\Common\Domain\Contract\Repository\IntroRepositoryInterface;
use Scandinaver\Common\Domain\Exception\IntroNotFoundException;
use Scandinaver\Common\Domain\Model\Intro;
use Scandinaver\Common\Domain\Model\IntroDTO;
use Scandinaver\Shared\Contract\BaseServiceInterface;

/**
 * Class IntroService
 *
 * @package Scandinaver\Common\Domain\Services
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
        $result = [];
        /** @var Intro[] $intros */
        $intros = $this->introRepository->findAll();
        foreach ($intros as $intro) {
            $result[] = $intro->toDTO();
        }

        return $result;
    }

    /**
     * @param  int  $id
     *
     * @return IntroDTO
     * @throws IntroNotFoundException
     */
    public function one(int $id): IntroDTO
    {
        $intro = $this->getIntro($id);

        return $intro->toDTO();
    }

    /**
     * @return array
     */
    public function groupped(): array
    {
        $result = [];
        /** @var Intro[] $intros */
        $intros = $this->introRepository->getGrouppedIntro();
        foreach ($intros as $intro) {
            $result[] = $intro->toDTO();
        }

        return $result;
    }

    /**
     * @param  array  $data
     *
     * @return IntroDTO
     */
    public function create(array $data): IntroDTO
    {
        $intro = IntroFactory::build($data);

        $this->introRepository->save($intro);

        return $intro->toDTO();
    }

    /**
     * @param  int    $id
     * @param  array  $data
     *
     * @return IntroDTO
     * @throws IntroNotFoundException
     */
    public function update(int $id, array $data): IntroDTO
    {
        $intro = $this->getIntro($id);

        $this->introRepository->update($intro, $data);

        return $intro->toDTO();
    }

    /**
     * @param  int  $id
     *
     * @throws IntroNotFoundException
     */
    public function delete(int $id)
    {
        $intro = $this->getIntro($id);

        $intro->delete();

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

        if ($intro === null) {
            throw new IntroNotFoundException();
        }

        return $intro;
    }
}