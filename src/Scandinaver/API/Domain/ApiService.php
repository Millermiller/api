<?php


namespace Scandinaver\API\Domain;

use Exception;
use Scandinaver\Common\Domain\Contract\Repository\LanguageRepositoryInterface;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Learn\Domain\Contract\Repository\AssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\ResultRepositoryInterface;
use Scandinaver\User\Domain\Model\User;

/**
 * Class ApiService
 *
 * @package Scandinaver\API\Infrastructure
 */
class ApiService
{
    /**
     * @var LanguageRepositoryInterface
     */
    protected LanguageRepositoryInterface $languageRepository;

    /**
     * @var AssetRepositoryInterface
     */
    protected AssetRepositoryInterface $assetsRepository;

    /**
     * @var ResultRepositoryInterface
     */
    protected ResultRepositoryInterface $resultRepository;

    /**
     * ApiService constructor.
     *
     * @param  LanguageRepositoryInterface  $languageRepository
     * @param  AssetRepositoryInterface     $assetsRepository
     * @param  ResultRepositoryInterface    $resultRepository
     */
    public function __construct(
        LanguageRepositoryInterface $languageRepository,
        AssetRepositoryInterface $assetsRepository,
        ResultRepositoryInterface $resultRepository
    ) {
        $this->languageRepository = $languageRepository;
        $this->assetsRepository = $assetsRepository;
        $this->resultRepository = $resultRepository;
    }

    /**
     * @return array
     */
    public function getLanguagesList(): array
    {
        return $this->languageRepository->all();
    }

    /**
     * @param  Language  $language
     * @param  User      $user
     *
     * @return array
     * @throws Exception
     */
    public function getAssets(Language $language, User $user): array
    {
        $assets = [];

        $activeArray = $this->resultRepository->getActiveIds($user, $language);
        $personaldata = $this->assetsRepository->getPersonalAssets(
            $language,
            $user
        );
        $publicdata = $this->assetsRepository->getPublicAssets($language);

        $data = $publicdata + $personaldata;

        $counter = [
            Asset::TYPE_WORDS => 0,
            Asset::TYPE_SENTENCES => 0,
            Asset::TYPE_PERSONAL => 0,
            Asset::TYPE_FAVORITES => 0,
        ];

        foreach ($data as $item) {
            $cards = [];

            /** @var Asset $item */
            foreach ($item->getCards() as $card) {
                $word = $card->getWord();

                if ($word === null) {
                    continue;
                }

                $cards[] = [
                    'id' => $card->getId(),
                    'word' => $word->getValue(),
                    'trans' => preg_replace(
                        '/^(\d\\)\s)/',
                        '',
                        $card->getTranslate()->getValue()
                    ),
                    'asset_id' => $item->getId(),
                    'examples' => $card->getExamples(),
                ];
            }

            $asset = [
                'id' => $item->getId(),
                'active' => in_array($item->getId(), $activeArray),
                'count' => $item->getCards()->count(),
                'result' => 0,
                'level' => $item->getLevel(),
                'title' => $item->getTitle(),
                'type' => $item->getType(),
                'basic' => $item->getBasic(),
                'cards' => $cards,
            ];

            $counter[$item->getType()] = $counter[$item->getType()] + 1;

            if ((in_array(
                        $item->getType(),
                        [Asset::TYPE_WORDS, Asset::TYPE_SENTENCES]
                    ) && $counter[$item->getType()] < 10) || $user->isPremium() || in_array(
                    $item->getType(),
                    [Asset::TYPE_FAVORITES, Asset::TYPE_PERSONAL]
                )) {
                $asset['available'] = true;
            } else {
                $asset['available'] = false;
            }

            $assets[] = $asset;
        }

        return $assets;
    }
}