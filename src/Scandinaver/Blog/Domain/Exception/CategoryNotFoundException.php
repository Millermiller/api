<?php


namespace Scandinaver\Blog\Domain\Exception;


use Exception;

class CategoryNotFoundException extends Exception
{
    protected $code = 404;

    protected $message = 'Category not found';
}