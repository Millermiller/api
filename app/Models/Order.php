<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Order
 * @package App\Models
 *
 * @property int $id
 * @property int $sum
 * @property string $status
 * @property string $notification_type
 * @property string $datetime
 * @property string $codepro
 * @property string $sha1_hash
 * @property string $label
 * @property int $plan_id
 * @property int $user_id
 * @property int $sender
 *
 * @property User $user
 * @property Plan $plan
 */
class Order extends Model
{
    use SoftDeletes;

    protected $table = 'orders';

    protected $fillable = ['sum', 'status', 'plan_id', 'user_id', 'notification_type', 'datetime', 'codepro', 'sender', 'sha1_hash', 'label'];

    /**
     * @return Result|\Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return Result|\Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plan()
    {
        return $this->belongsTo('App\Models\Plan');
    }
}
