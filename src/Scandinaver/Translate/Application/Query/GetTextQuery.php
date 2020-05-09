<?php


namespace Scandinaver\Translate\Application\Query;

use Scandinaver\Shared\Contracts\Query;
use Scandinaver\Translate\Domain\Text;

/**
 * Class GetTextQuery
 *
 * @package Scandinaver\Translate\Application\Query
 * @see     \Scandinaver\Translate\Application\Handlers\GetTextHandler
 */
class GetTextQuery implements Query
{
    /**
     * @var Text
     */
    private $text;

    /**
     * GetTextQuery constructor.
     *
     * @param Text $text
     */
    public function __construct(Text $text)
    {
        $this->text = $text;
    }

    /**
     * @return Text
     */
    public function getText(): Text
    {
        return $this->text;
    }
}