<?php


namespace Scandinaver\Blog\Domain\Exception;

use Exception;
use Illuminate\Http\JsonResponse;

/**
 * Class CategoryDuplicateException
 *
 * @package Scandinaver\Blog\Domain\Exception
 */
class CategoryDuplicateException extends Exception
{

    protected $code = JsonResponse::HTTP_UNPROCESSABLE_ENTITY;

    protected $message = 'Category already exists';
}