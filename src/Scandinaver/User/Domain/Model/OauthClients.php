<?php


namespace Scandinaver\User\Domain\Model;

use DateTime;

/**
 * Class OauthClients
 *
 * @package Scandinaver\User\Domain\Model
 */
class OauthClients
{
    protected int $id;

    protected int $userId;

    protected string $name;

    protected string $secret;

    protected string $redirect;

    protected bool $personalAccessClient;

    protected bool $passwordClient;

    protected bool $revoked;

    protected ?DateTime $createdAt;

    protected ?DateTime $updatedAt;
}