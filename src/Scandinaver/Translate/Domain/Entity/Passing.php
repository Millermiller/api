<?php


namespace Scandinaver\Translate\Domain\Entity;

use DateTime;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Entity\AbstractPassing;
use Scandinaver\Common\Domain\Entity\Language;

/**
 * Class Passing
 *
 * @package Scandinaver\Translate\Domain\Entity
 */
class Passing extends AbstractPassing
{
    public function __construct(Text $text, UserInterface $user, bool $completed, array $data)
    {
        $this->subject   = $text;
        $this->language  = $text->getLanguage();
        $this->user      = $user;
        $this->completed = $completed;
        $this->percent   = $data['percent'];
        $this->data      = $data['payload'];
    }

    public function onDelete()
    {
        // TODO: Implement delete() method.
    }
}
