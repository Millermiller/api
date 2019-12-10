<?php

namespace App\Models;

use App\Helpers\StringHelper;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Puzzle
 * @package App\Models
 *
 * @property int $id
 * @property string $text
 * @property string $translate
 * @property string $created_at
 * @property string $updated_at
 *
 * @method static Builder domain()
 */
class Puzzle extends Model
{
    protected $table = 'puzzles';

    protected $fillable = ['text', 'translate'];

    protected $appends = ['success'];

    /**
     * @param Builder $query
     * @return mixed
     */
    public function scopeDomain($query)
    {
        return $query->where('language_id',  config('app.lang'));
    }

    public function setTextAttribute($value){
        $this->attributes['text'] = StringHelper::cleartext($value);
    }

    public function setTranslateAttribute($value){
        $this->attributes['translate'] = StringHelper::cleartext($value);
    }

    public function getSuccessAttribute()
    {
        return $this->users()->where('users.id', Auth::user()->getKey())->exists();
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'puzzles_users')->withTimestamps();
    }
}