<?php


namespace Scandinaver\User\UI\Resource;

use Illuminate\Contracts\Container\BindingResolutionException;
use League\Fractal\Resource\{Collection, Primitive};
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

    private AvatarServiceInterface $avatarService;

    /**
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->avatarService = app()->make(AvatarServiceInterface::class);
    }

    protected $availableIncludes = [
        'roles',
        'permissions',
    ];

    protected $defaultIncludes = [
        'avatar',
        'permissionsSimple'
    ];

    public function transform(User $user): array
    {
        return [
            'id'        => $user->getId(),
            'login'     => $user->getLogin(),
            'email'     => $user->getEmail(),
            'active'    => $user->isActive(),
            'active_to' => $user->getRaisedTo(),
        ];
    }

    public function includePermissionsSimple(User $user): Primitive
    {
        $permissions = $user->getAllPermissions();

        $permissionsList = $permissions->map(fn(Permission $permission) => $permission->getSlug());

        return $this->primitive($permissionsList->toArray());
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