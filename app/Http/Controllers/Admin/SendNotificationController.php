<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendAndSaveNotifGroupsJob;
use App\Models\SendNotification;
use App\Models\User;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SendNotificationController extends Controller
{

    public function index()
    {
        $notifications = SendNotification::query()->orderByDesc('created_at')->paginate(20);
        return view('admin.sendnotifications.index', compact('notifications'));
    }

    public function create()
    {
        return view('admin.sendnotifications.create');
    }

    public function store(Request $request)
    {
        $sendType = $request->input('sendType');
        $title = $request->input('title');
        $body = $request->input('body');

        $users = json_decode($request->input('users'));

        if ($sendType == 'all') {
            $result = $this->sendToAll($title, $body);
        } else {
            $result = $this->sendCustomNotif($title, $body, $users);
        }

        if ($result === true) {
            return redirect('admin/notifications/create')->with('message', 'نوتیفیکیشن ارسال شد');
        }
    }


    public function sendToAll($title, $body): bool
    {
        $users = User::query()->get();
        $delay = 1;
        SendAndSaveNotifGroupsJob::dispatch($users, $title, $body, 1);

        return true;
    }

    public function sendCustomNotif($title, $body, $users): bool
    {
        $mobiles = array_column($users, 'mobile');
        $users = User::query()->whereIn('mobile', $mobiles)->get();

        $delay = 1;

        SendAndSaveNotifGroupsJob::dispatch($users, $title, $body);

        return true;
    }

}
