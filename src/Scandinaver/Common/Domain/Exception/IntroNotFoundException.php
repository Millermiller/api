<?php


namespace Scandinaver\Common\Domain\Exception;


use Exception;

class IntroNotFoundException extends Exception
{
    protected $code = 404;

    protected $message = 'Intro not found';
}