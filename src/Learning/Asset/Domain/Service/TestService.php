<?php


namespace Scandinaver\Learning\Asset\Domain\Service;

use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Service\LanguageTrait;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\PassingRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Exception\AssetNotFoundException;
use Scandinaver\Learning\Asset\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Learning\Asset\Domain\Exception\PassingNotFoundException;
use Scandinaver\Learning\Asset\Domain\Entity\Passing;
use Scandinaver\Settings\Domain\Exception\SettingNotFoundException;
use Scandinaver\Settings\Domain\Service\SettingsService;
use Scandinaver\Core\Domain\Contract\BaseServiceInterface;

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

        return $this->passingRepository->findBy([
            'language' => $language,
        ]);
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
            'cards'  => $data['cards'] ?? [],
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

        $this->passingRepository->delete($passing);
    }
}