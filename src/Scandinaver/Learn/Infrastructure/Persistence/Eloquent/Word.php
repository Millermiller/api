<?php


namespace Scandinaver\Learn\Infrastructure\Persistence\Eloquent;

use Auth;
use DB;
use Eloquent;
use Illuminate\Database\Eloquent\{Model, Relations\HasMany, Relations\HasOne, SoftDeletes};
use Scandinaver\User\Infrastructure\Persistence\Eloquent\User;

/**
 * Class Word
 *
 * @package Scandinaver\Learn\Infrastructure\Persistence\Eloquent
 * @mixin Eloquent
 */
class Word extends Model
{

    use SoftDeletes;

    protected $table    = 'words';

    protected $fillable = ['word', 'transcription', 'audio', 'sentence', 'is_public', 'creator'];

    protected $hidden   = ['created_at', 'updated_at', 'deleted_at', 'transcription'];

    protected $appends  = ['variants', 'login'];

    /**
     * Переводит слово с русского языка
     * Возвращает слово, перевод и транскрипцию
     * только публичные слова
     * и приватные текущего пользователя
     *
     * @param string $word
     * @param string $sentence
     *
     * @return array
     */
    public static function tr(string $word, string $sentence): array
    {
        return DB::select('
                            select t.id,
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
                            and w.language_id = ?
                            order by score desc;
                            ', [$word, $word, $word . "%", $word, $sentence, Auth::user()->getAuthIdentifier(), config('app.lang')]);
    }

    /**
     * Возвращает предложения, не участвующие в наборах
     *
     * @return array
     */
    public static function getSentences(): array
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

    /**
     * @return bool
     */
    public function getVariantsAttribute(): bool
    {
        return $this->attributes['variants'] = Translate::where('word_id', '=', $this->id)->count();
    }

    /**
     * @return string
     */
    public function getLoginAttribute(): string
    {
        return ($this->user) ? $this->user->login : '';
    }

    /**
     * @return HasMany|Card[]
     */
    public function translates()
    {
        return $this->hasMany('Scandinaver\Learn\Infrastructure\Persistence\Eloquent\Translate');
    }

    /**
     * @return HasOne|User
     */
    public function user(): User
    {
        return $this->hasOne('App\User', 'id', 'creator');
    }
}