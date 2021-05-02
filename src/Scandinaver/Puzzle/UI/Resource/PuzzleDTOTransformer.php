<?php


namespace Scandinaver\Puzzle\UI\Resource;

use League\Fractal\TransformerAbstract;
use Scandinaver\Puzzle\Domain\DTO\PuzzleDTO;

/**
 * Class PuzzleTransformer
 *
 * @package Scandinaver\Puzzle\UI\Resource
 */
class PuzzleDTOTransformer extends TransformerAbstract
{
    public function transform(PuzzleDTO $puzzleDTO): array
    {
        return [
            'id'        => $puzzleDTO->getId(),
            'text'      => $puzzleDTO->getText(),
            'translate' => $puzzleDTO->getTranslate(),
        ];
    }
}