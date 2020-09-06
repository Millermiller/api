<?php


namespace Scandinaver\Translate\Domain\Model;


use Scandinaver\Shared\DTO;

class TextDTO extends DTO
{

    private Text $text;

    public function __construct(Text $text)
    {
        $this->text = $text;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->text->getId(),
            'language' => $this->text->getLanguage(),
            'level' => $this->text->getLevel(),
            'description' => $this->text->getDescription(),
            'text' => $this->text->getText(),
            'image' => $this->text->getImage(),
            'count' => $this->text->getWords()->count(),
            'extra' => $this->text->getExtra()->toArray(),
        ];
    }
}