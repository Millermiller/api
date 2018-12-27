<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 */
class Language extends Model
{
    protected $table = 'languages';

    protected $fillable = [];
}