<?php


namespace Scandinaver\Translate\Domain;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Scandinaver\Common\Domain\Language;
use Scandinaver\User\Domain\User;

/**
 * TextsUsers
 * @ORM\Table(name="texts_users", indexes={@ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="text_id", columns={"text_id"})})
 *
 * @ORM\Entity
 */
class Result
{

    /**
     * @var int
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     * @ORM\Column(name="language_id", type="string", length=50, nullable=true)
     */
    private $languageId;

    /**
     * @var Language
     * @ORM\ManyToOne(targetEntity="Scandinaver\Common\Domain\Language", inversedBy="results")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     * })
     */
    private $language;

    /**
     * @var int|null
     * @ORM\Column(name="text_id", type="integer", nullable=true)
     */
    private $textId;

    /**
     * @var DateTime|null
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var DateTime|null
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var DateTime|null
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="Scandinaver\User\Domain\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var Text
     * @ORM\ManyToOne(targetEntity="Text", inversedBy="textResults")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="text_id", referencedColumnName="id")
     * })
     */
    private $text;

    /**
     * Result constructor.
     *
     * @param Text     $text
     * @param User     $user
     * @param Language $language
     */
    public function __construct(Text $text, User $user, Language $language)
    {
        $this->language = $language;
        $this->user     = $user;
        $this->text     = $text;
    }
}
