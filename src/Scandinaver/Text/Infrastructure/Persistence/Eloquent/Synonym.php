<?php


namespace Scandinaver\Text\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Synonym
 *
 * @package App\Models
 * @property int    $id
 * @property int    $word_id
 * @property string $synonym
 */
class Synonym extends Model
{
    protected $table    = 'synonym';

    protected $fillable = ['word_id', 'synonym'];
}