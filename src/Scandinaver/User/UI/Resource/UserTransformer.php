<?php


namespace Scandinaver\User\UI\Resource;

use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Primitive;
use League\Fractal\TransformerAbstract;
use Scandinaver\RBAC\UI\Resource\PermissionTransformer;
use Scandinaver\RBAC\UI\Resource\RoleTransformer;
use Scandinaver\User\Domain\Contract\Service\AvatarServiceInterface;
use Scandinaver\User\Domain\Model\User;

/**
 * Class UserTransformer
 *
 * @package Scandinaver\User\UI\Resource
 */
class UserTransformer extends TransformerAbstract
{

    private AvatarServiceInterface $avatarService;

    public function __construct()
    {
        $this->avatarService = app()->make(AvatarServiceInterface::class);
    }

    protected $defaultIncludes = [
        'roles',
        'permissions',
        'avatar',
    ];

    public function transform(User $user): array
    {
        return [
            'id'        => $user->getId(),
            'login'     => $user->getLogin(),
            'email'     => $user->getEmail(),
            'active'    => $user->isActive(),
            'plan'      => $user->getPlan(),
            'active_to' => $user->getActiveTo(),
        ];
    }

    public function includeRoles(User $user): Collection
    {
        $roles = $user->getRoles();

        return $this->collection($roles, new RoleTransformer());
    }

    public function includePermissions(User $user): Collection
    {
        $permissions = $user->getAllPermissions();

        return $this->collection($permissions, new PermissionTransformer());
    }

    public function includeAvatar(User $user): Primitive
    {
        $photo = $user->getPhoto();

        if ($photo === NULL) {
            return $this->primitive($this->avatarService->getAvatar($user));
        }

        return $this->primitive(asset('/uploads/u/' . $photo));
    }
}