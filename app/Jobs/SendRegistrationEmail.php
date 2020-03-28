<?php


namespace App\Jobs;

use App\Events\UserRegistered;
use App\Mail\Welcome;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

/**
 * Class SendRegistrationEmail
 *
 * @package App\Jobs
 */
class SendRegistrationEmail implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * @var CreateUserForum
     */
    private $event;

    /**
     * Create a new job instance.
     *
     * @param UserRegistered $event
     */
    public function __construct(UserRegistered $event)
    {
        $this->event = $event;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        Mail::to($this->event->user->getEmail())->send(new Welcome($this->event->data));
    }
}
