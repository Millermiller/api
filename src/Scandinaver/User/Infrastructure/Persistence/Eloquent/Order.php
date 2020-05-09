<?php


namespace Scandinaver\User\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Scandinaver\Learn\Infrastructure\Persistence\Eloquent\Result;

/**
 * Class Order
 *
 * @package Scandinaver\User\Infrastructure\Persistence\Eloquent
 */
class Order extends Model
{
    use SoftDeletes;

    protected $table    = 'orders';

    protected $fillable = ['sum', 'status', 'plan_id', 'user_id', 'notification_type', 'datetime', 'codepro', 'sender', 'sha1_hash', 'label'];

    /**
     * @return User|BelongsTo
     */
    public function user(): User
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return Result|BelongsTo
     */
    public function plan(): Result
    {
        return $this->belongsTo('App\Helpers\Eloquent\Plan');
    }
}