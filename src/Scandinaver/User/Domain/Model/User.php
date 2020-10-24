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
 * Class User
 *
 * @package Scandinaver\User\Domain\Model
 */
class User implements \Illuminate\Contracts\Auth\Authenticatable, CanResetPasswordContract, JsonSerializable
{
    use Authenticatable;
    use CanResetPassword;
    use HasApiTokens;
    use Notifiable;
    use UsesPasswordGrant;

    public const ROLE_ADMIN = 1;
    public const ROLE_USER = 0;

    private $id;

    private string $login;

    private string $email;

    private DateTime $activeTo;

    private ?string $name;

    private ?string $photo;

    private ?string $restoreLink;

    private int $active;

    private int $role;

    private int $assetsOpened = 0;

    private int $assetsCreated = 0;

    private DateTime $createdAt;

    private DateTime $updatedAt;

    private DateTime $lastOnline;

    private Plan $plan;

    private $assets;

    private $puzzles;

    private $texts;

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
            'plan_id' => $this->plan->getId(),
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
    public function getAvatar(): string
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
        return (bool)$this->active;
    }

    public function incrementAssetCounter(): void
    {
        $this->assetsCreated++;
    }

    public function hasAsset(Asset $asset): bool
    {
        foreach ($this->assets as $a) {
            if ($a->getId() === $asset->getId()) {
                return true;
            }
        }

        return false;
    }

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
     * @param  mixed  $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }
}
