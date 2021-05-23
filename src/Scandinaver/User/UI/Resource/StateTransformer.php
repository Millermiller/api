<?php


namespace Scandinaver\User\UI\Resource;

use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;
use Scandinaver\Common\UI\Resource\IntroTransformer;
use Scandinaver\Common\UI\Resource\LanguageTransformer;
use Scandinaver\Learn\UI\Resource\AssetTransformer;
use Scandinaver\Puzzle\UI\Resource\PuzzleTransformer;
use Scandinaver\Translate\UI\Resource\TextTransformer;
use Scandinaver\User\Domain\DTO\State;

/**
 * Class StateTransformer
 *
 * @package Scandinaver\User\UI\Resource
 */
class StateTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
        'words',
        'sentences',
        'personal',
        'favourite',
        'texts',
        'puzzles',
        'intro',
        'languages',
        'currentLanguage'
    ];

    public function transform(State $stateDTO): array
    {
        return [
            'site' => $stateDTO->getSite(),
        ];
    }

    public function includeWords(State $stateDTO): Collection
    {
        $wordsAssets = $stateDTO->getWordsAssets();

        return $this->collection($wordsAssets, new AssetTransformer());
    }

    public function includeSentences(State $stateDTO): Collection
    {
        $sentencesAssets = $stateDTO->getSentencesAssets();

        return $this->collection($sentencesAssets, new AssetTransformer());
    }

    public function includePersonal(State $stateDTO): Collection
    {
        $personalAssets = $stateDTO->getPersonalAssets();

        return $this->collection($personalAssets, new AssetTransformer());
    }

    public function includeFavourite(State $stateDTO): Item
    {
        $favouriteAsset = $stateDTO->getFavouriteAsset();

        return $this->item($favouriteAsset, new AssetTransformer());
    }

    public function includeTexts(State $stateDTO): Collection
    {
        $texts = $stateDTO->getTexts();

        return $this->collection($texts, new TextTransformer());
    }

    public function includePuzzles(State $stateDTO): Collection
    {
        $puzzlesDTO = $stateDTO->getPuzzles();

        return $this->collection($puzzlesDTO, new PuzzleTransformer());
    }

    public function includeIntro(State $stateDTO): Collection
    {
        $intros = $stateDTO->getIntro();

        return $this->collection($intros, new IntroTransformer());
    }

    public function includeLanguages(State $stateDTO): Collection
    {
        $languages = $stateDTO->getLanguages();

        return $this->collection($languages, new LanguageTransformer());
    }

    public function includeCurrentLanguage(State $stateDTO): Item
    {
        $language = $stateDTO->getCurrentLanguage();

        return $this->item($language, new LanguageTransformer());
    }
}