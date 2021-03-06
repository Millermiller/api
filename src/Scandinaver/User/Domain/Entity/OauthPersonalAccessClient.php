<?php


namespace Scandinaver\User\Domain\Entity;

use DateTime;

/**
 * Class OauthPersonalAccessClient
 *
 * @package Scandinaver\User\Domain\Entity
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