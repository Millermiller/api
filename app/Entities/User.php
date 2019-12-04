<?php

namespace  App\Entities;

use Doctrine\ORM\Mapping as ORM;


/**
 * Users
 *
 * @ORM\Table(name="users", uniqueConstraints={@ORM\UniqueConstraint(name="email", columns={"email"})}, indexes={@ORM\Index(name="restore_link", columns={"restore_link"}), @ORM\Index(name="plan_id", columns={"plan_id"}), @ORM\Index(name="last_online", columns={"last_online"})})
 * @ORM\Entity
 */
class User
{

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
     * @var \DateTime|null
     *
     * @ORM\Column(name="active_to", type="datetime", nullable=true, options={"default"="2000-11-29 20:00:00"})
     */
    private $activeTo = '2000-11-29 20:00:00';

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var string|null
     *
     * @ORM\Column(name="remember_token", type="string", length=100, nullable=true)
     */
    private $rememberToken;

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
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="last_online", type="datetime", nullable=true)
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
     * @return Plan
     */
    public function getPlan(): Plan
    {
        return $this->plan;
    }
}
