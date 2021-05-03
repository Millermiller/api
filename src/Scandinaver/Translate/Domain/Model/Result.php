<?php


namespace Scandinaver\Translate\Domain\Model;

use DateTime;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Model\Language;

/**
 * Class Result
 *
 * @package Scandinaver\Translate\Domain\Model
 */
class Result
{
    private int $id;

    private int $textId;

    private Language $language;

    private DateTime $createdAt;

    private ?DateTime $updatedAt;

    private UserInterface $user;

    private Text $text;

    public function __construct(Text $text, UserInterface $user, Language $language)
    {
        $this->language = $language;
        $this->user     = $user;
        $this->text     = $text;
    }
}
