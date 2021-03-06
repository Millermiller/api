<?php


namespace Scandinaver\Puzzle\UI\Resource;

use League\Fractal\TransformerAbstract;
use Scandinaver\Puzzle\Domain\Entity\Puzzle;

/**
 * Class PuzzleTransformer
 *
 * @package Scandinaver\Puzzle\UI\Resource
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