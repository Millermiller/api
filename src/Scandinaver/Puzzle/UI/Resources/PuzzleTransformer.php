<?php


namespace Scandinaver\Puzzle\UI\Resources;

use League\Fractal\TransformerAbstract;
use Scandinaver\Puzzle\Domain\Model\Puzzle;

/**
 * Class PuzzleTransformer
 *
 * @package Scandinaver\Puzzle\UI\Resources
 */
class PuzzleTransformer extends TransformerAbstract
{
    public function transform(Puzzle $puzzle): array
    {
        return [
            'id'        => $puzzle->getId(),
            'text'      => $puzzle->getText()->toNative(),
            'translate' => $puzzle->getTranslate()->toNative(),
        ];
    }
}