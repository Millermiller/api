<?php

namespace App\Helpers;

/**
 * Class EloquentHelper
 * @package App\Helpers
 */
class EloquentHelper
{
    /**
     * @param object $entity
     * @return mixed
     */
    public static function getEloquentModel(object $entity)
    {
        $classname = '\App\Helpers\Eloquent\\'.class_basename($entity);

        return call_user_func_array([$classname, 'find'], [$entity->getId()]) ;
    }
}