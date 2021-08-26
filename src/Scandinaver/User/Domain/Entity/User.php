<?php


namespace Scandinaver\User\Domain\Entity;

use Carbon\Carbon;
use DateTime;
use Doctrine\Common\Collections\{ArrayCollection, Collection};
use Exception;
use Illuminate\Auth\Passwords\CanResetPassword;
use Laravel\Passport\HasApiTokens;
use LaravelDoctrine\ORM\Auth\Authenticatable;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Learn\Domain\Entity\{Asset, FavouriteAsset, Passing};
use Scandinaver\RBAC\Domain\Entity\{Permission, Role};
use Scandinaver\Shared\AggregateRoot;
use Scandinaver\Translate\Domain\Entity\Passing as TranslateResult;
use Scandinaver\Translate\Domain\Entity\Text;
use Scandinaver\User\Domain\Event\UserCreated;
use Scandinaver\User\Domain\Event\UserDeleted;
use Scandinaver\User\Domain\Traits\UsesPasswordGrant;

/**
 * Class User
 *
 * @package Scandinaver\User\Domain\Entity
 */
class User extends AggregateRoot implements UserInterface,
    \Illuminate\Contracts\Auth\Authenticatable
{

    use Authenticatable;
    use CanResetPassword;
    use HasApiTokens;
    use UsesPasswordGrant;

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

    private Collection $assetPassings;

    private Collection $textPassings;

    /** @var Collection<Asset> */
    private Collection $personalAssets;

    private Collection $puzzles;

    private Collection $texts;

    private Collection $posts;

    private Collection $roles;

    /**
     * @var Collection | Permission[]
     */
    private Collection $permissions;

    public function __construct()
    {
        $this->passings       = new ArrayCollection();
        $this->texts          = new ArrayCollection();
        $this->translates     = new ArrayCollection();
        $this->roles          = new ArrayCollection();
        $this->permissions    = new ArrayCollection();
        $this->personalAssets = new ArrayCollection();

        $this->pushEvent(new UserCreated($this));
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

    public function getAvatar(): string
    {
        return asset('/uploads/u/' . $this->photo);
    }

    public function isActive(): bool
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

    public function onDelete()
    {
        $this->pushEvent(new UserDeleted($this));
    }

    /**
     * @param  Passing  $passing
     */
    public function addAssetPassing(Passing $passing)
    {
        if (!$this->assetPassings->contains($passing)) {
            $this->assetPassings->add($passing);
        }
    }

    /**
     * @param  TranslateResult  $result
     */
    public function addTextPassing(TranslateResult $result)
    {
        if (!$this->textPassings->contains($result)) {
            $this->textPassings->add($result);
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

    public function getFavouriteAsset(Language $language): ?FavouriteAsset
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
     * @return Asset[]
     */
    public function getPersonalAssets(Language $language): array
    {
        $data = new ArrayCollection();

        foreach ($this->personalAssets as $personalAsset) {
            /** @var Asset $personalAsset */
            if ($personalAsset->isFavorite()) {
                continue;
            }

            if ($personalAsset->getLanguage()->isEqualTo($language)) {
                $data->add($personalAsset);
            }
        }

        return $data->toArray();
    }

}
