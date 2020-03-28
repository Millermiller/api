<?php


namespace App\Helpers;

/**
 * Class EloquentHelper
 *
 * @package App\Helpers
 */
class EloquentHelper
{
    /**
     * @param object $entity
     *
     * @return mixed
     */
    public static function getEloquentModel(object $entity)
    {
        $classname = get_class($entity);

        return call_user_func_array([$classname, 'find'], [$entity->getId()]);
    }
}