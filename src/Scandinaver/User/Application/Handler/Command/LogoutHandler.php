<?php


namespace Scandinaver\User\Application\Handler\Command;

use Auth;
use Laravel\Passport\Token;
use League\Fractal\Resource\NullResource;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;
use Scandinaver\User\Domain\Contract\Command\LogoutHandlerInterface;
use Scandinaver\User\UI\Command\LogoutCommand;

/**
 * Class LogoutHandler
 *
 * @package Scandinaver\User\Application\Handler\Command
 */
class LogoutHandler extends AbstractHandler implements LogoutHandlerInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  LogoutCommand|Command  $command
     */
    public function handle($command): void
    {
        setcookie('authfrontend._token.local', FALSE, time() - 1000, '/', '.' . config('app.DOMAIN'));

        /** @var Token $token */
        $token = Auth::user()->token();

        $token->revoke();

        $this->resource = new NullResource();
    }
} 