<?php


namespace Scandinaver\Common\Domain\Model;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * Intro
 * @ORM\Table(name="intro")
 *
 * @ORM\Entity
 */
class Intro implements JsonSerializable
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @ORM\Column(name="page", type="string", length=50, nullable=true)
     */
    private string $page;

    /**
     * @ORM\Column(name="element", type="string", length=255, nullable=true,
     *   options={"default"="undefined"})
     */
    private string $element = 'undefined';

    /**
     * @ORM\Column(name="intro", type="text", length=65535, nullable=true)
     */
    private ?string $intro = null;

    /**
     * @ORM\Column(name="position", type="string", length=255, nullable=true,
     *   options={"default"="false"})
     */
    private string $position ;

    /**
     * @ORM\Column(name="tooltipClass", type="string", length=255,
     *   nullable=true)
     */
    private string $tooltipclass;

    /**
     * @ORM\Column(name="sort", type="integer", nullable=true,
     *   options={"default"="100"})
     */
    private int $sort;

    /**
     * @ORM\Column(name="active", type="integer", nullable=true)
     */
    private int $active;

    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private DateTime $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private DateTime $updatedAt;

    /**
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private DateTime $deletedAt;

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
