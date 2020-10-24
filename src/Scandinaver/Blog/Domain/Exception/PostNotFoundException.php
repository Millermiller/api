<?php


namespace Scandinaver\Blog\Domain\Exception;


use Exception;

class PostNotFoundException extends Exception
{
    protected $code = 404;

    protected $message = 'Post not found';
}