<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendAndSaveNotifGroupsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 1;

    protected $users;
    protected $body;
    protected $title;

    public function __construct($users, $title, $body)
    {

        $this->users = $users;
        $this->message = $body;
        $this->title = $title;

    }

    public function handle()
    {

        $data = [
            'id' => 1,
            'title' => $this->title,
            'body' => $this->body,
        ];

        $sendData = [
            "notificationTitle" => $data['title'],
            "notificationBody" => $data['body'],
            "notificationDataObject" => $data,
        ];

        $users_save = $this->users->chunk(20);
        $delay = 1;
        foreach ($users_save as $q_users) {
            $save_notif = [];
            foreach ($q_users as $q_user) {
                $save_notif [] = [
                    'title' => $this->title,
                    'body' => $this->body,
                    'user_id' => $q_user->id,
                ];
            }
            saveNotifGroupsJob::dispatch($save_notif)->delay($delay);
            $delay += 5;
        }

        $delay2 = 1;
        foreach ($users_save as $item) {
            SendNotifGroupsJob::dispatch($item, $sendData)->delay($delay2);
            $delay2 += 5;
        }
    }
}
