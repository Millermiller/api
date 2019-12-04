<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Intro
 *
 * @ORM\Table(name="intro")
 * @ORM\Entity
 */
class Intro
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
     * @ORM\Column(name="page", type="string", length=50, nullable=true)
     */
    private $page;

    /**
     * @var string|null
     *
     * @ORM\Column(name="element", type="string", length=255, nullable=true, options={"default"="undefined"})
     */
    private $element = 'undefined';

    /**
     * @var string|null
     *
     * @ORM\Column(name="intro", type="text", length=65535, nullable=true)
     */
    private $intro;

    /**
     * @var string|null
     *
     * @ORM\Column(name="position", type="string", length=255, nullable=true, options={"default"="false"})
     */
    private $position = 'false';

    /**
     * @var string|null
     *
     * @ORM\Column(name="tooltipClass", type="string", length=255, nullable=true)
     */
    private $tooltipclass;

    /**
     * @var int|null
     *
     * @ORM\Column(name="sort", type="integer", nullable=true, options={"default"="100"})
     */
    private $sort = '100';

    /**
     * @var int|null
     *
     * @ORM\Column(name="active", type="integer", nullable=true)
     */
    private $active;

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
     * @var \DateTime|null
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private $deletedAt;


}
