<?php

namespace Application\Models;

use Carbon\Carbon;
use Eloquent;
use Scandinaver\Classes\App;
use Scandinaver\Classes\GenericEvent;

/**
 * Class UsersModel
 *
 * @property int $id
 * @property string $login
 * @property string $name
 * @property string $pass
 * @property string $photo
 * @property string $avatar
 * @property string $restore_link
 * @property string $email
 * @property int $active
 * @property string $role
 * @property int $created_at
 * @property int $last_online
 * @property string $openpass
 * @property int $active_to
 * @property bool $premium
 */
class User extends Eloquent
{

    protected $table = 'users';

    protected $fillable = ['name', 'login', 'email', 'pass', 'openpass', 'role'];

    protected $hidden = ['openpass', 'pass'];

    protected $dates = ['active_to'];

    protected $appends = ['premium'];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('Application\Models\Comment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sessions()
    {
        return $this->hasMany('Application\Models\Session');
    }


    public function delete()
    {
        App::$dispatcher->dispatch('user.delete', new GenericEvent($this));

        return parent::delete();
    }

    public function getPremiumAttribute()
    {
        return (Carbon::parse($this->active_to) > Carbon::today()) ? true : false;
    }

    /**
     * @return bool|string
     */
    public function generateLink()
    {
        $link = 'http://www.' . HOST . '/restore/' . self::$id . '/';
        $hash = sha1(time() . self::$email);
        $link .= $hash;

        $st = $this->DB->prepare('
                UPDATE users
                SET restore_link = :hash
                WHERE id = :id');

        $st->bindParam('hash', $hash);
        $st->bindParam('id', self::$id);

        if ($st->execute())
            return $link;
        else
            return false;
    }
}