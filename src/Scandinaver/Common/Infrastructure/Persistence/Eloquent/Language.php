<?php


namespace Scandinaver\Common\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Language
 *
 * @package Scandinaver\Common\Infrastructure\Persistence\Eloquent
 */
class Language extends Model
{
    protected $table    = 'languages';

    protected $fillable = [];

    protected $appends  = ['value', 'image'];

    /**
     * @return string
     */
    public function getValueAttribute(): string
    {
        return 'https://' . $this->name . '.' . config('app.DOMAIN');
    }

    /**
     * @return string
     */
    public function getImageAttribute(): string
    {
        return config('app.SITE') . $this->flag;
    }
}