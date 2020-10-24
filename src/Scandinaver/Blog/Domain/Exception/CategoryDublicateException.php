<?php


namespace Scandinaver\Blog\Domain\Exception;

use Illuminate\Http\JsonResponse;

class CategoryDublicateException extends \Exception
{
    protected $code = JsonResponse::HTTP_UNPROCESSABLE_ENTITY;

    protected $message = 'Category already exists';
}