<?php


namespace Scandinaver\User\Domain\DTO;

use Scandinaver\Common\Domain\Model\Intro;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\DTO\AssetDTO;
use Scandinaver\Learn\Domain\Model\FavouriteAsset;
use Scandinaver\Learn\Domain\Model\PersonalAsset;
use Scandinaver\Learn\Domain\Model\SentenceAsset;
use Scandinaver\Learn\Domain\Model\WordAsset;
use Scandinaver\Puzzle\Domain\DTO\PuzzleDTO;
use Scandinaver\Puzzle\Domain\Model\Puzzle;
use Scandinaver\Translate\Domain\DTO\TextDTO;
use Scandinaver\Translate\Domain\Model\Text;

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