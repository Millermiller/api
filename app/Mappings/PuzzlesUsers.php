<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * PuzzlesUsers
 *
 * @ORM\Table(name="puzzles_users", indexes={@ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="puzzle_id", columns={"puzzle_id"})})
 * @ORM\Entity
 */
class PuzzlesUsers
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
     * @var \Puzzles
     *
     * @ORM\ManyToOne(targetEntity="Puzzles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="puzzle_id", referencedColumnName="id")
     * })
     */
    private $puzzle;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;


}
