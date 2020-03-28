<?php


namespace Illuminate\Auth\Events;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Queue\SerializesModels;

/**
 * Class Registered
 *
 * @package Illuminate\Auth\Events
 */
class Registered
{
    use SerializesModels;

    /**
     * The authenticated user.
     *
     * @var Authenticatable
     */
    public $user;

    /**
     * Create a new event instance.
     *
     * @param Authenticatable $user
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }
}
