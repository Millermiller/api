<?php


namespace Scandinaver\Learning\Puzzle\Domain\Service;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Service\LanguageTrait;
use Scandinaver\Learning\Asset\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Learning\Puzzle\Domain\Contract\Repository\PuzzleRepositoryInterface;
use Scandinaver\Learning\Puzzle\Domain\DTO\PuzzleDTO;
use Scandinaver\Learning\Puzzle\Domain\Exception\PuzzleNotFoundException;
use Scandinaver\Learning\Puzzle\Domain\Entity\Puzzle;
use Scandinaver\Shared\Contract\BaseServiceInterface;

/**
 * Class PuzzleService
 *
 * @package Scandinaver\Puzzle\Domain
 */
class PuzzleService implements BaseServiceInterface
{

    use LanguageTrait;

    private PuzzleRepositoryInterface $puzzleRepository;

    private PuzzleFactory $puzzleFactory;

    public function __construct(PuzzleRepositoryInterface $puzzleRepository, PuzzleFactory $puzzleFactory)
    {
        $this->puzzleRepository = $puzzleRepository;
        $this->puzzleFactory    = $puzzleFactory;
    }

    public function one(int $id): Puzzle
    {
        return $this->puzzleRepository->find($id);
    }

    /**
     * @param  PuzzleDTO  $puzzleDTO
     *
     * @throws LanguageNotFoundException
     */
    public function create(PuzzleDTO $puzzleDTO)
    {
        $puzzle = $this->puzzleFactory->fromDTO($puzzleDTO);

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

        return $this->puzzleRepository->getByLanguage($language);
    }

    /**
     * @param  int  $id
     *
     * @throws PuzzleNotFoundException
     */
    public function delete(int $id)
    {
        $puzzle = $this->getPuzzle($id);

        $this->puzzleRepository->delete($puzzle);
    }

    /**
     * @param  int  $puzzleId
     *
     * @return Puzzle
     * @throws PuzzleNotFoundException
     */
    private function getPuzzle(int $puzzleId): Puzzle
    {
        $puzzle = $this->puzzleRepository->find($puzzleId);

        if ($puzzle === NULL) {
            throw new PuzzleNotFoundException();
        }

        return $puzzle;
    }

    /**
     * @param  UserInterface  $user
     * @param  int            $id
     *
     * @throws PuzzleNotFoundException
     */
    public function completed(UserInterface $user, int $id): void
    {
        $puzzle = $this->getPuzzle($id);

        //todo: refactor
        $this->puzzleRepository->addForUser($user, $puzzle);
    }

    /**
     * @param  string         $language
     * @param  UserInterface  $user
     *
     * @return Puzzle[]
     * @throws LanguageNotFoundException
     */
    public function getForUser(string $language, UserInterface $user): array
    {
        $language = $this->getLanguage($language);

        return $this->puzzleRepository->getForUser($language, $user);
    }

    public function all(): array
    {
        // TODO: Implement all() method.
    }

}