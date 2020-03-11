<?php


namespace Scandinaver\User\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Plan
 * 
 * @property int $id
 * @property string $name
 * @property string $period
 * @property int $cost
 * @property int $cost_per_month
 *
 * @package App\Models
 */
class Plan extends Model
{
	public $timestamps = false;

    protected $table = 'plans';

	protected $casts = [
		'cost' => 'int',
		'cost_per_month' => 'int'
	];

	protected $fillable = [
		'name',
		'period',
		'cost',
		'cost_per_month'
	];
}
