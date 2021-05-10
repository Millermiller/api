<?php


namespace Scandinaver\User\Domain\Model;

use DateTime;

/**
 * Class OauthRefreshToken
 *
 * @package Scandinaver\User\Domain\Model
 */
class OauthRefreshToken
{

    protected string $id;

    protected int $accessTokenId;

    protected bool $revoked;

    protected ?DateTime $expiresAt;
}