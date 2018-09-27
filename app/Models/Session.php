<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Session
 * @package App\Models
 *
 * @property int $user_id
 * @property string $token
 * @property int $created_at
 * @property int $updated_at
 */
class Session extends Model
{
    protected $table = 'sessions';

    protected $fillable = ['user_id', 'token'];
}