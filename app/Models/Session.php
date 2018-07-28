<?php

namespace Application\Models;

use Eloquent;

/**
 * Class Session
 * @package Application\models
 *
 * Created by PhpStorm.
 * User: user
 * Date: 27.08.2016
 * Time: 19:56
 *
 * @property int $user_id
 * @property string $token
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $user
 */
class Session extends Eloquent
{
    protected $table = 'sessions';

    protected $fillable = ['user_id', 'token'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Application\Models\User');
    }
}