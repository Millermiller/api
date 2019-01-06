<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $title
 * @property string $flag
 */
class Language extends Model
{
    protected $table = 'languages';

    protected $fillable = [];

    protected $appends = ['value'];

    /**
     * @return int
     */
    public function getValueAttribute()
    {
        return 'https://'.$this->name.'.'.config('app.DOMAIN');
    }
}