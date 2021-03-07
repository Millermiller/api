<?php


namespace Scandinaver\Learn\Domain\Services;

use Scandinaver\Common\Domain\Services\LanguageTrait;
use Scandinaver\Learn\Domain\Contract\Repository\ResultRepositoryInterface;
use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Exceptions\PassingNotFoundException;
use Scandinaver\Learn\Domain\Model\Result;
use Scandinaver\Shared\Contract\BaseServiceInterface;
use Scandinaver\Shared\DTO;

/**
 * Class TestService
 *
 * @package Scandinaver\Learn\Domain\Services
 */
class TestService implements BaseServiceInterface
{
    use LanguageTrait;
    use PassingTrait;

    private ResultRepositoryInterface $resultRepository;

    public function __construct(ResultRepositoryInterface $resultRepository)
    {
        $this->resultRepository = $resultRepository;
    }

    public function all(): array
    {
        // TODO: Implement all() method.
    }

    /**
     * @param  int  $id
     *
     * @return DTO
     * @throws PassingNotFoundException
     */
    public function one(int $id): DTO
    {
       return $this->getPassing($id)->toDTO();
    }

    /**
     * @param  string  $language
     *
     * @return array
     * @throws LanguageNotFoundException
     */
    public function allByLanguage(string $language): array
    {
        $data = [];

        $language = $this->getLanguage($language);

        /** @var Result[] $passings */
        $passings = $this->resultRepository->findBy([
            'language' => $language
        ]);

        foreach ($passings as $passing) {
            $data[] = $passing->toDTO();
        }

        return $data;
    }

    /**
     * @param  int    $id
     * @param  array  $data
     *
     * @throws PassingNotFoundException
     */
    public function updatePassing(int $id, array $data)
    {
        $passing = $this->getPassing($id);

        $passing->setPercent($data['percent']);
        $passing->setCompleted($data['completed']);

        $this->resultRepository->save($passing);
    }

    /**
     * @param  int  $id
     *
     * @throws PassingNotFoundException
     */
    public function deletePassing(int $id)
    {
        $passing = $this->getPassing($id);

        $passing->delete();

        $this->resultRepository->delete($passing);
    }
}