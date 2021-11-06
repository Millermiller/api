<?php


namespace Scandinaver\User\Domain\Entity;

use DateTime;

/**
 * Class OauthRefreshToken
 *
 * @package Scandinaver\User\Domain\Entity
 */
class OauthRefreshToken
{

    protected string $id;

    protected int $accessTokenId;

    protected bool $revoked;

    protected ?DateTime $expiresAt;
}