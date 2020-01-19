<?php

namespace App\Jobs;

use App\Events\UserRegistered;
use App\Services\Requester;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateUserForum implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

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
    public function handle()
    {
        try{
            Requester::createForumUser($this->event->data);
        }catch (GuzzleException $exception){
            //
        }
    }
}
