<?php


namespace Scandinaver\Common\Domain\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Shared\AggregateRoot;

/**
 * Class AbstractLearnItem
 *
 * @package Scandinaver\Common\Domain\Entity
 */
abstract class AbstractLearnItem extends AggregateRoot
{
    /** @var Collection<int, AbstractPassing>|AbstractPassing[] */
    protected Collection $passings;

    protected bool $active = FALSE;

    protected bool $available = FALSE;

    protected bool $completed = FALSE;

    protected ?AbstractPassing $bestResult = NULL;

    public function isCompletedByUser(UserInterface $user): bool
    {
        foreach ($this->passings as $passing) {
            if ($passing->getUser()->isEqualTo($user) && $passing->isCompleted()) {
                return TRUE;
            }
        }

        return FALSE;
    }

    public function getBestResultForUser(UserInterface $user): ?AbstractPassing
    {
        $bestResult = NULL;

        foreach ($this->passings as $passing) {
            if (!$passing->getUser()->isEqualTo($user)) {
                continue;
            }
            if (NULL === $bestResult) {
                $bestResult = $passing;
            }
            if ($bestResult->getPercent() < $passing->getPercent()) {
                $bestResult = $passing;
            }
        }

        return $bestResult;
    }

    public function getBestResult(): ?AbstractPassing
    {
        return $this->bestResult;
    }

    public function setBestResult(?AbstractPassing $bestResult): void
    {
        $this->bestResult = $bestResult;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    public function isAvailable(): bool
    {
        return $this->available;
    }

    public function setAvailable(bool $available): void
    {
        $this->available = $available;
    }

    public function isCompleted(): bool
    {
        return $this->completed;
    }

    public function setCompleted(bool $completed): void
    {
        $this->completed = $completed;
    }
}