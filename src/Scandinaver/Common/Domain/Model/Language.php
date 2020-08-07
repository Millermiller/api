<?php


namespace Scandinaver\Common\Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use LaravelDoctrine\ORM\Contracts\UrlRoutable;

/**
 * Languages
 * @ORM\Table(name="language", indexes={@ORM\Index(name="name",
 *   columns={"name"}), @ORM\Index(name="id", columns={"id"})})
 *
 * @ORM\Entity
 */
class Language implements JsonSerializable, UrlRoutable
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private string $name;

    /**
     * @ORM\Column(name="label", type="string", length=50, nullable=false)
     */
    private string $label;

    /**
     * @ORM\Column(name="flag", type="string", length=50, nullable=false)
     */
    private string $flag;

    public static function getRouteKeyName(): string
    {
        return 'name';
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    public function getFlag(): string
    {
        return $this->flag;
    }

    public function setFlag(string $flag): void
    {
        $this->flag = $flag;
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return [
            'name' => $this->label,
            'label' => $this->label,
            'flag' => config('app.SITE').$this->flag,
            'letter' => $this->name,
            'cards' => 0,
            'value' => 'https://'.$this->name.'.'.config('app.DOMAIN'),
        ];
    }
}
