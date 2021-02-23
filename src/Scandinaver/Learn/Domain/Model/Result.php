<?php


namespace Scandinaver\Learn\Domain\Model;

use DateTime;
use JsonSerializable;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\User\Domain\Model\User;

/**
 * Class Result
 *
 * @package Scandinaver\Learn\Domain\Model
 */
class Result implements JsonSerializable
{
    private $id;

    private Asset $asset;

    private User $user;

    private int $result;

    private DateTime $createdAt;

    private ?DateTime $updatedAt;

    private Language $language;

    public function __construct(Asset $asset, User $user, Language $language, int $result = 0)
    {
        $this->asset    = $asset;
        $this->user     = $user;
        $this->language = $language;
        $this->result   = $result;
    }

    public function getValue(): int
    {
        return $this->result;
    }

    public function setValue(int $value): void
    {
        $this->result = $value;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id'    => $this->id,
            'value' => $this->result,
        ];
    }

    /**
     * @return Asset
     */
    public function getAsset(): Asset
    {
        return $this->asset;
    }

}
