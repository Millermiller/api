<?php


namespace Scandinaver\Translate\Domain\Model;

use DateTime;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\User\Domain\Model\User;

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

    private User $user;

    private Text $text;

    public function __construct(Text $text, User $user, Language $language)
    {
        $this->language = $language;
        $this->user = $user;
        $this->text = $text;
    }
}
