<?php


namespace Scandinaver\Common\Domain\Services;

use Scandinaver\Common\Domain\Contract\Repository\IntroRepositoryInterface;
use Scandinaver\Common\Domain\Exception\IntroNotFoundException;
use Scandinaver\Common\Domain\Model\Intro;
use Scandinaver\Common\Domain\Model\IntroDTO;

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

    public function one(int $id): IntroDTO
    {
        $intro = $this->getIntro($id);

        return $intro->toDTO();
    }

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

    public function create(array $data): IntroDTO
    {
        $intro = IntroFactory::build($data);

        $this->introRepository->save($intro);

        return $intro->toDTO();
    }

    public function update(int $id, array $data): IntroDTO
    {
        $intro = $this->getIntro($id);

        $this->introRepository->update($intro, $data);

        return $intro->toDTO();
    }

    public function delete(int $id)
    {
        $intro = $this->getIntro($id);

        $intro->delete();

        $this->introRepository->delete($intro);
    }

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