<?php

namespace  Scandinaver\Puzzle\Domain;

use App\Entities\User;
use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * Puzzles
 *
 * @ORM\Table(name="puzzles")
 * @ORM\Entity
 */
class Puzzle implements JsonSerializable
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
     * @var string|null
     *
     * @ORM\Column(name="text", type="string", length=255, nullable=true)
     */
    private $text;

    /**
     * @var string|null
     *
     * @ORM\Column(name="translate", type="string", length=255, nullable=true)
     */
    private $translate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="language_id", type="string", length=10, nullable=true)
     */
    private $languageId;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var Collection|User[]
     *
     * @ORM\ManytoMany(targetEntity="App\Entities\User", mappedBy="puzzles")
     */
    private $users;

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            'translate' => $this->translate,
            'success' =>  $this->users->count()
        ];
    }

    /**
     * @return User[]|Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param User $user
     * @return $this
     */
    public function addUser(User $user) : Puzzle
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
