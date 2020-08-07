<?php


namespace Scandinaver\Learn\Domain\Model;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\User\Domain\Model\User;

/**
 * Result
 * @ORM\Table(name="asset_user", indexes={
 *     @ORM\Index(name="language_id", columns={"language_id"}),
 *      @ORM\Index(name="user_id", columns={"user_id"}),
 *     @ORM\Index(name="asset_id", columns={"asset_id"})
 * })
 *
 * @ORM\Entity
 */
class Result implements JsonSerializable
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @ORM\Column(name="result", type="integer", nullable=false)
     */
    private int $result;

    /**
     * @ORM\Column(name="asset_id", type="integer", nullable=false)
     */
    private int $assetId;

    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private DateTime $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private ?DateTime $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="Scandinaver\Learn\Domain\Model\Asset", inversedBy="results")
     * @ORM\JoinColumn(name="asset_id", referencedColumnName="id")
     */
    private Asset $asset;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="Scandinaver\User\Domain\Model\User", inversedBy="results")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private User $user;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="Scandinaver\Common\Domain\Model\Language", inversedBy="results")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     */
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
