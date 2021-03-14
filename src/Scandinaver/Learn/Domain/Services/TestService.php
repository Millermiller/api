<?php


namespace Scandinaver\Learn\Domain\Services;

use Scandinaver\Common\Domain\Services\LanguageTrait;
use Scandinaver\Learn\Domain\Contract\Repository\PassingRepositoryInterface;
use Scandinaver\Learn\Domain\Exceptions\AssetNotFoundException;
use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Exceptions\PassingNotFoundException;
use Scandinaver\Learn\Domain\Model\Passing;
use Scandinaver\Shared\Contract\BaseServiceInterface;
use Scandinaver\Shared\DTO;
use Scandinaver\User\Domain\Model\User;

/**
 * Class TestService
 *
 * @package Scandinaver\Learn\Domain\Services
 */
class TestService implements BaseServiceInterface
{
    use LanguageTrait;
    use PassingTrait;
    use AssetTrait;

    private PassingRepositoryInterface $passingRepository;

    public function __construct(PassingRepositoryInterface $passingRepository)
    {
        $this->passingRepository = $passingRepository;
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

        /** @var Passing[] $passings */
        $passings = $this->passingRepository->findBy([
            'language' => $language
        ]);

        foreach ($passings as $passing) {
            $data[] = $passing->toDTO();
        }

        return $data;
    }

    /**
     * @param  User   $user
     * @param  int    $asset
     * @param  array  $data
     *
     * @return Passing
     * @throws AssetNotFoundException
     */
    public function savePassing(User $user, int $asset, array $data): Passing
    {
        $asset = $this->getAsset($asset);

        $minPercent = 80; //TODO: implement settings

        $completed = $data['percent'] >= $minPercent;

        $payload = [
            'time'   => $data['time'],
            'errors' => $data['errors'] ?? [],
        ];

        $data['payload'] = $payload;

        $result = new Passing($asset, $user, $completed, $data);

        return $this->passingRepository->save($result);
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

        $this->passingRepository->save($passing);
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

        $this->passingRepository->delete($passing);
    }
}