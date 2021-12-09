<?php


namespace Scandinaver\User\Application\Handler\Command;

use Auth;
use Laravel\Passport\Token;
use League\Fractal\Resource\NullResource;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
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
     * TODO: refactor
     * @param  CommandInterface|LogoutCommand  $command
     */
    public function handle(CommandInterface|LogoutCommand $command): void
    {
        setcookie('authfrontend._token.local', FALSE, time() - 1000, '/', '.' . config('app.DOMAIN'));

        /** @var Token $token */
        $token = Auth::user()->token();

        $token->revoke();

        $this->resource = new NullResource();
    }
} 