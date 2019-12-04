<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * OauthAuthCodes
 *
 * @ORM\Table(name="oauth_auth_codes")
 * @ORM\Entity
 */
class OauthAuthCodes
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=100, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    private $userId;

    /**
     * @var int
     *
     * @ORM\Column(name="client_id", type="integer", nullable=false)
     */
    private $clientId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="scopes", type="text", length=65535, nullable=true)
     */
    private $scopes;

    /**
     * @var bool
     *
     * @ORM\Column(name="revoked", type="boolean", nullable=false)
     */
    private $revoked;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="expires_at", type="datetime", nullable=true)
     */
    private $expiresAt;


}
