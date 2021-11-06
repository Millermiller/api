<?php


namespace Scandinaver\Common\Domain\DTO;

use Scandinaver\Shared\DTO;

/**
 * Class IntroDTO
 *
 * @package Scandinaver\Common\Domain\DTO
 */
class IntroDTO extends DTO
{
    private ?int $id;

    private string $page;

    private ?string $target;

    private string $content;

    private string $position;

    private ?string $header;

    private int $sort;

    private bool $active;

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

    public function getTarget(): ?string
    {
        return $this->target;
    }

    public function setTarget(?string $target): void
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

    public function getHeader(): ?string
    {
        return $this->header;
    }

    public function setHeader(?string $header): void
    {
        $this->header = $header;
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


    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    public static function fromArray(array $data): IntroDTO
    {
        $introDTO = new self();

        $introDTO->setId($data['id'] ?? NULL);
        $introDTO->setPage($data['page']);
        $introDTO->setTarget($data['target']);
        $introDTO->setContent($data['content']);
        $introDTO->setPosition($data['position']);
        $introDTO->setHeader($data['headerText']);
        $introDTO->setSort($data['sort']);
        $introDTO->setActive($data['active']);

        return $introDTO;
    }

}