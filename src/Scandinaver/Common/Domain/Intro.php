<?php

namespace Scandinaver\Common\Domain;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * Intro
 *
 * @ORM\Table(name="intro")
 * @ORM\Entity
 */
class Intro implements JsonSerializable
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="page", type="string", length=50, nullable=true)
     */
    private $page;

    /**
     * @var string|null
     *
     * @ORM\Column(name="element", type="string", length=255, nullable=true, options={"default"="undefined"})
     */
    private $element = 'undefined';

    /**
     * @var string|null
     *
     * @ORM\Column(name="intro", type="text", length=65535, nullable=true)
     */
    private $intro;

    /**
     * @var string|null
     *
     * @ORM\Column(name="position", type="string", length=255, nullable=true, options={"default"="false"})
     */
    private $position = 'false';

    /**
     * @var string|null
     *
     * @ORM\Column(name="tooltipClass", type="string", length=255, nullable=true)
     */
    private $tooltipclass;

    /**
     * @var int|null
     *
     * @ORM\Column(name="sort", type="integer", nullable=true, options={"default"="100"})
     */
    private $sort = '100';

    /**
     * @var int|null
     *
     * @ORM\Column(name="active", type="integer", nullable=true)
     */
    private $active;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @param string|null $page
     */
    public function setPage(?string $page): void
    {
        $this->page = $page;
    }

    /**
     * @param string|null $element
     */
    public function setElement(?string $element): void
    {
        $this->element = $element;
    }

    /**
     * @param string|null $intro
     */
    public function setIntro(?string $intro): void
    {
        $this->intro = $intro;
    }

    /**
     * @param string|null $position
     */
    public function setPosition(?string $position): void
    {
        $this->position = $position;
    }

    /**
     * @param string|null $tooltipclass
     */
    public function setTooltipclass(?string $tooltipclass): void
    {
        $this->tooltipclass = $tooltipclass;
    }

    /**
     * @param int|null $sort
     */
    public function setSort(?int $sort): void
    {
        $this->sort = $sort;
    }

    /**
     * @param int|null $active
     */
    public function setActive(?int $active): void
    {
        $this->active = $active;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getPage(): string
    {
        return $this->page;
    }

    /**
     * @return string|null
     */
    public function getElement(): ?string
    {
        return $this->element;
    }

    /**
     * @return string|null
     */
    public function getIntro(): ?string
    {
        return $this->intro;
    }

    /**
     * @return string|null
     */
    public function getPosition(): ?string
    {
        return $this->position;
    }

    /**
     * @return string|null
     */
    public function getTooltipclass(): ?string
    {
        return $this->tooltipclass;
    }

    /**
     * @return int|null
     */
    public function getSort(): ?int
    {
        return $this->sort;
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
