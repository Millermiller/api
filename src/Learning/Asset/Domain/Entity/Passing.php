<?php


namespace Scandinaver\Learning\Asset\Domain\Entity;

use DateTime;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Entity\AbstractLearnItem;
use Scandinaver\Common\Domain\Entity\AbstractPassing;
use Scandinaver\Common\Domain\Entity\Language;

/**
 * Class Passing
 *
 * @package Scandinaver\Learn\Domain\Entity
 */
class Passing extends AbstractPassing
{
    public function __construct(Asset $asset, UserInterface $user, bool $completed, array $data)
    {
        $this->subject   = $asset;
        $this->language  = $asset->getLanguage();
        $this->user      = $user;
        $this->completed = $completed;
        $this->percent   = $data['percent'];
        $this->data      = $data['payload'];
    }

    public function onDelete()
    {
        // TODO: Implement delete() method.
    }

    public function getTime(): int
    {
        return $this->data['time'];
    }

    public function getErrors(): array
    {
        return $this->data['errors'];
    }
}
