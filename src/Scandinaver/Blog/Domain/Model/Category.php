<?php


namespace Scandinaver\Blog\Domain\Model;

use DateTime;
use JsonSerializable;

/**
 * Class Category
 *
 * @package Scandinaver\Blog\Domain\Model
 */
class Category implements JsonSerializable
{
    private int $id;

    private string $name;

    private ?DateTime $createdAt;

    private ?DateTime $updatedAt;

    private $posts;

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }

    /**
     * @return Post[]
     */
    public function getPosts(): array
    {
        return $this->posts;
    }
}
