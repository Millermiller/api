<?php


namespace Scandinaver\Blog\Domain\Exception;

use Exception;

/**
 * Class CategoryNotFoundException
 *
 * @package Scandinaver\Blog\Domain\Exception
 */
class CategoryNotFoundException extends Exception
{

    protected $code = 404;

    protected $message = 'Category not found';
}