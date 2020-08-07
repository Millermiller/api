<?php


namespace Scandinaver\Common\Domain\Model;

use DateTime;
use JsonSerializable;

/**
 * Class Intro
 *
 * @package Scandinaver\Common\Domain\Model
 */
class Intro implements JsonSerializable
{
    private int $id;

    private string $page;

    private string $element = 'undefined';

    private ?string $intro = null;

    private string $position;

    private string $tooltipclass;

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

    public function getElement(): ?string
    {
        return $this->element;
    }

    public function setElement(string $element): void
    {
        $this->element = $element;
    }

    public function getIntro(): ?string
    {
        return $this->intro;
    }

    public function setIntro(string $intro): void
    {
        $this->intro = $intro;
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
        return $this->tooltipclass;
    }

    public function setTooltipclass(string $tooltipclass): void
    {
        $this->tooltipclass = $tooltipclass;
    }

    public function getSort(): ?int
    {
        return $this->sort;
    }

    public function setSort(int $sort): void
    {
        $this->sort = $sort;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'page' => $this->page,
            'element' => $this->element,
            'intro' => $this->intro,
            'position' => $this->position,
            'tooltipClass' => '',
            'sort' => $this->sort,
        ];
    }
}
