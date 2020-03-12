<?php


namespace Scandinaver\Common\Infrastructure\Persistence\Eloquent;

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