<?php

namespace App;

use App\Mail\ResetPassword;
use App\Models\Asset;
use App\Models\Card;
use App\Models\Intro;
use App\Models\Language;
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
 * @property int $assets_opened
 * @property int $assets_created
 * @property Asset $favourite
 * @property string $role
 * @property Carbon $created_at
 * @property int $last_online
 * @property int $plan_id
 * @property Carbon $active_to
 * @property bool $premium
 * @property string $avatar
 * @property Plan $plan
 */
class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $table = 'users';

    protected $fillable = ['name', 'login', 'email', 'password', 'openpass', 'role', 'active_to', 'plan_id'];

    protected $hidden = ['password', 'remember_token'];

    protected $dates = ['active_to'];

    protected $appends = ['premium', 'avatar', 'favourite'];

    const ROLE_ADMIN = 1;
    const ROLE_USER  = 0;

    protected static function boot()
    {
        parent::boot();

        static::deleted(function ($user) {
            /** @var User $user */
            activity('admin')->causedBy($user)->log('Удален пользователь id:'.$user->id.' login: '.$user->login);

            Result::where('user_id', $user->id)->delete();
            TextResult::where('user_id', $user->id)->delete();
            $user->puzzles()->detach();
        });
    }

    public function findForPassport($username) {
        return $this->where('email', $username)->orWhere('login', $username)->first();
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

    public function puzzles()
    {
        return $this->belongsToMany('App\Models\Puzzle', 'puzzles_users')->withTimestamps();
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
        $this->attributes['active_to'] = Carbon::createFromFormat('D M d Y', $value);
    }

    public function getAvatarAttribute()
    {
        if($this->photo){
            if (file_exists( public_path('/uploads/u/a/') . $this->photo)) {
                return url('/uploads/u/a/' . $this->photo);
            } else {
                $avatar = Image::make(public_path('/uploads/u/') . $this->photo);
                $avatar->resize(
                    300, null, function ($constraint) {
                    /** @var \Intervention\Image\Constraint $constraint */
                    $constraint->aspectRatio();
                });
                $avatar->save(public_path('/uploads/u/a/' . $this->photo));
                return url('/uploads/u/a/' . $this->photo);
            }
        }
        else{
            return Avatar::create($this->login)->toBase64()->encoded;
        }
    }

    public function hasAsset($asset_id)
    {
        return Result::where(['asset_id' => $asset_id, 'user_id' =>  $this->id])->exists();
    }

    public function hasText($text_id)
    {
        return TextResult::where(['text_id' =>$text_id, 'user_id' =>  $this->id])->exists();
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