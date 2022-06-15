<?php

namespace App\CustomClass;

use Carbon\Carbon;
use Exception;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\Log;

class NotificationGroupsCenter
{
    public static function send($data, $users)
    {
        $api_key = 'AAAAELGquKw:APA91bGm615Hluftc5SaeZffC3Q_GdA8YYX26uOtgTP_8Niop4d4DzvkcFsA8TSPrCysYoimytQ4VzaC4jsLug52zqhr78l8EaUJ8j_RRfMXigpxbgBZH2ylUcsGQArz8vVh8NAO44gD';
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fcm = $users->where('fcm_token', '!=', null)->where('fcm_token', '!=', 1)->where('fcm_token', '!=', '')->where('fcm_token', '!=', 'TOKEN FAILED')
            ->pluck('fcm_token')->toArray();

        $fields = [
            'registration_ids' => $fcm,
            'time_to_live' => 86400,
            'data' => $data,
        ];

        $headers = [
            'Authorization: key='.$api_key,
            'Content-Type: application/json',
        ];

        //Send Response To FireBase Server
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 40);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // make the request
        $result = curl_exec($ch);

        // decode JSON response
        $response = json_decode($result, true);
        if ($response === null) {
            throw new Exception('Invalid Response For send Notifi = '.$result);
        }

        curl_close($ch);

        return true;
    }
}
