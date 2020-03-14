<?php


namespace Scandinaver\User\Application\Handlers;

use Auth;
use Scandinaver\User\Application\Commands\LogoutCommand;

/**
 * Class LogoutHandler
 * @package Scandinaver\User\Application\Handlers
 */
class LogoutHandler implements LogoutHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param LogoutCommand
     * @inheritDoc
     */
    public function handle($command): void
    {
        setcookie('token', 'w', time()-1000, '/', '.'.config('app.DOMAIN'));
        setcookie('user',  'w', time()-1000, '/', '.'.config('app.DOMAIN'));

        Auth::logout();
    }
} 