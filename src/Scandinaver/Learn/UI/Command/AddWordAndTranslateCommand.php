<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Shared\Contract\Command;

/**
 * Class AddWordAndTranslateCommand
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\AddWordAndTranslateHandler
 * @package Scandinaver\Learn\UI\Command
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