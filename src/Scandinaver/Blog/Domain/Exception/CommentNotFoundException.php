<?php


namespace Scandinaver\Blog\Domain\Exception;


class CommentNotFoundException extends \Exception
{
    protected $code = '404';

    protected $message = 'Comment not found';
}