<?php


namespace Scandinaver\Common\Domain\Service;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Scandinaver\Common\Domain\Contract\Repository\IntroRepositoryInterface;
use Scandinaver\Common\Domain\DTO\IntroDTO;
use Scandinaver\Common\Domain\Exception\IntroNotFoundException;
use Scandinaver\Common\Domain\Entity\Intro;
use Scandinaver\Core\Domain\Contract\BaseServiceInterface;
use Scandinaver\Core\Infrastructure\RequestParametersComposition;

/**
 * Class IntroService
 *
 * @package Scandinaver\Common\Domain\Service
 */
class IntroService implements BaseServiceInterface
{

    private IntroRepositoryInterface $introRepository;

    public function __construct(IntroRepositoryInterface $introRepository)
    {
        $this->introRepository = $introRepository;
    }

    public function all(RequestParametersComposition $params): LengthAwarePaginator
    {
        return $this->introRepository->getData($params);
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
        $intro = $this->introRepository->find($id);

        if ($intro === NULL) {
            throw new IntroNotFoundException();
        }

        return $intro;
    }
}