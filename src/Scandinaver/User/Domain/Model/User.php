<?php


namespace Scandinaver\User\Domain\Model;

use Avatar;
use Carbon\Carbon;
use DateTime;
use Doctrine\Common\Collections\Collection;
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
use Scandinaver\Blog\Domain\Model\Post;
use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Puzzle\Domain\Model\Puzzle;
use Scandinaver\Translate\Domain\Model\Text;
use Scandinaver\User\Domain\Traits\UsesPasswordGrant;
use Doctrine\ORM\Mapping\{JoinTable, ManyToMany};
/**
 * Users
 * @ORM\Table(name="user",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="email",
 *   columns={"email"})}, indexes={
 *     @ORM\Index(name="restore_link", columns={"restore_link"}),
 *     @ORM\Index(name="plan_id", columns={"plan_id"}),
 *     @ORM\Index(name="last_online", columns={"last_online"})
 * })
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
    const ROLE_USER = 0;

    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @ORM\Column(name="login", type="string", length=255, nullable=false)
     */
    private string $login;

    /**
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private string $email;

    /**
     * @ORM\Column(name="active_to", type="datetime", nullable=true,
     *   nullable=true)
     */
    private ?DateTime $activeTo;

    /**
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private ?string $name;

    /**
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private ?string $photo;

    /**
     * @ORM\Column(name="restore_link", type="string", length=255,
     *   nullable=true)
     */
    private ?string $restoreLink;

    /**
     * @ORM\Column(name="active", type="integer", nullable=false, options={"default"="1"})
     */
    private int $active;

    /**
     * @ORM\Column(name="role", type="integer", nullable=true)
     */
    private int $role;

    /**
     * @ORM\Column(name="assets_opened", type="integer", nullable=false, options={"default"="0"})
     */
    private int $assetsOpened;

    /**
     * @ORM\Column(name="assets_created", type="integer", nullable=false, options={"default"="0"})
     */
    private int $assetsCreated;

    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private DateTime $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private DateTime $updatedAt;

    /**
     * @ORM\Column(name="last_online", type="datetime", nullable=true)
     */
    private DateTime $lastOnline;

    /**
     * @ORM\ManyToOne(targetEntity="Plan")
     */
    private Plan $plan;

    /**
     * @var Collection|Asset[]
     * @ManyToMany(targetEntity="Scandinaver\Learn\Domain\Model\Asset", inversedBy="users", cascade={"persist"})
     * @JoinTable(name="asset_user")
     */
    private $assets;

    /**
     * @var Collection|Puzzle[]
     * @ManyToMany(targetEntity="\Scandinaver\Puzzle\Domain\Model\Puzzle", inversedBy="users")
     * @JoinTable(name="puzzles_users")
     */
    private $puzzles;

    /**
     * @var Collection|Text[]
     * @ManyToMany(targetEntity="Scandinaver\Translate\Domain\Model\Text", inversedBy="users")
     * @JoinTable(name="texts_users")
     */
    private $texts;

    /**
     * @var Collection|Post[]
     * @ORM\OneToMany(targetEntity="Scandinaver\Blog\Domain\Model\Post", mappedBy="user")
     */
    private $posts;

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

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
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
            'id' => $this->id,
            'login' => $this->login,
            'email' => $this->email,
            'active_to' => $this->getActiveTo() ? $this->getActiveTo()
                ->format(
                    "Y-m-d H:i:s"
                ) : null,
            'plan' => $this->plan,
            'plan_id' => $this->planId,
            'name' => $this->name,
            'photo' => $this->photo,
            'assets_opened' => $this->assetsOpened,
            'assets_created' => $this->assetsCreated,
            'premium' => $this->isPremium(),
            'avatar' => $this->getAvatar(),
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
    public function getAvatar()
    {
        if ($this->photo) {
            if (file_exists(public_path('/uploads/u/a/').$this->photo)) {
                return '/uploads/u/a/'.$this->photo;
            } else {
                try {
                    $avatar = Image::make(
                        public_path('/uploads/u/').$this->photo
                    );
                    $avatar->resize(
                        300,
                        null,
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
        } else {
            return Avatar::create($this->login)->toBase64()->encoded;
        }
    }

    public function getActive(): bool
    {
        return (bool) $this->active;
    }

    public function incrementAssetCounter(): void
    {
        $this->assetsCreated++;
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
}
