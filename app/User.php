<?php

namespace App;

use App\Mail\ResetPassword;
use App\Models\Asset;
use App\Models\Card;
use App\Models\Intro;
use App\Models\Plan;
use App\Models\Result;
use App\Models\Text;
use App\Models\TextResult;
use Avatar;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Image;
use Laravel\Passport\HasApiTokens;
use Mail;

/**
 * Class UsersModel
 *
 * @property int $id
 * @property string $login
 * @property string $name
 * @property string $password
 * @property string $photo
 * @property string $restore_link
 * @property string $email
 * @property int $active
 * @property Asset $favourite
 * @property string $role
 * @property Carbon $created_at
 * @property int $last_online
 * @property int $active_to
 * @property bool $premium
 * @property string $avatar
 * @property Plan $plan
 */
class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $table = 'users';

    protected $fillable = ['name', 'login', 'email', 'password', 'openpass', 'role', 'active_to'];

    protected $hidden = ['password', 'remember_token'];

    protected $dates = ['active_to'];

    protected $appends = ['premium', 'avatar', 'favourite'];

    const ROLE_ADMIN = 1;
    const ROLE_USER  = 0;

    public function findForPassport($username) {
        return $this->where('email', $username)->orWhere('login', $username)->first();
    }

    public function state()
    {
        return [
            'user'      => $this->info(),
            'site'      => config('app.MAIN_SITE'),
            'words'     => Card::getAssetsByType(Asset::TYPE_WORDS, $this->id),
            'sentences' => Card::getAssetsByType(Asset::TYPE_SENTENCES, $this->id),
            'favourites'=> Card::getAssetsByType(Asset::TYPE_FAVORITES, $this->id)[0],
            'personal'  => Asset::domain()->whereHas(
                'result', function ($q){
                /** @var \Illuminate\Database\Eloquent\Builder $q */
                $q->where('user_id', $this->id);
            })->with('cards', 'cards.word', 'cards.translate', 'result')
                ->where('basic', 0)
                ->get(),

            //'texts'     => Text::select(['id', 'title'])->where('published', '=', '1')->get(),
            'texts'     => Text::getTextsByUser($this->id),
            'intro'     => Intro::where('active', '=', '1')->get()->sortBy('sort')->groupBy('page')
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function assets()
    {
        return $this->belongsToMany('App\Models\Asset', 'assets_to_users', 'user_id', 'asset_id');
    }

    public function plan()
    {
        return $this->belongsTo('App\Models\Plan');
    }

    public function getPremiumAttribute()
    {
        return (Carbon::parse($this->active_to) > Carbon::now()) ? true : false;
    }

    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function setActiveToAttribute($value)
    {
        $this->attributes['active_to'] = Carbon::createFromFormat('D M d Y-H:i', $value.'-23:59');
    }

    public function getAvatarAttribute()
    {
        if($this->photo){
            if (file_exists( public_path('/uploads/u/a/') . $this->photo)) {
                return '/uploads/u/a/' . $this->photo;
            } else {
                $avatar = Image::make(public_path('/uploads/u/') . $this->photo);
                $avatar->resize(
                    300, null, function ($constraint) {
                    /** @var \Intervention\Image\Constraint $constraint */
                    $constraint->aspectRatio();
                });
                $avatar->save(public_path('/uploads/u/a/' . $this->photo));
                return public_path('/uploads/u/a/' . $this->photo);
            }
        }
        else{
            return Avatar::create($this->login)->toBase64()->encoded;
        }
    }

    public function info(){
        return [
            'id' => $this->id,
            'login' => $this->login,
            'avatar' => $this->avatar,
            'email' => $this->email,
            'active' => $this->premium,
            'plan' => $this->plan,
            'active_to' => $this->active_to
        ];
    }

    public function hasAsset($asset_id)
    {
        if(count(Result::where('asset_id', '=', $asset_id)->where('user_id', '=', $this->id)->get()))
            return true;
        else
            return false;
    }

    public function hasText($text_id)
    {
        if(count(TextResult::where('text_id', '=', $text_id)->where('user_id', '=', $this->id)->get()))
            return true;
        else
            return false;
    }

    public function sendPasswordResetNotification($token)
    {
        Mail::to($this)->send(new ResetPassword($this, $token));
    }

    public function getFavouriteAttribute()
    {
        return Asset::domain()->whereHas(
            'result', function ($q){
            /** @var \Illuminate\Database\Eloquent\Builder $q */
            $q->where('user_id', $this->id);
        })->where('type', Asset::TYPE_FAVORITES)->first();
    }
}