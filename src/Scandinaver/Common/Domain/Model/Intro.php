<?php


namespace Scandinaver\Common\Domain\Model;

use DateTime;
use Scandinaver\Shared\AggregateRoot;

/**
 * Class Intro
 *
 * @package Scandinaver\Common\Domain\Model
 */
class Intro extends AggregateRoot
{
    private int $id;

    private string $page;

    private string $target = 'undefined';

    private ?string $content = NULL;

    private string $position;

    private string $tooltipClass;

    private int $sort;

    private bool $active;

    private DateTime $createdAt;

    private DateTime $updatedAt;

    public function setActive(int $active): void
    {
        $this->active = $active;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPage(): string
    {
        return $this->page;
    }

    public function setPage(string $page): void
    {
        $this->page = $page;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): void
    {
        $this->position = $position;
    }

    public function getTooltipclass(): ?string
    {
        return $this->tooltipClass;
    }

    public function setTooltipclass(string $tooltipClass): void
    {
        $this->tooltipClass = $tooltipClass;
    }

    public function getSort(): ?int
    {
        return $this->sort;
    }

    public function setSort(int $sort): void
    {
        $this->sort = $sort;
    }

    public function toDTO(): IntroDTO
    {
        return new IntroDTO($this);
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): void
    {
        $this->content = $content;
    }

    public function getTarget(): string
    {
        return $this->target;
    }

    public function setTarget(string $target): void
    {
        $this->target = $target;
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }
}
