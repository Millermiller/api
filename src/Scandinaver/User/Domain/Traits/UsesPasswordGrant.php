<?php


namespace Scandinaver\User\Domain\Traits;

use EntityManager;
use Scandinaver\User\Domain\Model\User;

/**
 * Trait UsesPasswordGrant
 *
 * @package App\Entities\Traits
 */
trait UsesPasswordGrant
{
    public function findForPassport($userIdentifier)
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