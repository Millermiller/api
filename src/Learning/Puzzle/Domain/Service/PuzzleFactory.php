<?php


namespace Scandinaver\Learning\Puzzle\Domain\Service;

use Scandinaver\Common\Domain\Service\LanguageTrait;
use Scandinaver\Learning\Asset\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Learning\Puzzle\Domain\DTO\PuzzleDTO;
use Scandinaver\Learning\Puzzle\Domain\Entity\Puzzle;
use Scandinaver\Learning\Puzzle\Domain\Entity\PuzzleText;
use Scandinaver\Learning\Puzzle\Domain\Entity\PuzzleTranslate;

/**
 * Class PuzzleFactory
 *
 * @package Scandinaver\Puzzle\Domain\Services
 */
class PuzzleFactory
{
    use LanguageTrait;

    /**
     * @param  PuzzleDTO  $puzzleDTO
     *
     * @return Puzzle
     * @throws LanguageNotFoundException
     */
    public function fromDTO(PuzzleDTO $puzzleDTO): Puzzle
    {
        $language = $this->getLanguage($puzzleDTO->getLanguageLetter());

        $puzzleText      = new PuzzleText($puzzleDTO->getText());
        $puzzleTranslate = new PuzzleTranslate($puzzleDTO->getTranslate());

        return new Puzzle($puzzleText, $puzzleTranslate, $language);
    }

    public static function toDTO(Puzzle $puzzle): PuzzleDTO
    {
        return PuzzleDTO::fromArray([
            'id'        => $puzzle->getId(),
            'text'      => $puzzle->getText()->toNative(),
            'translate' => $puzzle->getTranslate()->toNative(),
        ]);
    }
}