<?php


namespace Scandinaver\User\Domain\Traits;

use EntityManager;
use Scandinaver\User\Domain\Entity\User;

/**
 * Trait UsesPasswordGrant
 *
 * @package App\Entities\Traits
 */
trait UsesPasswordGrant
{

    public function findForPassport(string $userIdentifier): ?User
    {
        $userRepository = EntityManager::getRepository(get_class($this));

        $login_type = filter_var($userIdentifier, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'login';

        return $userRepository->findOneBy(
            [
                $login_type => $userIdentifier,
            ]
        );
    }
}