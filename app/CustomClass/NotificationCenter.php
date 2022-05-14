<?php


namespace App\CustomClass;

use Carbon\Carbon;
use Exception;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\Log;

//define('API_ACCESS_KEY', 'AAAAELGquKw:APA91bGm615Hluftc5SaeZffC3Q_GdA8YYX26uOtgTP_8Niop4d4DzvkcFsA8TSPrCysYoimytQ4VzaC4jsLug52zqhr78l8EaUJ8j_RRfMXigpxbgBZH2ylUcsGQArz8vVh8NAO44gD');

class NotificationCenter
{
    public static function send($data, $user)
    {
        $api_key = "AAAAELGquKw:APA91bGm615Hluftc5SaeZffC3Q_GdA8YYX26uOtgTP_8Niop4d4DzvkcFsA8TSPrCysYoimytQ4VzaC4jsLug52zqhr78l8EaUJ8j_RRfMXigpxbgBZH2ylUcsGQArz8vVh8NAO44gD";
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fcm = $user->fcm_token;

        if ($fcm != "" && $fcm != null && $fcm != 1) {

            $fields = [
                'registration_ids' => [$fcm],
                'time_to_live' => 86400,
                'data' => $data,
            ];

            $headers = [
                'Authorization: key=' . $api_key,
                'Content-Type: application/json',
            ];
            #Send Response To FireBase Server
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

            // make the request
            $result = curl_exec($ch);

            // decode JSON response
            $response = json_decode($result, true);
            if ($response === null) {
                throw new Exception('Invalid Response For send Notifi = ' . $result);
            }

            if ($response['success'] == 0) {
                $name = $user->mobile ? $user->mobile : ($user->email ? $user->email : $user->id);
                $error = $response['results'][0]['error'] ?? $result;
                $message = "کاربر {$name} نوتیفیکیشن دریافت نکرد به دلیل {$error}.";
                Log::channel('notif')->warning($message);
            }

            curl_close($ch);

            return true;

        } else {  /// dont have fcm
            $name = $user->mobile ? $user->mobile : ($user->email ? $user->email : $user->id);
            $message = "کاربر {$name} نوتیفیکیشن دریافت نکرد چون توکن fcm نداشت.";
            Log::channel('notif')->warning($message);
        }
    }

}



