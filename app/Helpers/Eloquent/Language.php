<?php

namespace App\Helpers\Eloquent;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $label
 * @property string $flag
 * @property string $image
 */
class Language extends Model
{
    protected $table = 'languages';

    protected $fillable = [];

    protected $appends = ['value', 'image'];

    /**
     * @return int
     */
    public function getValueAttribute()
    {
        return 'https://'.$this->name.'.'.config('app.DOMAIN');
    }

    /**
     * @return string
     */
    public function getImageAttribute()
    {
        return config('app.SITE').$this->flag;
    }
}