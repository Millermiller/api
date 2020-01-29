<?php

namespace App\Helpers\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Intro
 * @package App\Models
 *
 * @property int id
 * @property string page
 * @property string element
 * @property string intro
 * @property string position
 * @property string tooltipClass
 * @property int sort
 * @property int active
 */
class Intro extends Model
{
    use SoftDeletes;

    protected $table = 'intro';

    protected $fillable = ['page', 'element', 'intro', 'sort', 'position', 'tooltipClass', 'active'];
}