<?php


namespace Scandinaver\Common\Domain\Model;


use Scandinaver\Shared\DTO;

/**
 * Class LanguageDTO
 *
 * @package Scandinaver\Common\Domain\Model
 */
class LanguageDTO extends DTO
{
    private Language $language;

    private int $assetsAvailable;

    private int $assetsAll;

    public function __construct(Language $language, int $assetsAvailable, int $assetsAll)
    {
        $this->language        = $language;
        $this->assetsAvailable = $assetsAvailable;
        $this->assetsAll       = $assetsAll;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'name'           => $this->language->getLabel(),
            'label'          => $this->language->getLabel(),
            'flag'           => config('app.SITE').$this->language->getFlag(),
            'letter'         => $this->language->getName(),
            'cardsAvailable' => $this->assetsAvailable,
            'cardsAll'       => $this->assetsAll,
        ];
    }
}