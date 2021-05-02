<?php


namespace App\Events;

use Illuminate\Queue\SerializesModels;

/**
 * Class Event
 *
 * @package App\Event
 */
abstract class Event
{
    use SerializesModels;
}
