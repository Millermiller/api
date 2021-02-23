<?php


namespace Scandinaver\Puzzle\Domain;

use Scandinaver\Common\Domain\Services\LanguageTrait;
use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Puzzle\Domain\Contract\Repository\PuzzleRepositoryInterface;
use Scandinaver\Puzzle\Domain\Exception\PuzzleNotFoundException;
use Scandinaver\Puzzle\Domain\Model\Puzzle;
use Scandinaver\Puzzle\Domain\Model\PuzzleDTO;
use Scandinaver\Puzzle\Domain\Model\PuzzleText;
use Scandinaver\Puzzle\Domain\Model\PuzzleTranslate;
use Scandinaver\Shared\Contract\BaseServiceInterface;
use Scandinaver\User\Domain\Model\User;

/**
 * Class PuzzleService
 *
 * @package Scandinaver\Puzzle\Domain
 */
class PuzzleService implements BaseServiceInterface
{
    use LanguageTrait;

    private PuzzleRepositoryInterface $puzzleRepository;

    public function __construct(PuzzleRepositoryInterface $puzzleRepository)
    {
        $this->puzzleRepository = $puzzleRepository;
    }

    public function one(int $id): PuzzleDTO
    {
        /** @var Puzzle $puzzle */
        $puzzle = $this->puzzleRepository->find($id);

        return $puzzle->toDTO();
    }

    /**
     * @param  string  $language
     * @param  array   $data
     *
     * @throws LanguageNotFoundException
     */
    public function create(string $language, array $data)
    {
        $language = $this->getLanguage($language);
        $puzzle   = new Puzzle(new PuzzleText($data['text']), new PuzzleTranslate($data['translate']));
        $puzzle->setLanguage($language);

        $this->puzzleRepository->save($puzzle);
    }

    /**
     * @param  string  $language
     *
     * @return array
     * @throws LanguageNotFoundException
     */
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

    /**
     * @param  int  $id
     *
     * @throws PuzzleNotFoundException
     */
    public function delete(int $id)
    {
        $puzzle = $this->getPuzzle($id);

        $puzzle->delete();

        $this->puzzleRepository->delete($puzzle);
    }

    /**
     * @param  User  $user
     * @param  int   $id
     *
     * @throws PuzzleNotFoundException
     */
    public function completed(User $user, int $id): void
    {
        $puzzle = $this->getPuzzle($id);

        //todo: refactor
        $this->puzzleRepository->addForUser($user, $puzzle);
    }

    /**
     * @param  string  $language
     * @param  User    $user
     *
     * @return array
     * @throws LanguageNotFoundException
     */
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

    /**
     * @param  int  $puzzleId
     *
     * @return Puzzle
     * @throws PuzzleNotFoundException
     */
    private function getPuzzle(int $puzzleId): Puzzle
    {
        /** @var Puzzle $puzzle */
        $puzzle = $this->puzzleRepository->find($puzzleId);

        if ($puzzle === NULL) {
            throw new PuzzleNotFoundException();
        }

        return $puzzle;
    }

    public function all(): array
    {
        // TODO: Implement all() method.
    }

}