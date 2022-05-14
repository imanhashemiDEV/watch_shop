<?php

namespace App\Jobs;

use App\CustomClass\NotificationGroupsCenter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendNotifGroupsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 1;

    protected $users;
    protected $sendData;

    /**
     * SendSms constructor.
     * @param $sendData
     * @param $users
     */
    public function __construct($users, $sendData)
    {
        $this->users = $users;
        $this->sendData = $sendData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        #send
        NotificationGroupsCenter::send($this->sendData, $this->users);
    }
}
