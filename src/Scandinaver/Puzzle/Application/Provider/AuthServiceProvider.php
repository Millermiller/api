<?php


namespace Scandinaver\Puzzle\Application\Provider;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Puzzle\Domain\Permission\Puzzle;

/**
 * Class AuthServiceProvider
 *
 * @package Scandinaver\Puzzle\Application\Provider
 */
class AuthServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Gate::define(Puzzle::VIEW, fn(UserInterface $user): bool => $user->can(Puzzle::VIEW));

        Gate::define('view-puzzles-by-user', fn(UserInterface $user): bool => TRUE);

        Gate::define(Puzzle::SHOW, fn(UserInterface $user, int $puzzleId): bool => $user->can(Puzzle::SHOW));

        Gate::define(Puzzle::CREATE, fn(UserInterface $user): bool => $user->can(Puzzle::CREATE));

        Gate::define(Puzzle::UPDATE, fn(UserInterface $user, int $puzzleId): bool => $user->can(Puzzle::UPDATE));

        Gate::define(Puzzle::COMPLETE, fn(UserInterface $user, int $puzzleId): bool => $user->can(Puzzle::COMPLETE));

        Gate::define(Puzzle::DELETE, fn(UserInterface $user, int $puzzleId): bool => $user->can(Puzzle::DELETE));
    }
}