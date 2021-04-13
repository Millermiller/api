<?php


namespace Scandinaver\Puzzle\Domain\Exception;

use Exception;

/**
 * Class PuzzleNotFoundException
 *
 * @package Scandinaver\Puzzle\Domain\Exception
 */
class PuzzleNotFoundException extends Exception
{
    protected $code = '404';

    protected $message = 'Puzzle not found';
}