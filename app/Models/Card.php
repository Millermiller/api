<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

/**
 * Created by PhpStorm.
 * User: whiskey
 * Date: 28.01.15
 * Time: 23:36
 *
 * Class Card
 * @package App\Models
 *
 * @property int id
 * @property int asset_id
 * @property int word_id
 * @property int translate_id
 * @property int created_at
 * @property int updated_at
 * @property int deleted_at
 * @property Word word
 * @property Asset asset
 * @property Translate translate
 */
class Card extends Model{

    protected $table = 'cards';

    protected $fillable = ['asset_id', 'word_id', 'translate_id'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    Use SoftDeletes;

    /**
     * @return Word | \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function word()
    {
        return $this->belongsTo('App\Models\Word');
    }

    /**
     * @return Translate | \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function translate()
    {
        return $this->belongsTo('App\Models\Translate');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function asset()
    {
        return $this->belongsTo('App\Models\Asset');
    }

    public function examples()
    {
        return $this->hasMany('App\Models\Example');
    }
}