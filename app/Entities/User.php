<?php

namespace  App\Entities;

use Carbon\Carbon;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Image;
use Laravel\Passport\HasApiTokens;
use LaravelDoctrine\ORM\Auth\Authenticatable;
use Avatar;


/**
 * Users
 *
 * @ORM\Table(name="users", uniqueConstraints={@ORM\UniqueConstraint(name="email", columns={"email"})}, indexes={@ORM\Index(name="restore_link", columns={"restore_link"}), @ORM\Index(name="plan_id", columns={"plan_id"}), @ORM\Index(name="last_online", columns={"last_online"})})
 * @ORM\Entity
 */
class User implements \Illuminate\Contracts\Auth\Authenticatable
{
    use Authenticatable, HasApiTokens;

    const ROLE_ADMIN = 1;
    const ROLE_USER  = 0;


    /**
     * User constructor.
     * @param string $login
     * @param string $email
     * @param string $password
     * @param Plan $plan
     */
    public function __construct(string $login, string $email, string $password, Plan $plan)
    {
        $this->login = $login;
        $this->email = $email;
        $this->password = $password;
        $this->plan = $plan;
        $this->assets = new ArrayCollection();
        $this->texts = new ArrayCollection();
        $this->setCreatedAt(date('Y-m-d H:i:s', time()));
    }

    public function getKey()
    {
        return $this->id;
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
     * @ManyToMany(targetEntity="Asset", inversedBy="users")
     * @JoinTable(name="assets_users")
     */
    private $assets;

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
    public function getEmail() : string
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
    public function isAdmin() : bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getAvatar()
    {
        if($this->photo){
            if (file_exists( public_path('/uploads/u/a/') . $this->photo)) {
                return url('/uploads/u/a/' . $this->photo);
            } else {
                $avatar = Image::make(public_path('/uploads/u/') . $this->photo);
                $avatar->resize(
                    300, null, function ($constraint) {
                    /** @var \Intervention\Image\Constraint $constraint */
                    $constraint->aspectRatio();
                });
                $avatar->save(public_path('/uploads/u/a/' . $this->photo));
                return url('/uploads/u/a/' . $this->photo);
            }
        }
        else{
            return Avatar::create($this->login)->toBase64()->encoded;
        }
    }

    /**
     * @return bool
     */
    public function isPremium() : bool
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
    public function hasPhoto() : bool
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
}
