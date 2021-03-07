<?php


namespace Scandinaver\User\Domain\Model;

use Avatar;
use Carbon\Carbon;
use DateTime;
use Doctrine\Common\Collections\{ArrayCollection, Collection};
use Exception;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Routing\UrlGenerator;
use Image;
use Intervention\Image\Constraint;
use JsonSerializable;
use Laravel\Passport\HasApiTokens;
use LaravelDoctrine\ORM\Auth\Authenticatable;
use LaravelDoctrine\ORM\Notifications\Notifiable;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Learn\Domain\Model\PersonalAsset;
use Scandinaver\Learn\Domain\Model\Result;
use Scandinaver\Learn\Domain\Model\Result as AssetResult;
use Scandinaver\RBAC\Domain\Model\Permission;
use Scandinaver\RBAC\Domain\Model\Role;
use Scandinaver\Shared\AggregateRoot;
use Scandinaver\Translate\Domain\Model\Result as TranslateResult;
use Scandinaver\Translate\Domain\Model\Text;
use Scandinaver\User\Domain\Contract\Permissions;
use Scandinaver\User\Domain\Traits\UsesPasswordGrant;

/**
 * Class User
 *
 * @package Scandinaver\User\Domain\Model
 */
class User extends AggregateRoot implements \Illuminate\Contracts\Auth\Authenticatable, CanResetPasswordContract, JsonSerializable, Permissions
{

    use Authenticatable;
    use CanResetPassword;
    use HasApiTokens;
    use Notifiable;
    use UsesPasswordGrant;

    public const ROLE_ADMIN = 1;

    public const ROLE_USER = 0;

    private ?int $id;

    private string $login;

    private string $email;

    private DateTime $activeTo;

    private ?string $name;

    private ?string $photo = NULL;

    private ?string $restoreLink;

    private bool $active;

    private int $assetsOpened = 0;

    private int $assetsCreated = 0;

    private DateTime $createdAt;

    private DateTime $updatedAt;

    private DateTime $lastOnline;

    private Plan $plan;

    private Collection $tests;

    private Collection $translates;

    private Collection $personalAssets;

    private Collection $puzzles;

    private Collection $texts;

    private Collection $posts;

    /**
     * @var Collection | Role[]
     */
    private Collection $roles;

    /**
     * @var Collection | Permission[]
     */
    private Collection $permissions;

    public function __construct()
    {
        $this->tests       = new ArrayCollection();
        $this->texts       = new ArrayCollection();
        $this->translates  = new ArrayCollection();
        $this->roles       = new ArrayCollection();
        $this->permissions = new ArrayCollection();
    }

    public function getKey(): int
    {
        return $this->id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): User
    {
        $this->name = $name;

        return $this;
    }

    public function getPlan(): Plan
    {
        return $this->plan;
    }

    public function setPlan(Plan $plan): void
    {
        $this->plan = $plan;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    public function getCreatedAt(): Carbon
    {
        return Carbon::parse($this->createdAt);
    }

    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getAssetsOpened(): ?int
    {
        return $this->assetsOpened;
    }

    public function setAssetsOpened(int $assetsOpened): User
    {
        $this->assetsOpened = $assetsOpened;

        return $this;
    }

    public function getAssetsCreated(): ?int
    {
        return $this->assetsCreated;
    }

    public function setAssetsCreated(int $assetsCreated): User
    {
        $this->assetsCreated = $assetsCreated;

        return $this;
    }

    public function hasPhoto(): bool
    {
        return $this->photo !== '';
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): void
    {
        $this->photo = $photo;
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function jsonSerialize(): array
    {
        return [
            'id'             => $this->id,
            'login'          => $this->login,
            'email'          => $this->email,
            'active_to'      => $this->getActiveTo() ? $this->getActiveTo()
                                                            ->format(
                                                                "Y-m-d H:i:s"
                                                            ) : NULL,
            'plan'           => $this->plan,
            'plan_id'        => $this->plan->getId(),
            'name'           => $this->name,
            'photo'          => $this->photo,
            'assets_opened'  => $this->assetsOpened,
            'assets_created' => $this->assetsCreated,
            'premium'        => $this->isPremium(),
            'avatar'         => $this->getAvatar(),
        ];
    }

    public function getActiveTo(): ?DateTime
    {
        return $this->activeTo;
    }

    public function setActiveTo(DateTime $activeTo): void
    {
        $this->activeTo = $activeTo;
    }

    public function isPremium(): bool
    {
        return ($this->activeTo > new DateTime());
    }

    /**
     * @return UrlGenerator|string
     */
    public function getAvatar(): string
    {
        $isAvatarExists = file_exists(public_path('/uploads/u/a/').$this->photo);
        $isOrigExists   = file_exists(public_path('/uploads/u/').$this->photo);

        if ($this->photo) {
            if ($isAvatarExists) {
                return '/uploads/u/a/'.$this->photo;
            }
            else {
                if ($isOrigExists) {
                    try {
                        $avatar = Image::make(
                            public_path('/uploads/u/').$this->photo
                        );
                        $avatar->resize(
                            300,
                            NULL,
                            function ($constraint) {
                                /** @var Constraint $constraint */
                                $constraint->aspectRatio();
                            }
                        );
                        $avatar->save(public_path('/uploads/u/a/'.$this->photo));

                        return '/uploads/u/a/'.$this->photo;
                    } catch (Exception $exception) {
                        return Avatar::create($this->login)->toBase64()->encoded;
                    }
                }
                else {
                    return Avatar::create($this->login)->toBase64()->encoded;
                }
            }
        }
        else {
            return Avatar::create($this->login)->toBase64()->encoded;
        }
    }

    public function getActive(): bool
    {
        return (bool)$this->active;
    }

    /**
     * @param  bool  $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    public function incrementAssetCounter(): void
    {
        $this->assetsCreated++;
    }

    public function hasText(Text $text): bool
    {
        foreach ($this->texts as $t) {
            if ($t->getId() === $text->getId()) {
                return TRUE;
            }
        }

        return FALSE;
    }

    /**
     * @param  Role  $role
     *
     * @throws Exception
     */
    public function attachRole(Role $role): void
    {
        if ($this->roles->contains($role)) {
            throw new Exception('Role already assigned');
        }

        $this->roles->add($role);
    }

    /**
     * @param  Role  $role
     *
     * @throws Exception
     */
    public function detachRole(Role $role): void
    {
        if (!$this->roles->contains($role)) {
            throw new Exception('Role not found');
        }

        $this->roles->removeElement($role);
    }

    /**
     * @param  Permission  $permission
     *
     * @throws Exception
     */
    public function allow(Permission $permission): void
    {
        if ($this->permissions->contains($permission)) {
            throw new Exception('Permission already assigned');
        }

        $this->permissions->add($permission);
    }

    /**
     * @param  Permission  $permission
     *
     * @throws Exception
     */
    public function deny(Permission $permission): void
    {
        if (!$this->permissions->contains($permission)) {
            throw new Exception('Permission not assigned');
        }

        $this->permissions->removeElement($permission);
    }

    public function hasRole(string $roleSlug): bool
    {
        foreach ($this->roles as $role) {
            if ($role->getSlug() === $roleSlug) {
                return TRUE;
            }
        }

        return FALSE;
    }

    public function can(string $permissionSlug): bool
    {
        foreach ($this->permissions as $permission) {
            if ($permission->getSlug() === $permissionSlug) {
                return TRUE;
            }
        }

        foreach ($this->roles as $role) {
            foreach ($role->getPermissions() as $permission) {
                if ($permission->getSlug() === $permissionSlug) {
                    return TRUE;
                }
            }
        }

        return FALSE;
    }

    /**
     * @return Collection|Role[]
     */
    public function getRoles(): Collection
    {
        return $this->roles;
    }

    /**
     * @param  Collection|Role[]  $roles
     */
    public function setRoles($roles): void
    {
        $this->roles = $roles;
    }

    /**
     * @return Collection|Permission[]
     */
    public function getPermissions(): Collection
    {
        return $this->permissions;
    }

    public function getAllPermissions(): Collection
    {
        $permissions = $this->permissions;

        foreach ($this->roles as $role) {
            foreach ($role->getPermissions() as $permission) {
                if (!$permissions->contains($permission)) {
                    $permissions->add($permission);
                }
            }
        }

        return $permissions;
    }

    public function toDTO(): UserDTO
    {
        return new UserDTO($this);
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

    /**
     * @param  AssetResult  $result
     */
    public function addTest(AssetResult $result)
    {
        if (!$this->tests->contains($result)) {
            $this->tests->add($result);
        }
    }

    /**
     * @param  TranslateResult  $result
     */
    public function addTranslate(TranslateResult $result)
    {
        if (!$this->translates->contains($result)) {
            $this->translates->add($result);
        }
    }

    /**
     * @param  Text  $text
     */
    public function addText(Text $text): void
    {
        if (!$this->texts->contains($text)) {
            $this->texts->add($text);
        }
        // $this->pushEvent(TextAdded);
    }

    public function getFavouriteAsset(Language $language): ?Asset
    {
        foreach ($this->personalAssets as $asset) {
            /** @var Asset $asset */
            if ($asset->isFavorite() && $asset->getLanguage()->isEqualTo($language)) {
                return $asset;
            }
        }

        return NULL;
    }

    /**
     * @param  Asset  $asset
     *
     * @throws Exception
     */
    public function addPersonalAsset(Asset $asset): void
    {
        if ($this->personalAssets->contains($asset)) {
            throw new Exception("Personal asset already exists");
        }

        $this->personalAssets->add($asset);
    }

    /**
     * @param  Language  $language
     *
     * @return ArrayCollection
     */
    public function getPersonalAssets(Language $language): Collection
    {
        $data = new ArrayCollection();

        foreach ($this->personalAssets as $personalAsset) {
            /** @var Asset $personalAsset */
            if ($personalAsset->getLanguage()->isEqualTo($language)) {
                $data->add($personalAsset);
            }
        }

        return $data;
    }

}
