<?php


namespace Scandinaver\User\Domain\Model;

use DateTime;

/**
 * Class OauthAuthCode
 *
 * @package Scandinaver\User\Domain\Model
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