<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PuzzleResult
 * @package App\Models
 *
 * Created by PhpStorm.
 * User: Миллер
 * Date: 24.05.2017
 * Time: 20:55
 *
 * @property int $id
 * @property int $puzzle_id
 * @property int $user_id
 * @property Text $text
 */
class PuzzleResult extends Model
{
    protected $table = 'puzzles_to_users';

    protected $fillable = ['puzzle_id', 'user_id'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @return Asset|\Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function puzzle()
    {
        return $this->hasOne('App\Models\Puzzle', 'id', 'puzzle_id');
    }
}