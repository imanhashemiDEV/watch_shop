<?php

namespace App\Helpers;

use App\Models\Order;
use App\Models\User;

class helper
{
    public static function make_slug($string)
    {
        return preg_replace('/\s+/u', '-', trim($string));
    }

    public static function sanitizePhone($str)
    {
        $persianNum = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        for ($i = 0; $i < 10; $i++) {
            $str = str_replace($persianNum[$i], $i, $str);
        }

        if (substr($str, 0, 1) != '0') {
            $str = '0'.$str;
        }

        return $str;
    }

    public static function generateRandomString($length = 20)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    public static function generateRandomInteger($length = 20)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $codeExist = User::query()->where('code', $randomString)->first();
        if ($codeExist) {
            // return $this->generateRandomInteger(6);
        } else {
            return $randomString;
        }
    }

    public static function generateRandomRefId($length = 6)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $codeExist = Order::query()->where('code', $randomString)->first();
        if ($codeExist) {
            return self::generateRandomRefId(6);
        } else {
            return $randomString;
        }
    }
}
