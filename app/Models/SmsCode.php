<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class SmsCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'mobile',
        'code',
    ];

    public static function createSmsCode($mobile, $code)
    {
        self::query()->create([
            'mobile' => $mobile,
            'code' => $code,
        ]);
    }

    public static function checkTwoMinutes($mobile)
    {
        $check = self::query()->where('mobile', $mobile)
            ->where('created_at', '>', Carbon::now()->subMinutes(2))
            ->first();

        if ($check) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkSend($mobile, $code)
    {
        $check = self::query()->where('mobile', $mobile)
       ->where('code', $code)->latest()->first();

        if ($check) {
            return true;
        } else {
            return false;
        }
    }
}
