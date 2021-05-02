<?php


namespace Scandinaver\Learn\Domain\Services;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Services\LanguageTrait;
use Scandinaver\Learn\Domain\Contract\Repository\PassingRepositoryInterface;
use Scandinaver\Learn\Domain\Exceptions\AssetNotFoundException;
use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Exceptions\PassingNotFoundException;
use Scandinaver\Learn\Domain\Model\Passing;
use Scandinaver\Settings\Domain\Exception\SettingNotFoundException;
use Scandinaver\Settings\Domain\Services\SettingsService;
use Scandinaver\Shared\Contract\BaseServiceInterface;

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

    private SettingsService $settingsService;

    public function __construct(
        PassingRepositoryInterface $passingRepository,
        SettingsService $settingsService
    )
    {
        $this->passingRepository = $passingRepository;
        $this->settingsService = $settingsService;
    }

    public function all(): array
    {
        // TODO: Implement all() method.
    }

    /**
     * @param  int  $id
     *
     * @return Passing
     * @throws PassingNotFoundException
     */
    public function one(int $id): Passing
    {
        return $this->getPassing($id);
    }

    /**
     * @param  string  $language
     *
     * @return array
     * @throws LanguageNotFoundException
     */
    public function allByLanguage(string $language): array
    {
        $language = $this->getLanguage($language);

        /** @var Passing[] $passings */
        $passings = $this->passingRepository->findBy([
            'language' => $language,
        ]);

        return $passings;
    }

    /**
     * @param  UserInterface   $user
     * @param  int    $asset
     * @param  array  $data
     *
     * @return Passing
     * @throws AssetNotFoundException|SettingNotFoundException
     */
    public function savePassing(UserInterface $user, int $asset, array $data): Passing
    {
        $asset = $this->getAsset($asset);

        $minPercent = $this->settingsService->getSettingValue('test_threshold');

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
    public function updatePassing(int $id, array $data): void
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