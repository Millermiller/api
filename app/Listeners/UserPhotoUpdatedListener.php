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
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param UserPhotoUpdated $event
     *
     * @return void
     * @throws GuzzleException
     */
    public function handle(UserPhotoUpdated $event): void
    {
        Requester::updateForumUserAvatar($event->user);
    }
}
