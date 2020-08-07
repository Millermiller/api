<?php


namespace Scandinaver\Translate\Domain\Model;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\User\Domain\Model\User;

/**
 * TextsUsers
 * @ORM\Table(name="texts_users", indexes={@ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="text_id", columns={"text_id"})})
 *
 * @ORM\Entity
 */
class Result
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @ORM\Column(name="text_id", type="integer", nullable=false)
     */
    private int $textId;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="Scandinaver\Common\Domain\Model\Language", inversedBy="results")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     */
    private Language $language;

    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private DateTime $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private ?DateTime $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="Scandinaver\User\Domain\Model\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private User $user;

    /**
     * @ORM\ManyToOne(targetEntity="Text", inversedBy="textResults")
     * @ORM\JoinColumn(name="text_id", referencedColumnName="id")
     */
    private Text $text;

    /**
     * Result constructor.
     *
     * @param  Text      $text
     * @param  User      $user
     * @param  Language  $language
     */
    public function __construct(Text $text, User $user, Language $language)
    {
        $this->language = $language;
        $this->user = $user;
        $this->text = $text;
    }
}
