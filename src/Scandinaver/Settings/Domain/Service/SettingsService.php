<?php


namespace Scandinaver\Settings\Domain\Service;

use Scandinaver\Common\Domain\Contract\RedisInterface;
use Scandinaver\Settings\Domain\Contract\Repository\SettingRepositoryInterface;
use Scandinaver\Settings\Domain\DTO\SettingDTO;
use Scandinaver\Settings\Domain\Exception\SettingNotFoundException;
use Scandinaver\Settings\Domain\Entity\Setting;
use Scandinaver\Shared\Contract\BaseServiceInterface;

/**
 * Class SettingsService
 *
 * @package Scandinaver\Settings\Domain\Services
 */
class SettingsService implements BaseServiceInterface
{

    private SettingRepositoryInterface $settingRepository;

    private RedisInterface $redisClient;

    public function __construct(
        SettingRepositoryInterface $settingRepository,
        RedisInterface $redisClient
    )
    {
        $this->settingRepository = $settingRepository;
        $this->redisClient = $redisClient;
    }

    public function all(): array
    {
        return $this->settingRepository->findAll();
    }

    /**
     * @param  int  $id
     *
     * @return Setting
     * @throws SettingNotFoundException
     */
    public function one(int $id): Setting
    {
        return $this->getSetting($id);
    }

    /**
     * @param  string  $slug
     *
     * @return mixed|null
     * @throws SettingNotFoundException
     */
    public function getSettingValue(string $slug)
    {
        $cached = $this->redisClient->hget('settings', $slug);

        if ($cached !== NULL) {
            /** @var Setting $setting */
            $setting = unserialize($cached);
            if ($setting instanceof Setting) {
                return $setting->getValue();
            }
        }

        $setting = $this->settingRepository->findOneBy([
            'slug' => $slug
        ]);

        if ($setting === NULL) {
            throw new SettingNotFoundException();
        }

        return $setting->getValue();
    }

    public function createSetting(SettingDTO $settingDTO): Setting
    {
        $setting = SettingFactory::fromDTO($settingDTO);

        $this->settingRepository->save($setting);

        return $setting;
    }

    /**
     * @param  int    $id
     * @param  array  $data
     *
     * @return Setting
     * @throws SettingNotFoundException
     */
    public function updateSetting(int $id, array $data): Setting
    {
        $setting = $this->getSetting($id);

        $setting->setType($data['type']);

        $this->settingRepository->update($setting, $data);

        $this->redisClient->hset('settings', $setting->getSlug(), serialize($setting));

        return $setting;
    }

    /**
     * @param  int  $id
     *
     * @throws SettingNotFoundException
     */
    public function deleteSetting(int $id): void
    {
        $setting = $this->getSetting($id);

        $this->settingRepository->delete($setting);

        $this->redisClient->hdel('settings', $setting->getSlug());
    }

    /**
     * @param  int  $id
     * @param       $value
     *
     * @return Setting
     * @throws SettingNotFoundException
     */
    public function setValue(int $id, $value): Setting
    {
        $setting = $this->getSetting($id);

        $setting->setValue($value);

        $this->settingRepository->save($setting);

        return $setting;
    }

    /**
     * @param  array  $data
     *
     * @throws SettingNotFoundException
     */
    public function bulkSetValue(array $data): void
    {
        foreach ($data as $settingData) {
            $id = $settingData['id'];
            $value = $settingData['value'];

            $setting = $this->getSetting($id);

            $setting->setValue($value);

            $this->settingRepository->save($setting);

            $this->redisClient->hset('settings', $setting->getSlug(), serialize($setting));
        }
    }

    /**
     * @param  int  $id
     *
     * @return Setting
     * @throws SettingNotFoundException
     */
    private function getSetting(int $id): Setting
    {
        $setting = $this->settingRepository->find($id);

        if ($setting === NULL) {
            throw new SettingNotFoundException();
        }

        return $setting;
    }
}