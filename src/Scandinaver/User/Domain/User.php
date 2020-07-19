<?php


namespace Scandinaver\User\Domain;

use Avatar;
use Carbon\Carbon;
use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\{JoinTable, ManyToMany};
use Doctrine\ORM\Mapping as ORM;
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
use Scandinaver\Blog\Domain\Post;
use Scandinaver\Learn\Domain\{Asset, Result};
use Scandinaver\Puzzle\Domain\Puzzle;
use Scandinaver\Translate\Domain\Text;
use Scandinaver\User\Domain\Traits\UsesPasswordGrant;

/**
 * Users
 * @ORM\Table(name="users", uniqueConstraints={@ORM\UniqueConstraint(name="email", columns={"email"})}, indexes={@ORM\Index(name="restore_link", columns={"restore_link"}), @ORM\Index(name="plan_id", columns={"plan_id"}), @ORM\Index(name="last_online", columns={"last_online"})})
 *
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
    const ROLE_USER  = 0;

    /**
     * @var int
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="login", type="string", length=255, nullable=false)
     */
    private $login;

    /**
     * @var string
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var DateTime
     * @ORM\Column(name="active_to", type="datetime", nullable=true, nullable=true)
     */
    private $activeTo;

    /**
     * @var int
     * @ORM\Column(name="plan_id", type="integer", nullable=true)
     */
    private $planId;

    /**
     * @var string|null
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @var string|null
     * @ORM\Column(name="restore_link", type="string", length=255, nullable=true)
     */
    private $restoreLink;

    /**
     * @var int
     * @ORM\Column(name="active", type="integer", nullable=false, options={"default"="1"})
     */
    private $active = '1';

    /**
     * @var int|null
     * @ORM\Column(name="role", type="integer", nullable=true)
     */
    private $role = '0';

    /**
     * @var int|null
     * @ORM\Column(name="assets_opened", type="integer", nullable=true)
     */
    private $assetsOpened = '0';

    /**
     * @var int|null
     * @ORM\Column(name="assets_created", type="integer", nullable=true)
     */
    private $assetsCreated = '0';

    /**
     * @var string
     * @ORM\Column(name="created_at", type="string", nullable=true)
     */
    private $createdAt;

    /**
     * @var int
     * @ORM\Column(name="deleted_at", type="integer", nullable=true)
     */
    private $deletedAt;

    /**
     * @var int
     * @ORM\Column(name="updated_at", type="integer", nullable=true)
     */
    private $updatedAt;

    /**
     * @var int
     * @ORM\Column(name="last_online", type="integer", nullable=true)
     */
    private $lastOnline;

    /**
     * @var Plan
     * @ORM\ManyToOne(targetEntity="Plan")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="plan_id", referencedColumnName="id")
     * })
     */
    private $plan;

    /**
     * @var Collection|Asset[]
     * @ManyToMany(targetEntity="Scandinaver\Learn\Domain\Asset", inversedBy="users", cascade={"persist"})
     * @JoinTable(name="assets_users")
     */
    private $assets;

    /**
     * @var Collection|Puzzle[]
     * @ManyToMany(targetEntity="\Scandinaver\Puzzle\Domain\Puzzle", inversedBy="users")
     * @JoinTable(name="puzzles_users")
     */
    private $puzzles;

    /**
     * @var Collection|Text[]
     * @ManyToMany(targetEntity="Scandinaver\Translate\Domain\Text", inversedBy="users")
     * @JoinTable(name="texts_users")
     */
    private $texts;

    /**
     * @var Collection|Post[]
     * @ORM\OneToMany(targetEntity="Scandinaver\Blog\Domain\Post", mappedBy="user")
     */
    private $posts;

    /**
     * @var Collection|Result[]
     * @ORM\OneToMany(targetEntity="Scandinaver\Learn\Domain\Result", mappedBy="user")
     */
    private $results;

    public function getKey()
    {
        return $this->id;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName()
    {
        return 'name';
    }

    /**
     * @param string|null $name
     *
     * @return User
     */
    public function setName(?string $name): User
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Plan
     */
    public function getPlan(): Plan
    {
        return $this->plan;
    }

    /**
     * @param Plan $plan
     */
    public function setPlan(Plan $plan): void
    {
        $this->plan = $plan;
    }

    /**
     * @return Collection|Asset[]
     */
    public function getAssets()
    {
        return $this->assets;
    }

    /**
     * @param Asset[]|Collection $assets
     */
    public function setAssets($assets): void
    {
        $this->assets = $assets;
    }

    /**
     * @return Collection|Text[]
     */
    public function getTexts()
    {
        return $this->texts;
    }

    /**
     * @param Text[]|Collection $texts
     */
    public function setTexts($texts): void
    {
        $this->texts = $texts;
    }

    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
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
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    /**
     * @return int|null
     */
    public function getAssetsOpened(): ?int
    {
        return $this->assetsOpened;
    }

    /**
     * @param int|null $assetsOpened
     *
     * @return User
     */
    public function setAssetsOpened(?int $assetsOpened): User
    {
        $this->assetsOpened = $assetsOpened;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getAssetsCreated(): ?int
    {
        return $this->assetsCreated;
    }

    /**
     * @param int|null $assetsCreated
     *
     * @return User
     */
    public function setAssetsCreated(?int $assetsCreated): User
    {
        $this->assetsCreated = $assetsCreated;
        return $this;
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
     * @inheritDoc
     * @throws Exception
     */
    public function jsonSerialize(): array
    {
        return [
            'id'             => $this->id,
            'login'          => $this->login,
            'email'          => $this->email,
            'active_to'      => $this->getActiveTo() ? $this->getActiveTo()->format("Y-m-d H:i:s") : null,
            'plan'           => $this->plan,
            'plan_id'        => $this->planId,
            'name'           => $this->name,
            'photo'          => $this->photo,
            'assets_opened'  => $this->assetsOpened,
            'assets_created' => $this->assetsCreated,
            'premium'        => $this->isPremium(),
            'avatar'         => $this->getAvatar()
        ];
    }

    /**
     * @return DateTime
     */
    public function getActiveTo(): ?DateTime
    {
        return $this->activeTo;
    }

    /**
     * @param string $activeTo
     *
     * @throws Exception
     */
    public function setActiveTo(string $activeTo): void
    {
        $this->activeTo = new DateTime($activeTo);
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function isPremium(): bool
    {
        return ($this->activeTo > new DateTime());
    }

    /**
     * @return UrlGenerator|string
     */
    public function getAvatar()
    {
        if ($this->photo) {
            if (file_exists(public_path('/uploads/u/a/') . $this->photo)) {
                return '/uploads/u/a/' . $this->photo;
            } else {
                try {
                    $avatar = Image::make(public_path('/uploads/u/') . $this->photo);
                    $avatar->resize(
                        300,
                        null,
                        function ($constraint) {
                            /** @var Constraint $constraint */
                            $constraint->aspectRatio();
                        }
                    );
                    $avatar->save(public_path('/uploads/u/a/' . $this->photo));
                    return '/uploads/u/a/' . $this->photo;
                } catch (Exception $exception) {
                    return Avatar::create($this->login)->toBase64()->encoded;
                }
            }
        } else {
            return Avatar::create($this->login)->toBase64()->encoded;
        }
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
     *
     * @return $this
     */
    public function addPuzzle(Puzzle $puzzle): User
    {
        $this->hasPuzzle($puzzle) ?: $this->puzzles[] = $puzzle;

        return $this;
    }

    /**
     * @param Puzzle $puzzle
     *
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
     *
     * @return $this
     */
    public function addAsset(Asset $asset): User
    {
        $this->assets->add($asset);

        return $this;
    }

    /**
     * @param Asset $asset
     *
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
     *
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
     * @param int $planId
     *
     * @return User
     */
    public function setPlanId(int $planId): User
    {
        $this->planId = $planId;
        return $this;
    }

    /**
     * @return Post[]|Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * @param Post[]|Collection $posts
     */
    public function setPosts($posts): void
    {
        $this->posts = $posts;
    }
}
