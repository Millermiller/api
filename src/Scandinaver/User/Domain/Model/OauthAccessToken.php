<?php


namespace Scandinaver\User\Domain\Model;

use DateTime;

/**
 * Class OauthAccessToken
 *
 * @package Scandinaver\User\Domain\Model
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