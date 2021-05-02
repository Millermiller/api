<?php


namespace Scandinaver\Settings\Domain\Exception;


use Exception;

/**
 * Class SettingNotFoundException
 *
 * @package Scandinaver\Settings\Domain\Exception
 */
class SettingNotFoundException extends Exception
{
    protected $code = '404';

    protected $message = 'Setting not found';
}