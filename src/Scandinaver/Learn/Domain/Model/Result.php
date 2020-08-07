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
    private int $id;

    private int $result;

    private int $assetId;

    private DateTime $createdAt;

    private ?DateTime $updatedAt;

    private Asset $asset;

    private User $user;

    private Language $language;

    /**
     * Result constructor.
     *
     * @param  Asset     $asset
     * @param  User      $user
     * @param  Language  $language
     */
    public function __construct(Asset $asset, User $user, Language $language)
    {
        $this->asset = $asset;
        $this->user = $user;
        $this->language = $language;
    }

    public function getValue(): int
    {
        return $this->result;
    }

    public function setValue(int $value): void
    {
        $this->result = $value;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'value' => $this->result,
        ];
    }
}
