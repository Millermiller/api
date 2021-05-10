<?php


namespace Scandinaver\Puzzle\Domain\Service;

use Scandinaver\Common\Domain\Service\LanguageTrait;
use Scandinaver\Learn\Domain\Exception\LanguageNotFoundException;
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