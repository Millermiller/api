<?php


namespace Scandinaver\Common\UI\Command;

use Scandinaver\Shared\Contract\Command;

/**
 * Class CreateIntroCommand
 *
 * @package Scandinaver\Common\UI\Command
 */
class CreateIntroCommand implements Command
{
    /**
     * @var array
     */
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}