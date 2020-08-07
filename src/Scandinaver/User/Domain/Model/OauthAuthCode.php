<?php


namespace Scandinaver\User\Domain\Model;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class OauthAuthCode
 *
 * @package App\Entities
 * @ORM\Entity
 * @ORM\Table(name="oauth_auth_codes")
 */
class OauthAuthCode
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=100)
     */
    protected string $id;

    /**
     * @ORM\Column(name="user_id", type="integer")
     */
    protected int $userId;

    /**
     * @ORM\Column(name="client_id", type="integer")
     */
    protected int $clientId;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected string $scopes;

    /**
     * @ORM\Column(type="boolean")
     */
    protected bool $revoked;

    /**
     * @ORM\Column(name="expires_at", type="datetime", nullable=true)
     */
    protected DateTime $expiresAt;
}