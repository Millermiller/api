<?php


namespace Scandinaver\User\Infrastructure\Persistence\Eloquent;

use App\Mail\ResetPassword;
use Avatar;
use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\{Builder, Model};
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Image;
use Intervention\Image\Constraint;
use Laravel\Passport\HasApiTokens;
use Mail;
use Scandinaver\Blog\Infrastructure\Persistence\Eloquent\Comment;
use Scandinaver\Learning\Asset\Infrastructure\Persistence\Eloquent\Asset;
use Scandinaver\Learning\Asset\Infrastructure\Persistence\Eloquent\Result;
use Scandinaver\Learning\Asset\Infrastructure\Persistence\Eloquent\Word;
use Scandinaver\Learning\Puzzle\Infrastructure\Persistence\Eloquent\Puzzle;
use Scandinaver\Learning\Translate\Infrastructure\Persistence\Eloquent\TextResult;

/**
 * Class User
 *
 * @package Scandinaver\User\Infrastructure\Persistence\Eloquent
 * @mixin Eloquent
 */
class User extends Authenticatable
{

    use HasApiTokens;
    use Notifiable;

    public const ROLE_ADMIN = 1;

    public const ROLE_USER = 0;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'login',
        'email',
        'password',
        'openpass',
        'role',
        'active_to',
        'plan_id',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $dates = ['active_to'];

    protected $appends = ['premium', 'avatar', 'favourite', 'cardsCreated'];

    /**
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();

        static::deleted(
            function ($user) {
                /** @var User $user */
                activity('admin')->causedBy($user)->log(
                    'Удален пользователь id:' . $user->id . ' login: ' . $user->login
                );

                Result::where('user_id', $user->id)->delete();
                TextResult::where('user_id', $user->id)->delete();
                $user->puzzles()->detach();
            }
        );
    }

    /**
     * @return BelongsToMany|Puzzle[]
     */
    public function puzzles(): array
    {
        return $this->belongsToMany(
            'Scandinaver\Puzzle\Infrastructure\Persistence\Eloquent\Puzzle',
            'puzzle_user'
        )->withTimestamps();
    }

    /**
     * @param  string  $username
     *
     * @return User
     */
    public function findForPassport(string $username): User
    {
        return $this->where('email', $username)
                    ->orWhere('login', $username)
                    ->first();
    }

    /**
     * @return HasMany|Comment[]
     */
    public function comments(): array
    {
        return $this->hasMany(
            'Scandinaver\Blog\Infrastructure\Persistence\Eloquent\Comment'
        );
    }

    /**
     * @return BelongsToMany|Asset[]
     */
    public function assets()
    {
        return $this->belongsToMany(
            'Scandinaver\Learn\Infrastructure\Persistence\Eloquent\Asset',
            'assets_users',
            'user_id',
            'asset_id'
        );
    }

    /**
     * @return BelongsTo|Plan
     */
    public function plan(): Plan
    {
        return $this->belongsTo(
            'Scandinaver\User\Infrastructure\Persistence\Eloquent\Plan'
        );
    }

    /**
     * @return bool
     */
    public function getPremiumAttribute(): bool
    {
        return Carbon::parse($this->active_to) > Carbon::now();
    }

    /**
     * @return int
     */
    public function getCardsCreatedAttribute(): int
    {
        return Word::where('creator', $this->id)->count();
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    /**
     * @param  string  $value
     */
    public function setActiveToAttribute(string $value): void
    {
        $this->attributes['active_to'] = Carbon::createFromFormat(
            'D M d Y',
            $value
        );
    }

    /**
     * @return string
     */
    public function getAvatarAttribute(): string
    {
        if ($this->photo) {
            if (file_exists(public_path('/uploads/u/a/') . $this->photo)) {
                return url('/uploads/u/a/' . $this->photo);
            }
            else {
                $avatar = Image::make(public_path('/uploads/u/') . $this->photo);
                $avatar->resize(
                    300,
                    NULL,
                    function ($constraint) {
                        /** @var Constraint $constraint */
                        $constraint->aspectRatio();
                    }
                );
                $avatar->save(public_path('/uploads/u/a/' . $this->photo));

                return url('/uploads/u/a/' . $this->photo);
            }
        }
        else {
            return Avatar::create($this->login)->toBase64()->encoded;
        }
    }

    /**
     * @param  int  $asset_id
     *
     * @return bool
     */
    public function hasAsset(int $asset_id): bool
    {
        return Result::where(['asset_id' => $asset_id, 'user_id' => $this->id])
                     ->exists();
    }

    /**
     * @param  int  $text_id
     *
     * @return bool
     */
    public function hasText(int $text_id): bool
    {
        return TextResult::where(
            ['text_id' => $text_id, 'user_id' => $this->id]
        )->exists();
    }

    /**
     * @param  string  $token
     */
    public function sendPasswordResetNotification($token)
    {
        Mail::to($this)->send(new ResetPassword($this, $token));
    }

    /**
     * @return Model|Asset
     */
    public function getFavouriteAttribute(): Asset
    {
        return Asset::domain()->whereHas(
            'result',
            function ($q) {
                /** @var Builder $q */
                $q->where('user_id', $this->id);
            }
        )->where('type', Asset::TYPE_FAVORITES)->first();
    }

}