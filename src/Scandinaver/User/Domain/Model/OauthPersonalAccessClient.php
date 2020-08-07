<?php


namespace Scandinaver\User\Domain\Model;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class OauthPersonalAccessClient
 *
 * @package App\Entities
 * @ORM\Entity
 * @ORM\Table(name="oauth_personal_access_clients", indexes={@ORM\Index(name="client_id_index", columns={"client_id"})})
 */
class OauthPersonalAccessClient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    protected int $id;

    /**
     * @ORM\Column(name="client_id", type="integer")
     */
    protected int $clientId;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected ?DateTime $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected ?DateTime $updatedAt;
}