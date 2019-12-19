<?php

namespace App\Entities;

use App\Entities\Traits\UsesPasswordGrant;
use Carbon\Carbon;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\{JoinTable, ManyToMany};
use Image;
use JsonSerializable;
use Laravel\Passport\HasApiTokens;
use LaravelDoctrine\ORM\Auth\Authenticatable;
use Avatar;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use LaravelDoctrine\ORM\Notifications\Notifiable;

/**
 * Users
 *
 * @ORM\Table(name="users", uniqueConstraints={@ORM\UniqueConstraint(name="email", columns={"email"})}, indexes={@ORM\Index(name="restore_link", columns={"restore_link"}), @ORM\Index(name="plan_id", columns={"plan_id"}), @ORM\Index(name="last_online", columns={"last_online"})})
 * @ORM\Entity
 */
class User implements \Illuminate\Contracts\Auth\Authenticatable, CanResetPasswordContract, JsonSerializable
{
    use Authenticatable;
    use CanResetPassword;
    use HasApiTokens;
    use Notifiable;
    use UsesPasswordGrant;

    const ROLE_ADMIN = 1;
    const ROLE_USER = 0;

    public function getKey()
    {
        return $this->id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return 'name';
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=255, nullable=false)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var int
     *
     * @ORM\Column(name="active_to", type="integer", nullable=true, nullable=true)
     */
    private $activeTo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="restore_link", type="string", length=255, nullable=true)
     */
    private $restoreLink;

    /**
     * @var int
     *
     * @ORM\Column(name="active", type="integer", nullable=false, options={"default"="1"})
     */
    private $active = '1';

    /**
     * @var int|null
     *
     * @ORM\Column(name="role", type="integer", nullable=true)
     */
    private $role = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="assets_opened", type="integer", nullable=true)
     */
    private $assetsOpened = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="assets_created", type="integer", nullable=true)
     */
    private $assetsCreated = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="created_at", type="string", nullable=true)
     */
    private $createdAt;

    /**
     * @var int
     *
     * @ORM\Column(name="deleted_at", type="integer", nullable=true)
     */
    private $deletedAt;

    /**
     * @var int
     *
     * @ORM\Column(name="updated_at", type="integer", nullable=true)
     */
    private $updatedAt;

    /**
     * @var int
     *
     * @ORM\Column(name="last_online", type="integer", nullable=true)
     */
    private $lastOnline;

    /**
     * @var Plan
     *
     * @ORM\ManyToOne(targetEntity="Plan")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="plan_id", referencedColumnName="id")
     * })
     */
    private $plan;

    /**
     * @var \Doctrine\Common\Collections\Collection|Asset[]
     *
     * @ManyToMany(targetEntity="Asset", inversedBy="users", cascade={"persist"})
     * @JoinTable(name="assets_users")
     */
    private $assets;

    /**
     * @var \Doctrine\Common\Collections\Collection|Puzzle[]
     *
     * @ManyToMany(targetEntity="Puzzle", inversedBy="users")
     * @JoinTable(name="puzzles_users")
     */
    private $puzzles;

    /**
     * @var \Doctrine\Common\Collections\Collection|Text[]
     *
     * @ManyToMany(targetEntity="Text", inversedBy="users")
     * @JoinTable(name="texts_users")
     */
    private $texts;

    /**
     * @return Plan
     */
    public function getPlan(): Plan
    {
        return $this->plan;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection|Asset[]
     */
    public function getAssets()
    {
        return $this->assets;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection|Text[]
     */
    public function getTexts()
    {
        return $this->texts;
    }

    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @return Carbon
     */
    public function getCreatedAt(): Carbon
    {
        return Carbon::parse($this->createdAt);
    }

    /**
     * @param string $createdAt
     */
    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return Carbon
     */
    public function getActiveTo(): Carbon
    {
        return Carbon::parse($this->activeTo);
    }

    /**
     * @param int $activeTo
     */
    public function setActiveTo(int $activeTo): void
    {
        $this->activeTo = $activeTo;
    }

    /**
     * @param Plan $plan
     */
    public function setPlan(Plan $plan): void
    {
        $this->plan = $plan;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getAvatar()
    {
        if ($this->photo) {
            if (file_exists(public_path('/uploads/u/a/') . $this->photo)) {
                return '/uploads/u/a/' . $this->photo;
            } else {
                $avatar = Image::make(public_path('/uploads/u/') . $this->photo);
                $avatar->resize(
                    300,
                    null,
                    function ($constraint) {
                        /** @var \Intervention\Image\Constraint $constraint */
                        $constraint->aspectRatio();
                    }
                );
                $avatar->save(public_path('/uploads/u/a/' . $this->photo));
                return '/uploads/u/a/' . $this->photo;
            }
        } else {
            return Avatar::create($this->login)->toBase64()->encoded;
        }
    }

    /**
     * @return bool
     */
    public function isPremium(): bool
    {
        return (Carbon::parse($this->activeTo) > Carbon::now()) ? true : false;
    }

    /**
     * @return int|null
     */
    public function getAssetsOpened(): ?int
    {
        return $this->assetsOpened;
    }

    /**
     * @return int|null
     */
    public function getAssetsCreated(): ?int
    {
        return $this->assetsCreated;
    }

    /**
     * @return bool
     */
    public function hasPhoto(): bool
    {
        return $this->photo !== '';
    }

    /**
     * @return string|null
     */
    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    /**
     * @param string|null $photo
     */
    public function setPhoto(?string $photo): void
    {
        $this->photo = $photo;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @var Collection|Result[]
     *
     * @ORM\OneToMany(targetEntity="Result", mappedBy="user")
     *
     */
    private $results;

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'login' => $this->login,
            'email' => $this->email,
            'active_to' => $this->getActiveTo()->format("Y-m-d H:i:s"),
            'plan_id' => $this->getPlan()->getId(),
            'name' => $this->name,
            'photo' => $this->photo,
            'assets_opened' => $this->assetsOpened,
            'assets_created' => $this->assetsCreated,
            'premium' => $this->isPremium(),
            'avatar' => $this->getAvatar()
        ];
    }

    /**
     * @return int
     */
    public function getActive(): bool
    {
        return (bool)$this->active;
    }

    /**
     * @param Puzzle $puzzle
     * @return $this
     */
    public function addPuzzle(Puzzle $puzzle): User
    {
        $this->hasPuzzle($puzzle) ?: $this->puzzles[] = $puzzle;

        return $this;
    }

    /**
     * @param Puzzle $puzzle
     * @return bool
     */
    public function hasPuzzle(Puzzle $puzzle): bool
    {
        foreach ($this->puzzles as $p) {
            if ($p->getId() === $puzzle->getId()) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param Asset $asset
     * @return $this
     */
    public function addAsset(Asset $asset): User
    {
        $this->assets->add($asset);

        return $this;
    }

    /**
     * @param Asset $asset
     * @return bool
     */
    public function hasAsset(Asset $asset): bool
    {
        foreach ($this->assets as $a) {
            if ($a->getId() === $asset->getId()) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param Text $text
     * @return bool
     */
    public function hasText(Text $text): bool
    {
        foreach ($this->texts as $t) {
            if ($t->getId() === $text->getId()) {
                return true;
            }
        }
        return false;
    }

    /**
     *
     */
    public function incrementAssetCounter(): void
    {
        $this->assetsCreated++;
    }

    /**
     * @param Asset[]|Collection $assets
     */
    public function setAssets($assets): void
    {
        $this->assets = $assets;
    }

    /**
     * @param Text[]|Collection $texts
     */
    public function setTexts($texts): void
    {
        $this->texts = $texts;
    }
}
