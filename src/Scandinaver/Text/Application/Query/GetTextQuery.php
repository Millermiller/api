<?php


namespace Scandinaver\Text\Application\Query;

use Scandinaver\Shared\Contracts\Query;
use Scandinaver\Text\Domain\Text;

/**
 * Class GetTextQuery
 * @package Scandinaver\Text\Application\Query
 */
class GetTextQuery implements Query
{
    /**
     * @var Text
     */
    private $text;

    /**
     * GetTextQuery constructor.
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