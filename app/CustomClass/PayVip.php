<?php

namespace App\CustomClass;

use App\Helpers\Zarinpal;
use App\Models\User;
use App\Models\Vip;
use App\Models\VipShop;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class PayVip
{
    public function PayPanel($data)
    {
        DB::transaction(function () use ($data) {
            $user_id = $data['user_id'];
            $vip_type = $data['vip_type'];
            $vip_days = $data['vip_days'];
            $refId = $data['refId'];
            $price = $data['price'];

            $user = User::find($user_id);

            if ($vip_type == 1) {
                $vip_type_one = VipShop::query()->where('user_id', $user_id)->where('type', 1)->where('status', 1)->latest()->first();
                $vipTimeBeforeThis = $vip_type_one ? Carbon::parse($vip_type_one->vipTimeEnd) : Carbon::now();
            } elseif ($vip_type == 3) {
                $vip_type_there = VipShop::query()->where('user_id', $user_id)->where('type', 3)->where('status', 1)->latest()->first();
                $vipTimeBeforeThis = $vip_type_there ? Carbon::parse($vip_type_there->vipTimeEnd) : Carbon::now();
            } else {
                $vip_type_two = VipShop::query()->where('user_id', $user_id)->where('type', 2)->where('status', 1)->latest()->first();
                $vipTimeBeforeThis = $vip_type_two ? Carbon::parse($vip_type_two->vipTimeEnd) : Carbon::now();
            }

            $vipTimeEnd = $vipTimeBeforeThis->copy()->addDays($vip_days);
            $user->save();

            if ($vip_days >= 1) {
                $vip_shop = new VipShop();
                $vip_shop->payType = 1; // cash type
                $vip_shop->refId = $refId;
                $vip_shop->user_id = $user_id;
                $vip_shop->vip_id = null;
                $vip_shop->type = $vip_type;
                $vip_shop->admin_id = auth()->user()->id;
                $vip_shop->vip_days = $vip_days;
                $vip_shop->vipTimeBeforeThis = $vipTimeBeforeThis;
                $vip_shop->vipTimeEnd = $vipTimeEnd;
                $vip_shop->mobile = $user->mobile;
                $vip_shop->price = $price;
                $vip_shop->status = 1; // verified
                $vip_shop->save(); // verified
            }

            Session::flash('add_vipshop', 'عضویت کاربر با موفقیت ویژه شد');
        });
    }

    /** data hase
     * vip_id
     * discount_id
     * user_id
     * price
     * vip_type
     */
    public function PayOnline($data)
    {
//        $vip_id = $data['vip_id'];
//        $discount_code = $data['discount_code'];
        $user_id = $data['user_id'];
        $price = $data['price'];
        $vip_type = $data['vip_type'];
        $vip_days = $data['vip_days'];
//        $vip = Vip::find($vip_id);
        $user = User::find($user_id);

        if (! $user) {
            return response()->json([
                'result' => false,
                'message' => 'user not found',
                'data' => [],
            ], 205);
        }

        ///TODO for check discount
        /* if ($discount_code) {
             $vip_array = $discountRepo->vipDiscountCode($user, $vip, $discount_code);
             $price = $vip_array['price'];
             $discount_id = $vip_array['discount_id'];
         } else {
             $vip_object = $discountRepo->vipDiscount($user)->find($vip_id);
             $price = $vip_object->price;
             $discount_id = $vip_object->discount_id;
         }*/

        $data = [
            'amount' => $price,
            'callbackUrl' => 'http://appapi.bakeandsell.ir/api/v5/verify_vip',
            'description' => 'خرید دوره اشتراکی',
        ];
        $result = Zarinpal::request($data);
        $vip_shop = new VipShop();
        $vip_shop->payType = 2; // online type
        $vip_shop->refId = 0;
        $vip_shop->user_id = $user->id;
        $vip_shop->mobile = $user->mobile;
        $vip_shop->price = $price;
        $vip_shop->type = $vip_type;
        $vip_shop->pre_price = $price;
        $vip_shop->status = 0; // Not verified
        $vip_shop->vip_id = null;
        //$vip_shop->discount_id = $discount_id;
        $vip_shop->authority = $result['authority'];

        $free = false;
        if ($price == 0) {
            /// p  اگر قیمت اشتراک صفر شد
            $last_viptime = $user->viptime;
            $vip_shop->status = 1; // verified
            $vip_shop->refId = 'باتخفیف قیمت این اشتراک صفر است';

            $viptime = $user->isActive() ? Carbon::parse($user->viptime) : Carbon::now();
            $vipTimeBeforeThis = $viptime;

            $vipTimeEnd = $viptime->copy()->addDays($vip_days);
            $user->viptime = $vipTimeEnd;

            $vip_shop->vipTimeBeforeThis = $vipTimeBeforeThis;
            $vip_shop->vipTimeEnd = $vipTimeEnd;

            $free = true;
        }

        $vip_shop->save();

//        $text = " سلام عزیزجان برای اشتراک " . "ارتقای اشتراک به حرفه ایی" . " یه قدم برداشتی و رفتی که کارت رو توسعه بدی اما توی مرحله آخر متوقف شدی! واسه پرداخت مشکلی داشتی؟";
//        AddNotifToChat::dispatch($user->id, $text, 94, 'vipShop', $vip_id, $result['authority'])->delay(now()->addMinutes(15));

        return Response()->json([
            'free' => $free,
            'url' => $result['url'],
            'authority' => $result['authority'],
        ]);
    }
}
