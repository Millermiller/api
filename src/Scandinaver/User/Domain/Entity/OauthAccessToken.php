<?php


namespace Scandinaver\User\Domain\Entity;

use DateTime;

/**
 * Class OauthAccessToken
 *
 * @package Scandinaver\User\Domain\Entity
 */
class OauthAccessToken
{

    protected string $id;

    protected int $userId;

    protected int $clientId;

    protected string $name;

    protected string $scopes;

    protected bool $revoked;

    protected DateTime $createdAt;

    protected ?DateTime $updatedAt;

    protected ?DateTime $expiresAt;
}