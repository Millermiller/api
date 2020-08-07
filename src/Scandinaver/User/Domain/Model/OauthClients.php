<?php


namespace Scandinaver\User\Domain\Model;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * OauthClients
 *
 * @package App\Entities
 * @ORM\Entity
 * @ORM\Table(name="oauth_clients", indexes={@ORM\Index(name="user_id_client_index", columns={"user_id"})})
 */
class OauthClients
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    protected int $id;

    /**
     * @ORM\Column(name="user_id", type="integer", nullable=true)
     */
    protected int $userId;

    /**
     * @ORM\Column(type="string")
     */
    protected string $name;

    /**
     * @ORM\Column(name="secret", type="string", length=100)
     */
    protected string $secret;

    /**
     * @ORM\Column(type="text")
     */
    protected string $redirect;

    /**
     * @ORM\Column(name="personal_access_client", type="boolean")
     */
    protected bool $personalAccessClient;

    /**
     * @ORM\Column(name="password_client", type="boolean")
     */
    protected bool $passwordClient;

    /**
     * @ORM\Column(type="boolean")
     */
    protected bool $revoked;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected ?DateTime $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected ?DateTime $updatedAt;
}