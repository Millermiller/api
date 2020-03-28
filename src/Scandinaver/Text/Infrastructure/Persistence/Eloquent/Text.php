<?php


namespace Scandinaver\Text\Infrastructure\Persistence\Eloquent;

use Auth;
use DB;
use Illuminate\Database\Eloquent\{Builder, Model};
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

/**
 * Class TextModel
 *
 * @package App\Models
 * @property int    $id
 * @property int    $level
 * @property string $title
 * @property string $image
 * @property string $description
 * @property string $text
 * @property string $translate
 * @property bool   $published
 * @method static Builder domain()
 */
class Text extends Model
{
    protected $table    = 'text';

    protected $fillable = ['level', 'title', 'text', 'translate', 'published', 'description'];

    protected $hidden   = ['translate'];

    /**
     * @param int $textid
     *
     * @return array
     */
    public static function getSynonyms(int $textid): array
    {
        $words = DB::select(' select 
                              w.word as word,  w.orig
                                  from word_in_text as w
                                    where text_id = ? and w.orig != ""
                              union 
                                  select s.synonym as word,  w.orig
                                    from word_in_text as w
                                      left join synonym as s
                                        on s.word_id = w.id
                                      where text_id = ?
                                    ', [$textid, $textid]);

        $result = [];

        foreach ($words as $w)
            $result[mb_strtolower($w->word)][] = trim($w->orig);

        return $result;
    }

    /**
     * @param int $id User Id
     *
     * @return array
     */
    public static function getTextsByUser(int $id): array
    {
        $activeArray = TextResult::domain()->where('user_id', $id)->pluck('text_id')->toArray();

        $rez = DB::select('SELECT id, title, image, description  FROM text WHERE published = 1 AND language_id = ? order by id asc', [config('app.lang')]);

        $counter = 0;

        foreach ($rez as &$r) {

            $counter++;

            if (in_array($r->id, $activeArray))
                $r = ['id' => $r->id, 'title' => $r->title, 'active' => true, 'image' => $r->image, 'description' => $r->description];
            else
                $r = ['id' => $r->id, 'title' => $r->title, 'active' => false, 'image' => $r->image, 'description' => $r->description];


            if ($counter < 3 || Auth::user()->active)
                $r['available'] = true;
            else
                $r['available'] = false;
        }

        return $rez;
    }

    /**
     * @param int $id
     *
     * @return bool
     */
    public static function getNextLevel(int $id): bool
    {
        $id = DB::selectOne('
                   SELECT id
                   FROM text as t
                   WHERE t.published = 1
                   AND t.level = (SELECT t1.level from text as t1 where t1.id = ?) + 1
                   ', [$id])->id;

        return ($id > 0) ? $id : false;
    }

    /**
     * @param array $attributes
     *
     * @return mixed
     */
    public static function create(array $attributes = [])
    {
        $attributes['level'] = DB::selectOne('select max(t.level) as level from text as t')->level + 1;
        return parent::create($attributes);
    }

    /**
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeDomain($query): Builder
    {
        return $query->where('lang', config('app.lang'));
    }

    /**
     * @return HasMany|TextExtra[]
     */
    public function textExtra(): array
    {
        return $this->hasMany('App\Helpers\Eloquent\TextExtra');
    }

    /**
     * @return HasMany|TextWord[]
     */
    public function words(): array
    {
        return $this->hasMany('App\Helpers\Eloquent\TextWord');
    }

    /**
     * @return BelongsTo|TextResult
     */
    public function result(): TextResult
    {
        return $this->belongsTo('App\Helpers\Eloquent\TextResult', 'id', 'text_id')->where('user_id', Auth::id());
    }
}