<?php


namespace Scandinaver\User\Domain\DTO;

use Scandinaver\Common\Domain\Entity\Intro;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Learning\Asset\Domain\Entity\FavouriteAsset;
use Scandinaver\Learning\Asset\Domain\Entity\PersonalAsset;
use Scandinaver\Learning\Asset\Domain\Entity\SentenceAsset;
use Scandinaver\Learning\Asset\Domain\Entity\WordAsset;
use Scandinaver\Learning\Puzzle\Domain\Entity\Puzzle;
use Scandinaver\Learning\Translate\Domain\Entity\Text;

/**
 * Class StateDTO
 *
 * @package Scandinaver\User\Domain\DTO
 */
class State
{

    private string $site;

    /** @var WordAsset[] $wordsAssets */
    private array $wordsAssets;

    /** @var SentenceAsset[] $sentencesAssets */
    private array $sentencesAssets;

    /** @var PersonalAsset[] $personalAssets */
    private array $personalAssets;

    private FavouriteAsset $favouriteAsset;

    /** @var Text[] $texts */
    private array $texts;

    /** @var Puzzle[] $puzzles */
    private array $puzzles;

    /** @var Intro[] $intro */
    private array $intro;

    /** @var Language[] $languagesDTO */
    private array $languages;

    private Language $currentLanguage;

    public function getSite(): string
    {
        return $this->site;
    }

    public function setSite(string $site): void
    {
        $this->site = $site;
    }

    public function getWordsAssets(): array
    {
        return $this->wordsAssets;
    }

    public function setWordsAssets(array $wordsAssets): void
    {
        $this->wordsAssets = $wordsAssets;
    }

    public function getSentencesAssets(): array
    {
        return $this->sentencesAssets;
    }

    public function setSentencesAssets(array $sentencesAssets): void
    {
        $this->sentencesAssets = $sentencesAssets;
    }

    public function getPersonalAssets(): array
    {
        return $this->personalAssets;
    }

    public function setPersonalAssets(array $personalAssets): void
    {
        $this->personalAssets = $personalAssets;
    }

    public function getFavouriteAsset(): FavouriteAsset
    {
        return $this->favouriteAsset;
    }

    public function setFavouriteAsset(FavouriteAsset $favouriteAsset): void
    {
        $this->favouriteAsset = $favouriteAsset;
    }

    public function getTexts(): array
    {
        return $this->texts;
    }

    public function setTexts(array $texts): void
    {
        $this->texts = $texts;
    }

    public function getPuzzles(): array
    {
        return $this->puzzles;
    }

    public function setPuzzles(array $puzzles): void
    {
        $this->puzzles = $puzzles;
    }

    public function getIntro(): array
    {
        return $this->intro;
    }

    public function setIntro(array $intro): void
    {
        $this->intro = $intro;
    }

    public function getLanguages(): array
    {
        return $this->languages;
    }

    public function setLanguages(array $languages): void
    {
        $this->languages = $languages;
    }

    public function getCurrentLanguage(): Language
    {
        return $this->currentLanguage;
    }

    public function setCurrentLanguage(Language $currentLanguage): void
    {
        $this->currentLanguage = $currentLanguage;
    }
}