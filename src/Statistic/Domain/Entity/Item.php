<?php


namespace Scandinaver\Statistic\Domain\Entity;

use DateTime;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Core\Domain\Contract\UserInterface;

/**
 * Class Item
 *
 * @package Scandinaver\Statistic\Domain\Entity
 */
class Item
{

    public const ASSET            = 'ASSET_OPEN';
    public const ASSET_CREATED    = 'ASSET_CREATED';
    public const TEST_PASSED      = 'TEST_PASSED';
    public const TEST_CORRECT     = 'TEST_CORRECT';
    public const TEST_TIME        = 'TEST_TIME';
    public const CARD_ADDED       = 'CARD_ADDED';
    public const CARD_CREATED     = 'CARD_CREATED';
    public const TRANSLATE_PASSED = 'TRANSLATE';
    public const PUZZLE_PASSED    = 'PUZZLE_PASSED';

    private ?int $id = NULL;

    private string $type;

    private ?int $value;

    private ?array $data;

    private UserInterface $user;

    private Language $language;

    private DateTime $createdAt;

    private ?DateTime $updatedAt;

    public function __construct(string $type, UserInterface $user, ?int $value, ?array $data)
    {
        $this->type = $type;
        $this->user = $user;
        $this->value = $value;
        $this->data = $data;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function getData(): ?array
    {
        return $this->data;
    }
}