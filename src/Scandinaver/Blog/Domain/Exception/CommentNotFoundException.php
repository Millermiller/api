<?php


namespace Scandinaver\Blog\Domain\Exception;

use Exception;

/**
 * Class CommentNotFoundException
 *
 * @package Scandinaver\Blog\Domain\Exception
 */
class CommentNotFoundException extends Exception
{
    protected $code = '404';

    protected $message = 'Comment not found';
}