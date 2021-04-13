<?php


namespace Scandinaver\Common\Domain\DTO;

/**
 * Class IntroDTO
 *
 * @package Scandinaver\Common\Domain\DTO
 */
class IntroDTO
{
    private ?int $id;

    private string $page;

    private string $target;

    private string $content;

    private string $position;

    private string $tooltipClass;

    private int $sort;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getPage(): string
    {
        return $this->page;
    }

    public function setPage(string $page): void
    {
        $this->page = $page;
    }

    public function getTarget(): string
    {
        return $this->target;
    }

    public function setTarget(string $target): void
    {
        $this->target = $target;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getPosition(): string
    {
        return $this->position;
    }

    public function setPosition(string $position): void
    {
        $this->position = $position;
    }

    public function getTooltipClass(): string
    {
        return $this->tooltipClass;
    }

    public function setTooltipClass(string $tooltipClass): void
    {
        $this->tooltipClass = $tooltipClass;
    }

    public function getSort(): int
    {
        return $this->sort;
    }

    public function setSort(int $sort): void
    {
        $this->sort = $sort;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}