<?php

namespace App\Listeners;

use App\Events\UserPhotoUpdated;
use GuzzleHttp\Exception\GuzzleException;
use Scandinaver\Common\Domain\Service\Requester;

/**
 * Class UserPhotoUpdatedListener
 *
 * @package App\Listener
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
