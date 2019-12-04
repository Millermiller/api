<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * OauthClients
 *
 * @ORM\Table(name="oauth_clients", indexes={@ORM\Index(name="oauth_clients_user_id_index", columns={"user_id"})})
 * @ORM\Entity
 */
class OauthClients
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="user_id", type="integer", nullable=true)
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="secret", type="string", length=100, nullable=false)
     */
    private $secret;

    /**
     * @var string
     *
     * @ORM\Column(name="redirect", type="text", length=65535, nullable=false)
     */
    private $redirect;

    /**
     * @var bool
     *
     * @ORM\Column(name="personal_access_client", type="boolean", nullable=false)
     */
    private $personalAccessClient;

    /**
     * @var bool
     *
     * @ORM\Column(name="password_client", type="boolean", nullable=false)
     */
    private $passwordClient;

    /**
     * @var bool
     *
     * @ORM\Column(name="revoked", type="boolean", nullable=false)
     */
    private $revoked;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;


}
