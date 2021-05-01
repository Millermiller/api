<?php


namespace Scandinaver\User\Application\Handler\Command;

use Auth;
use Laravel\Passport\Token;
use League\Fractal\Resource\NullResource;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\User\UI\Command\LogoutCommand;

/**
 * Class LogoutCommandHandler
 *
 * @package Scandinaver\User\Application\Handler\Command
 */
class LogoutCommandHandler extends AbstractHandler
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  LogoutCommand|CommandInterface  $command
     */
    public function handle(CommandInterface $command): void
    {
        setcookie('authfrontend._token.local', FALSE, time() - 1000, '/', '.' . config('app.DOMAIN'));

        /** @var Token $token */
        $token = Auth::user()->token();

        $token->revoke();

        $this->resource = new NullResource();
    }
} 