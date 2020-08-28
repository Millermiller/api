<?php


namespace App\Listeners;

use App\Events\UserRegistered;
use App\Helpers\EloquentHelper;
use App\Jobs\CreateUserForum;
use App\Jobs\SendRegistrationEmail;

/**
 * Class UserRegisteredListener
 *
 * @package App\Listeners
 */
class UserRegisteredListener
{
    public function __construct()
    {
        //
    }

    public function handle(UserRegistered $event): void
    {
        dispatch(new SendRegistrationEmail($event));
       // dispatch(new CreateUserForum($event));

       // $user = EloquentHelper::getEloquentModel($event->user);

       // activity('public')->causedBy($user)->log('Зарегистрирован пользователь');
    }
}
