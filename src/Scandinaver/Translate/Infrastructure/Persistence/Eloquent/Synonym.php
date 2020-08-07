<?php


namespace Scandinaver\Translate\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Synonym
 *
 * @package Scandinaver\Translate\Infrastructure\Persistence\Eloquent
 */
class Synonym extends Model
{

    protected $table = 'synonym';

    protected $fillable = ['word_id', 'synonym'];

}