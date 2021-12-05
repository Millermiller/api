<?php


namespace Scandinaver\User\UI\Resource;

use Illuminate\Contracts\Container\BindingResolutionException;
use JetBrains\PhpStorm\ArrayShape;
use League\Fractal\Resource\{Collection};
use League\Fractal\TransformerAbstract;
use Scandinaver\RBAC\Domain\Entity\Permission;
use Scandinaver\RBAC\UI\Resource\PermissionTransformer;
use Scandinaver\RBAC\UI\Resource\RoleTransformer;
use Scandinaver\User\Domain\Contract\Service\AvatarServiceInterface;
use Scandinaver\User\Domain\Entity\User;

/**
 * Class UserTransformer
 *
 * @package Scandinaver\User\UI\Resource
 */
class UserTransformer extends TransformerAbstract
{

    protected $availableIncludes = [
        'roles',
        'permissions',
    ];

    protected $defaultIncludes = [

    ];

    private AvatarServiceInterface $avatarService;

    /**
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->avatarService = app()->make(AvatarServiceInterface::class);
    }


    #[ArrayShape([
        'id'                => "int",
        'login'             => "string",
        'email'             => "string",
        'active'            => "bool",
        'active_to'         => "string",
        'permissionsSimple' => "string[]",
        'avatar'            => "null|string",
    ])]
    public function transform(User $user): array
    {
        return [
            'id'                => $user->getId(),
            'login'             => $user->getLogin(),
            'email'             => $user->getEmail(),
            'active'            => $user->isActive(),
            'active_to'         => $user->getRaisedTo()->format('Y-m-d H:i:s'),
            'permissionsSimple' => $user->getAllPermissions()->map(fn(Permission $permission) => $permission->getSlug())->toArray(),
            'avatar'            => $this->getAvatar($user),
        ];
    }

    //public function includePermissionsSimple(User $user): Primitive
    //{
    //    $permissions = $user->getAllPermissions();
    //    $permissionsList = $permissions->map(fn(Permission $permission) => $permission->getSlug());
    //    return $this->primitive($permissionsList->toArray());
    //}

    public function includeRoles(User $user): Collection
    {
        $roles = $user->getRoles();

        return $this->collection($roles, new RoleTransformer(), 'roles');
    }

    public function includePermissions(User $user): Collection
    {
        $permissions = $user->getAllPermissions();

        return $this->collection($permissions, new PermissionTransformer(), 'permissions');
    }

    private function getAvatar(User $user): ?string
    {
        $photo = $user->getPhoto();

        if ($photo === NULL) {
            return $this->avatarService->getAvatar($user);
        }

        return NULL;
    }
}