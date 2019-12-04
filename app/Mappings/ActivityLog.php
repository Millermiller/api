<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * ActivityLog
 *
 * @ORM\Table(name="activity_log", indexes={@ORM\Index(name="activity_log_log_name_index", columns={"log_name"})})
 * @ORM\Entity
 */
class ActivityLog
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="log_name", type="string", length=255, nullable=true)
     */
    private $logName;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var int|null
     *
     * @ORM\Column(name="subject_id", type="integer", nullable=true)
     */
    private $subjectId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="subject_type", type="string", length=255, nullable=true)
     */
    private $subjectType;

    /**
     * @var int|null
     *
     * @ORM\Column(name="causer_id", type="integer", nullable=true)
     */
    private $causerId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="causer_type", type="string", length=255, nullable=true)
     */
    private $causerType;

    /**
     * @var string|null
     *
     * @ORM\Column(name="properties", type="text", length=65535, nullable=true)
     */
    private $properties;

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


}
