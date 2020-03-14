<?php


namespace Scandinaver\Learn\Application\Commands;

use Scandinaver\Shared\Contracts\Command;

/**
 * Class AddWordAndTranslateCommand
 * @package Scandinaver\Learn\Application\Commands
 */
class AddWordAndTranslateCommand implements Command
{
    /**
     * @var string
     */
    private $word;

    /**
     * @var string
     */
    private $translate;

    /**
     * @var int
     */
    private $issentence;

    public function __construct(array $data)
    {
        $this->word = $data['word'];
        $this->translate = $data['translate'];
        $this->issentence = $data['issentence'];
    }

    /**
     * @return string
     */
    public function getWord(): string
    {
        return $this->word;
    }

    /**
     * @return string
     */
    public function getTranslate(): string
    {
        return $this->translate;
    }

    /**
     * @return int
     */
    public function getIssentence(): int
    {
        return $this->issentence;
    }
}