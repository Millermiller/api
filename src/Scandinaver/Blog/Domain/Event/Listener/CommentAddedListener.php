<?php


namespace Scandinaver\Blog\Domain\Event\Listener;

use Scandinaver\Blog\Domain\Event\CommentAdded;

/**
 * Class CommentAddedListener
 *
 * @package Scandinaver\Blog\Domain\Event\Listener
 */
class CommentAddedListener
{
    /**
     * @param  CommentAdded  $event
     */
    public function handle(CommentAdded $event)
    {
    }
}