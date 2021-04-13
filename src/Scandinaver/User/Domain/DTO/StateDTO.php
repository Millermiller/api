<?php


namespace Scandinaver\User\Domain\DTO;

use Scandinaver\Common\Domain\DTO\IntroDTO;
use Scandinaver\Common\Domain\DTO\LanguageDTO;
use Scandinaver\Learn\Domain\DTO\AssetDTO;
use Scandinaver\Puzzle\Domain\DTO\PuzzleDTO;
use Scandinaver\Translate\Domain\DTO\TextDTO;

/**
 * Class StateDTO
 *
 * @package Scandinaver\User\Domain\DTO
 */
class StateDTO
{
    private string $site;

    /** @var AssetDTO[] $wordsDTO */
    private array $wordsDTO;

    /** @var AssetDTO[] $sentencesDTO */
    private array $sentencesDTO;

    /** @var AssetDTO[] $personalDTO */
    private array $personalDTO;

    private AssetDTO $favouriteAssetDTO;

    /** @var TextDTO[] $textsDTO */
    private array $textsDTO;

    /** @var PuzzleDTO[] $puzzlesDTO */
    private array $puzzlesDTO;

    /** @var IntroDTO[] $introDTO */
    private array $introDTO;

    /** @var LanguageDTO[] $languagesDTO */
    private array $languagesDTO;

    private string $currentSite = '';

    private string $domain = '';

    public function getSite(): string
    {
        return $this->site;
    }

    public function setSite(string $site): void
    {
        $this->site = $site;
    }

    public function getWordsDTO(): array
    {
        return $this->wordsDTO;
    }

    public function setWordsDTO(array $wordsDTO): void
    {
        $this->wordsDTO = $wordsDTO;
    }

    public function getSentencesDTO(): array
    {
        return $this->sentencesDTO;
    }

    public function setSentencesDTO(array $sentencesDTO): void
    {
        $this->sentencesDTO = $sentencesDTO;
    }

    public function getPersonalDTO(): array
    {
        return $this->personalDTO;
    }

    public function setPersonalDTO(array $personalDTO): void
    {
        $this->personalDTO = $personalDTO;
    }

    public function getFavouriteAssetDTO(): AssetDTO
    {
        return $this->favouriteAssetDTO;
    }

    public function setFavouriteAssetDTO(AssetDTO $favouriteAssetDTO): void
    {
        $this->favouriteAssetDTO = $favouriteAssetDTO;
    }

    public function getTextsDTO(): array
    {
        return $this->textsDTO;
    }

    public function setTextsDTO(array $textsDTO): void
    {
        $this->textsDTO = $textsDTO;
    }

    public function getPuzzlesDTO(): array
    {
        return $this->puzzlesDTO;
    }

    public function setPuzzlesDTO(array $puzzlesDTO): void
    {
        $this->puzzlesDTO = $puzzlesDTO;
    }

    public function getIntroDTO(): array
    {
        return $this->introDTO;
    }

    public function setIntroDTO(array $introDTO): void
    {
        $this->introDTO = $introDTO;
    }

    public function getLanguagesDTO(): array
    {
        return $this->languagesDTO;
    }

    public function setLanguagesDTO(array $languagesDTO): void
    {
        $this->languagesDTO = $languagesDTO;
    }

    public function getCurrentSite(): string
    {
        return $this->currentSite;
    }

    public function setCurrentSite(string $currentSite): void
    {
        $this->currentSite = $currentSite;
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    public function setDomain(string $domain): void
    {
        $this->domain = $domain;
    }
}