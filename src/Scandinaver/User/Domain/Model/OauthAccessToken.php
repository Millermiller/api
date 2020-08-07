<?php


namespace Scandinaver\User\Domain\Model;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class OauthAccessTokens
 *
 * @package App\Entities
 * @ORM\Entity
 * @ORM\Table(name="oauth_access_tokens", indexes={@ORM\Index(name="user_id_token_index", columns={"user_id"})})
 */
class OauthAccessToken
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=100)
     */
    protected string $id;

    /**
     * @ORM\Column(name="user_id", type="integer", nullable=true)
     */
    protected int $userId;

    /**
     * @ORM\Column(name="client_id", type="integer")
     */
    protected int $clientId;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected string $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected string $scopes;

    /**
     * @ORM\Column(type="boolean")
     */
    protected bool $revoked;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    protected DateTime $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected ?DateTime $updatedAt;

    /**
     * @ORM\Column(name="expires_at", type="datetime", nullable=true)
     */
    protected ?DateTime $expiresAt;
}