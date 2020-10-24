<?php


namespace Scandinaver\Puzzle\Domain;

use Scandinaver\Common\Domain\Services\LanguageTrait;
use Scandinaver\Puzzle\Domain\Contract\Repository\PuzzleRepositoryInterface;
use Scandinaver\Puzzle\Domain\Exception\PuzzleNotFoundException;
use Scandinaver\Puzzle\Domain\Model\Puzzle;
use Scandinaver\Puzzle\Domain\Model\PuzzleDTO;
use Scandinaver\Puzzle\Domain\Model\PuzzleText;
use Scandinaver\Puzzle\Domain\Model\PuzzleTranslate;
use Scandinaver\User\Domain\Model\User;

/**
 * Class PuzzleService
 *
 * @package Scandinaver\Puzzle\Domain
 */
class PuzzleService
{
    use LanguageTrait;

    private PuzzleRepositoryInterface $puzzleRepository;

    public function __construct(PuzzleRepositoryInterface $puzzleRepository)
    {
        $this->puzzleRepository = $puzzleRepository;
    }

    public function create(string $language, array $data)
    {
        $language = $this->getLanguage($language);
        $puzzle = new Puzzle(new PuzzleText($data['text']), new PuzzleTranslate($data['translate']));
        $puzzle->setLanguage($language);

        $this->puzzleRepository->save($puzzle);
    }

    public function allByLanguage(string $language): array
    {
        $language = $this->getLanguage($language);

        $response = [];

        /** @var Puzzle[] $puzzles */
        $puzzles = $this->puzzleRepository->getByLanguage($language);

        foreach ($puzzles as $puzzle) {
            $response[] = $puzzle->toDTO();
        }

        return $response;
    }

    public function one(int $puzzleId): PuzzleDTO
    {
        /** @var Puzzle $puzzle */
        $puzzle = $this->puzzleRepository->find($puzzleId);

        return $puzzle->toDTO();
    }

    public function delete(int $puzzleId)
    {
        $puzzle = $this->getPuzzle($puzzleId);

        $puzzle->delete();

        $this->puzzleRepository->delete($puzzle);
    }

    public function completed(User $user, int $puzzleId): void
    {
        $puzzle = $this->getPuzzle($puzzleId);

        //todo: refactor
        $this->puzzleRepository->addForUser($user, $puzzle);
    }

    public function getForUser(string $language, User $user): array
    {
        $language = $this->getLanguage($language);

        $response = [];

        /** @var Puzzle[] $puzzles */
        $puzzles = $this->puzzleRepository->getForUser($language, $user);
        foreach ($puzzles as $puzzle) {
            $response[] = $puzzle->toDTO();
        }

        return $response;
    }

    private function getPuzzle(int $puzzleId): Puzzle
    {
        /** @var Puzzle $puzzle */
        $puzzle = $this->puzzleRepository->find($puzzleId);

        if ($puzzle === null) {
            throw new PuzzleNotFoundException();
        }

        return $puzzle;
    }
}