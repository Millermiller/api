<?php


namespace Scandinaver\User\Domain\Entity;

use DateTime;

/**
 * Class OauthAuthCode
 *
 * @package Scandinaver\User\Domain\Entity
 */
class OauthAuthCode
{

    protected string $id;

    protected int $userId;

    protected int $clientId;

    protected string $scopes;

    protected bool $revoked;

    protected DateTime $expiresAt;
}