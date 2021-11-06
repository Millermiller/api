<?php


namespace Scandinaver\Learning\Asset\Infrastructure\Persistence\Eloquent;

use Auth;
use DB;
use Eloquent;
use Exception;
use Illuminate\Database\Eloquent\{Builder, Model, Relations\BelongsTo, Relations\HasMany, SoftDeletes};

/**
 * Class Asset
 *
 * @package Scandinaver\Learn\Infrastructure\Persistence\Eloquent
 * @mixin Eloquent
 */
class Asset extends Model
{

    use SoftDeletes;

    public const TYPE_PERSONAL = 0;

    public const TYPE_WORDS = 1;

    public const TYPE_SENTENCES = 2;

    public const TYPE_FAVORITES = 3;

    protected $table = 'assets';

    protected $fillable = [
        'title',
        'basic',
        'favorite',
        'type',
        'level',
        'language_id',
    ];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Удаляет набор и все с ним связанное
     * TODO: объединить запрос. использовать внешние ключи.
     *
     * @param  int  $id  Asset Id
     *
     * @return bool
     * @throws Exception
     */
    public static function deleteAsset(int $id): bool
    {
        if (!Auth::user()->hasAsset($id) && !Auth::user()->_admin) {
            return FALSE;
        }

        DB::beginTransaction();

        try {
            DB::delete('DELETE FROM assets WHERE id = ?', [$id]);

            DB::delete('DELETE FROM cards WHERE asset_id = ?', [$id]);

            DB::delete('DELETE FROM assets_to_users WHERE asset_id = ?', [$id]);

            DB::commit();

            return TRUE;
        } catch (Exception $e) {
            DB::rollback();

            return FALSE;
        }
    }

    /**
     * Проверяет наличие следующего уровня basic-набора
     * Возвращает его id или false если не находит
     * TODO: сократить вложенные запросы
     *
     * @param  int  $asset_id  Asset Id
     *
     * @return int
     */
    public static function getNextLevel(int $asset_id): int
    {
        return DB::select(
            '
                   SELECT id
                   FROM assets as a
                   WHERE a.basic = 1
                   AND a.type = (SELECT a1.type from assets as a1 where a1.id = ?)
                   AND a.level = (SELECT a1.level from assets as a1 where a1.id = ?) + 1
                   ',
            [$asset_id, $asset_id]
        )[0];
    }

    /**
     * Добавляет basic набор следующего уровня
     * возвращает инфу о новом наборе
     *
     * @param  int  $asset_id
     *
     * @return Asset
     */
    public static function addLevel(int $asset_id): Asset
    {
        DB::insert(
            '
                   INSERT INTO assets
                   SET title = ?,
                       basic = 1,
                       type = ?,
                       language_id = ?,
                       created_at = NOW(),
                       updated_at = NOW(),
                       level = (select max(a2.level)
                                    from assets as a2
                                        where a2.type = ?
                                        and a2.language_id = ?) + 1
                   ',
            [
                $asset_id,
                $asset_id,
                config('app.lang'),
                $asset_id,
                config('app.lang'),
            ]
        );


        return Asset::find(DB::getPdo()->lastInsertId());
    }

    // public function user()
    // {
    //     return $this->belongsTo('App\Helpers\Eloquent\User', 'role_user', 'user_id', 'role_id');
    // }

    public function scopeDomain(Builder $query): Builder
    {
        return $query->where('language_id', config('app.lang'));
    }

    /**
     * @return HasMany|Card[]
     */
    public function cards(): array
    {
        return $this->hasMany(
            'Scandinaver\Learn\Infrastructure\Persistence\Eloquent\Card'
        );
    }

    /**
     * @return BelongsTo|Result
     */
    public function result(): Result
    {
        return $this->belongsTo(
            'Scandinaver\Learn\Infrastructure\Persistence\Eloquent\Result',
            'id',
            'asset_id'
        )->where('user_id', Auth::id());
    }

}