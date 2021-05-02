<?php


namespace Scandinaver\Puzzle\Domain\Service;

use Scandinaver\Puzzle\Domain\DTO\PuzzleDTO;
use Scandinaver\Puzzle\Domain\Model\Puzzle;
use Scandinaver\Puzzle\Domain\Model\PuzzleText;
use Scandinaver\Puzzle\Domain\Model\PuzzleTranslate;

/**
 * Class PuzzleFactory
 *
 * @package Scandinaver\Puzzle\Domain\Services
 */
class PuzzleFactory
{
    public static function fromDTO(PuzzleDTO $puzzleDTO): Puzzle
    {
        $puzzleText = new PuzzleText($puzzleDTO->getText());
        $puzzleTranslate = new PuzzleTranslate($puzzleDTO->getTranslate());

        return new Puzzle($puzzleText, $puzzleTranslate);
    }

    public static function toDTO(Puzzle $puzzle): PuzzleDTO
    {
        $puzzleDTO = new PuzzleDTO();

        $puzzleDTO->setId($puzzle->getId());
        $puzzleDTO->setText($puzzle->getText()->toNative());
        $puzzleDTO->setTranslate($puzzle->getTranslate()->toNative());

        return $puzzleDTO;
    }
}