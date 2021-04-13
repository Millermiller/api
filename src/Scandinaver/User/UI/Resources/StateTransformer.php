<?php


namespace Scandinaver\User\UI\Resources;

use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;
use Scandinaver\Common\UI\Resources\IntroDTOTransformer;
use Scandinaver\Common\UI\Resources\LanguageDTOTransformer;
use Scandinaver\Learn\UI\Resources\AssetDTOTransformer;
use Scandinaver\Puzzle\UI\Resources\PuzzleDTOTransformer;
use Scandinaver\Translate\UI\Resources\TextDTOTransformer;
use Scandinaver\User\Domain\DTO\StateDTO;

/**
 * Class StateTransformer
 *
 * @package Scandinaver\User\UI\Resources
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
        'sites',
    ];

    public function transform(StateDTO $stateDTO): array
    {
        return [
            'site'        => $stateDTO->getSite(),
            'favourite'   => $stateDTO->getFavouriteAssetDTO(),
            'texts'       => $stateDTO->getTextsDTO(),
            'currentSite' => $stateDTO->getCurrentSite(),
            'domain'      => $stateDTO->getDomain(),
        ];
    }

    public function includeWords(StateDTO $stateDTO): Collection
    {
        $wordsDTO = $stateDTO->getWordsDTO();

        return $this->collection($wordsDTO, new AssetDTOTransformer());
    }

    public function includeSentences(StateDTO $stateDTO): Collection
    {
        $sentencesDTO = $stateDTO->getSentencesDTO();

        return $this->collection($sentencesDTO, new AssetDTOTransformer());
    }

    public function includePersonal(StateDTO $stateDTO): Collection
    {
        $personalDTO = $stateDTO->getPersonalDTO();

        return $this->collection($personalDTO, new AssetDTOTransformer());
    }

    public function includeFavourite(StateDTO $stateDTO): Item
    {
        $favouriteDTO = $stateDTO->getFavouriteAssetDTO();

        return $this->item($favouriteDTO, new AssetDTOTransformer());
    }

    public function includeTexts(StateDTO $stateDTO): Collection
    {
        $textsDTO = $stateDTO->getTextsDTO();

        return $this->collection($textsDTO, new TextDTOTransformer());
    }

    public function includePuzzles(StateDTO $stateDTO): Collection
    {
        $puzzlesDTO = $stateDTO->getPuzzlesDTO();

        return $this->collection($puzzlesDTO, new PuzzleDTOTransformer());
    }

    public function includeIntro(StateDTO $stateDTO): Collection
    {
        $introDTO = $stateDTO->getIntroDTO();

        return $this->collection($introDTO, new IntroDTOTransformer());
    }

    public function includeSites(StateDTO $stateDTO): Collection
    {
        $languagesDTO = $stateDTO->getLanguagesDTO();

        return $this->collection($languagesDTO, new LanguageDTOTransformer());
    }
}