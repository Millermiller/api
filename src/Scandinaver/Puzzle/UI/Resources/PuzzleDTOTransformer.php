<?php


namespace Scandinaver\Puzzle\UI\Resources;

use League\Fractal\TransformerAbstract;
use Scandinaver\Puzzle\Domain\DTO\PuzzleDTO;

/**
 * Class PuzzleTransformer
 *
 * @package Scandinaver\Puzzle\UI\Resources
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