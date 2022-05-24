<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SmsCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'mobile',
        'code'
    ];

    public static function createSmsCode($mobile, $code)
    {
        SmsCode::query()->create([
            'mobile' => $mobile,
            'code' => $code
        ]);
    }

    public static function checkTwoMinutes($mobile)
    {
       $check = SmsCode::query()->where('mobile', $mobile)
            ->where('created_at', '>', Carbon::now()->subMinutes(2))
            ->first();

            if($check){
                return true;
            }else{
                return false;
            }
    }

    public static function checkSend($mobile,$code)
    {
       $check =SmsCode::query()->where('mobile', $mobile)
       ->where('code', $code)->latest()->first();

            if($check){
                return true;
            }else{
                return false;
            }
    }
}
