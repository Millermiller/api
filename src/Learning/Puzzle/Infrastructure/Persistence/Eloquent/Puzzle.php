<?php


namespace Scandinaver\Learning\Puzzle\Infrastructure\Persistence\Eloquent;

use App\Helpers\StringHelper;
use Auth;
use Eloquent;
use Illuminate\Database\Eloquent\{Builder, Model, Relations\BelongsToMany};
use Scandinaver\User\Infrastructure\Persistence\Eloquent\User;

/**
 * Class Puzzle
 *
 * @package Scandinaver\Puzzle\Infrastructure\Persistence\Eloquent
 * @mixin Eloquent
 */
class Puzzle extends Model
{

    protected $table = 'puzzles';

    protected $fillable = ['text', 'translate'];

    protected $appends = ['success'];

    public function scopeDomain(Builder $query): Builder
    {
        return $query->where('language_id', config('app.lang'));
    }

    public function setTextAttribute(string $value): void
    {
        $this->attributes['text'] = StringHelper::cleartext($value);
    }

    public function setTranslateAttribute(string $value): void
    {
        $this->attributes['translate'] = StringHelper::cleartext($value);
    }

    public function getSuccessAttribute(): bool
    {
        return $this->users()
                    ->where('users.id', Auth::user()->getKey())
                    ->exists();
    }

    /**
     * @return BelongsToMany|User[]
     */
    public function users(): array
    {
        return $this->belongsToMany('App\User', 'puzzle_user')
                    ->withTimestamps();
    }

}