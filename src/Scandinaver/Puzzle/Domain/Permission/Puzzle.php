<?php


namespace Scandinaver\Puzzle\Domain\Permission;


/**
 * Class Puzzle
 *
 * @package Scandinaver\Puzzle\Domain\Permission
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