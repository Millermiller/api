<?php


namespace Scandinaver\User\Application\Handlers;

use Auth;
use Laravel\Passport\Token;
use Scandinaver\User\Application\Commands\LogoutCommand;

/**
 * Class LogoutHandler
 *
 * @package Scandinaver\User\Application\Handlers
 */
class LogoutHandler implements LogoutHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param LogoutCommand
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        setcookie('authfrontend._token.local', false, time() - 1000, '/', '.' . config('app.DOMAIN'));

        /** @var Token $token */
        $token = Auth::user()->token();

        $token->revoke();
    }
} 