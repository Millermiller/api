<?php


namespace Scandinaver\Settings\Domain\Model;


use DateTime;
use Scandinaver\Shared\AggregateRoot;

/**
 * Class Setting
 *
 * @package Scandinaver\Settings\Domain\Model
 */
class Setting extends AggregateRoot
{
    const VALUE_KEY = 'value';

    const TYPE_KEY = 'type';

    private ?int $id;

    private string $title;

    private string $slug;

    private array $data = [];

    private DateTime $createdAt;

    private ?DateTime $updatedAt;

    public function __construct()
    {
        $this->data = [
            'value' => NULL,
            'type'  => NULL
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function onDelete()
    {
        // TODO: Implement delete() method.
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        $type = $this->data[self::TYPE_KEY];

        if ($type === 'number') {
            return filter_var($this->data[self::VALUE_KEY], FILTER_VALIDATE_INT);
        }

        if ($type === 'boolean') {
            return filter_var($this->data[self::VALUE_KEY], FILTER_VALIDATE_BOOLEAN);
        }

        return $this->data[self::VALUE_KEY];
    }

    public function getType(): ?string
    {
        return $this->data[self::TYPE_KEY];
    }

    /**
     * @param  mixed  $value
     */
    public function setValue($value)
    {
        $this->data[self::VALUE_KEY] = $value;
    }

    public function setType(string $value): void
    {
        $this->data[self::TYPE_KEY] = $value;
    }


    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }
}