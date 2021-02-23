<?php


namespace Scandinaver\Blog\Domain\Events\Listeners;


use Scandinaver\Blog\Domain\Events\CommentAdded;

/**
 * Class CommentAddedListener
 *
 * @package Scandinaver\Blog\Domain\Events\Listeners
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