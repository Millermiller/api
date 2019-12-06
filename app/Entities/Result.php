<?php

namespace  App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Result
 *
 * @ORM\Table(name="assets_users", indexes={@ORM\Index(name="lang", columns={"lang"}), @ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="asset_id", columns={"asset_id"})})
 * @ORM\Entity
 */
class Result
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
     * @var int
     *
     * @ORM\Column(name="result", type="integer", nullable=false)
     */
    private $result = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    private $userId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="language_id", type="string", length=50, nullable=true)
     */
    private $languageId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="asset_id", type="string", length=50, nullable=true)
     */
    private $assetId;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var Asset
     *
     * @ORM\ManyToOne(targetEntity="Asset")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="asset_id", referencedColumnName="id")
     * })
     */
    private $asset;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var Language
     * @ORM\ManyToOne(targetEntity="Language", inversedBy="result")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     */
    private $language;
}
