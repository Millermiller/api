<?php

namespace App\Models;

use App\User;
use Auth;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Created by PhpStorm.
 * User: whiskey
 * Date: 18.01.15
 * Time: 21:03
 *
 * Class Word
 * @package App\Models
 *
 * @property int id
 * @property string word
 * @property string transcription
 * @property string audio
 * @property string creator
 * @property string created_at
 * @property string updated_at
 * @property string deleted_at
 * @property int sentence
 * @property int is_public
 *
 * @property User user
 */
class Word extends Model {

    use SoftDeletes;

    protected $table = 'words';

    protected $fillable = ['word', 'transcription', 'audio', 'sentence', 'is_public', 'creator'];

    protected $hidden  = ['created_at', 'updated_at', 'deleted_at', 'transcription', 'user'];

    protected $appends = ['variants', 'login'];

    /**
     * @return int
     */
    public function getVariantsAttribute()
    {
        return $this->attributes['variants'] = Translate::where('word_id', '=', $this->id)->count();
    }

    /**
     * @return string
     */
    public function getLoginAttribute()
    {
        return ($this->user) ? $this->user->login : '';
    }

    /**
     * @return Card|\Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function translates()
    {
        return $this->hasMany('App\Models\Translate');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'creator');
    }

    /**
     * Переводит слово с русского языка
     * Возвращает слово, перевод и транскрипцию
     *
     * только публичные слова
     * и приватные текущего пользователя
     * @param $word
     * @param $sentence
     * @return array
     */
    public static function translate($word, $sentence)
    {
        return DB::select('
                            select t.value, t.id as translate_id, w.word, w.transcription, w.id, u.login as creator, w.is_public as public,
                            MATCH (t.value) AGAINST (? IN NATURAL LANGUAGE MODE) as score
                              from translate as t
                                left join words as w
                                  on t.word_id = w.id
                                left join users as u 
                                  on u.id = w.creator
                            where (MATCH(t.value) AGAINST(? IN BOOLEAN MODE)
                            or t.value like ?
                            or t.value = ?
                            )
                            and t.sentence = ?
                            and w.deleted_at is null 
                            and (w.is_public = 1 or (w.is_public = 0 and w.creator = ?))
                            and w.lang = ?
                            order by score desc;
                            ', [$word, $word, $word."%", $word, $sentence, Auth::user()->id, config('app.lang')]);
    }

    /**
     * Возвращает предложения, не участвующие в наборах
     */
    public static function getSentences()
    {
        return DB::select('
                         SELECT w.id, w.word, t.value, t.id as translate_id
                         FROM words as w
                         JOIN translate as t
                            ON w.id = t.word_id
                         WHERE w.sentence = 1
                         AND w.id NOT IN(SELECT word_id FROM cards)
                         AND w.deleted_at is NULL ');
    }
}