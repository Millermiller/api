<?php


namespace Scandinaver\Translate\UI\Query;

use Scandinaver\Shared\Contract\Query;
use Scandinaver\Translate\Domain\Model\Text;

/**
 * Class GetTextQuery
 *
 * @see     \Scandinaver\Translate\Application\Handler\Query\GetTextHandler
 * @package Scandinaver\Translate\UI\Query
 */
class GetTextQuery implements Query
{
    private Text $text;

    public function __construct(Text $text)
    {
        $this->text = $text;
    }

    public function getText(): Text
    {
        return $this->text;
    }
}