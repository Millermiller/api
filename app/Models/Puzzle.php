<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use DB;

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
 */
class Puzzle extends Model
{
    protected $table = 'puzzles';

    protected $fillable = ['text', 'translate'];

    /**
     * @return Result|\Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function result()
    {
        return $this->belongsTo('App\Models\PuzzleResult', 'id', 'puzzle_id');
    }

    /**
     * @param  int $id User Id
     * @return array
     */
    public static function getPuzzlesByUser($id)
    {
        $activeArray = PuzzleResult::where('user_id', $id)->pluck('puzzle_id')->toArray();

        $rez = DB::select('SELECT id, text, translate FROM puzzles WHERE  1 order by id asc');

        $counter = 0;

        foreach($rez as &$r) {

            $counter++;

            if (in_array($r->id, $activeArray))
                $r = ['id' => $r->id, 'text'=> $r->text,'active' => true];
             else
                $r = ['id' => $r->id, 'text'=> $r->text,'active' => false];


            if($counter <= 20 || Auth::user()->active)
                $r['available'] = true;
            else
                $r['available'] = false;
        }

        return $rez;
    }
}