<?php

namespace App\Listeners;

use App\Events\UserPhotoUpdated;
use GuzzleHttp\Exception\GuzzleException;
use Scandinaver\Common\Domain\Services\Requester;

/**
 * Class UserPhotoUpdatedListener
 *
 * @package App\Listeners
 */
class UserPhotoUpdatedListener
{
    public function __construct()
    {
        //
    }

    /**
     * @param  UserPhotoUpdated  $event
     *
     * @throws GuzzleException
     */
    public function handle(UserPhotoUpdated $event): void
    {
        Requester::updateForumUserAvatar($event->user);
    }
}
