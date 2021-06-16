<?php


namespace Scandinaver\Translate\Domain\Exception;


use Exception;

/**
 * Class SynonymAlreadyExistsException
 *
 * @package Scandinaver\Translate\Domain\Exception
 */
class SynonymAlreadyExistsException extends Exception
{
    protected $message = 'Synonym is already exists for this word';
}