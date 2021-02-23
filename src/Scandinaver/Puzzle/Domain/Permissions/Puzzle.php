<?php


namespace Scandinaver\Puzzle\Domain\Permissions;


/**
 * Class Puzzle
 *
 * @package Scandinaver\Puzzle\Domain\Permissions
 */
class Puzzle
{
    public const VIEW     = 'view-puzzles';
    public const SHOW     = 'show-puzzle';
    public const CREATE   = 'create-puzzle';
    public const UPDATE   = 'update-puzzle';
    public const DELETE   = 'delete-puzzle';
    public const COMPLETE = 'complete-puzzle';
}