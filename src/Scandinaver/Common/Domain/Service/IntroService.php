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

    /**
     * @return array
     */
    public function groupped(): array
    {
        return $this->introRepository->getGrouppedIntro();
    }

    /**
     * @param  array  $data
     *
     * @return Intro
     */
    public function create(array $data): Intro
    {
        $introDTO = new IntroDTO();
        $introDTO->setPage($data['page']);
        $introDTO->setTarget($data['target']);
        $introDTO->setContent($data['content']);
        $introDTO->setTooltipClass($data['tooltipClass']);
        $introDTO->setSort($data['sort']);
        $introDTO->setPosition($data['position']);

        $intro = IntroFactory::fromDTO($introDTO);

        $this->introRepository->save($intro);

        return $intro;
    }

    /**
     * @param  int    $id
     * @param  array  $data
     *
     * @return Intro
     * @throws IntroNotFoundException
     */
    public function update(int $id, array $data): Intro
    {
        $intro = $this->getIntro($id);

        $this->introRepository->update($intro, $data);

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

        if ($intro === NULL) {
            throw new IntroNotFoundException();
        }

        return $intro;
    }
}