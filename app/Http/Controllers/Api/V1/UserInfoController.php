<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\UserException;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hekmatinasser\Verta\Facades\Verta;

class UserInfoController extends Controller
{

    /**
     * @OA\Post(
     ** path="/api/v1/user_info",
     *   tags={"User info"},
     *   @OA\Parameter(
     *      name="token",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *
     *   @OA\Response(
     *      response=200,
     *      description="It's Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function user_info( Request $request)
    {
        $user = auth()->user();

       // throw new UserException();

        $path = $user->profile_image ? "https://static.kareto.app/public/images/user_profile/" . $user->profile_image : null;

        $str_birthday_date = $user->userInfo->birthday;
        list($birthyear, $birthmonth, $birthday) = $this->convert_date($str_birthday_date);

        $str_marriage_date = $user->userInfo->marriage_date;
        list($marriageyear, $marriagemonth, $marriageday) = $this->convert_date($str_marriage_date);
        list($vipDays, $end_vip, $miladi_end_vip) = $this->vipDays1();
        list($vipProDays, $end_vip_pro, $miladi_end_vip_pro) = $this->vipDaysPro();
        $vipDaysType3 = $this->vipDaysType3();

        $email = $user->email;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email = "";
        }

        # add birthyear to cache
        $ttl = now()->addDay();
        if ($birthyear == null && cache()->get("birthday_{$user->id}")) {
            $birthday_dialog = false;
        } elseif ($birthyear == null) {
            cache()->put("birthday_{$user->id}", "show", $ttl);
            $birthday_dialog = true;
        } else {
            $birthday_dialog = false;
        }

        $role_result = [];

        $city = City::query()->where('id', $user->userInfo->city_id)->first('city');
        $city_name = $city ? $city->city : null;

        if (is_numeric($user->name) or strpos($user->name, '@') !== false)
        {
            $user->name = null;
        }

        $info_customer = [
            'name' => $user->name,
            'birthyear' => $birthyear,
            'birthmonth' => $birthmonth,
            'birthday' => $birthday,
            'image' => $path,
            'code' => $user->code,
            'city_id' => $user->userInfo->city_id,
            'city_name' => $city_name,
            'gender' => $user->userInfo->gender,
            'bio' => $user->userInfo->about,
            'marriageyear' => $marriageyear,
            'marriagemonth' => $marriagemonth,
            'marriageday' => $marriageday,
        ];

        if ((filter_var($user->email, FILTER_VALIDATE_EMAIL))) {
            $profile_name = $user->email;
        } else {
            $profile_name = $user->mobile;
        }
        return response()->json([
            'result' => true,
            'message' => 'its Ok',
            'data' => [
                'first_vip_shop' => $this->my_helper->first_vip_shop($user),
                'first_vip_pro_shop' => $this->my_helper->first_vip_pro_shop($user),
                'bought_subscription_count' => $this->my_helper->bought_subscription_count($user),
                'going_for_payment_recently' => $user->userInfo->going_for_payment,
                'vip_day' => $vipDays,
                'shamsi_end_vip' => $end_vip,
                'miladi_end_vip' => $miladi_end_vip,
                'shamsi_end_vip_pro' => $end_vip_pro,
                'miladi_end_vip_pro' => $miladi_end_vip_pro,
                'id' => $user->id,
                'name' => $user->name,
                'loginId' => $user->mobile ?? $user->email,
                'mobile' => $user->mobile,
                'email' => $email,
                'instagram' => $user->userInfo->instagram,
                'code' => $user->code,
                'level' => $user->level,
                'beta_user_level' => $user->userInfo->beta_level,
                'is_active' => $user->viptime >= now()->format('Y-m-d') ? 1 : 0,
                'is_active_type3' => $user->viptimetype3 >= now()->format('Y-m-d') ? 1 : 0,
                'birthday_dialog' => $birthday_dialog,
                'user_info' => $info_customer,
                'role' => $role_result,
                'profile_name' => $profile_name,

            ],
        ], 200);
    }


    /**
     * @OA\Post(
     ** path="/api/v1/user_info_update",
     *   tags={"User info"},
     *   @OA\Parameter(
     *      name="name",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="instagram",
     *      in="query",
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="city_id",
     *      in="query",
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="gender",
     *      in="query",
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="marriageyear",
     *      in="query",
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="birthyear",
     *      in="query",
     *      @OA\Schema(
     *           type="string"
     *      ),
     *   ),
     *   @OA\Parameter(
     *      name="main_field_id",
     *      in="query",
     *      @OA\Schema(
     *           type="string"
     *      ),
     *   ),
     *   @OA\Parameter(
     *      name="sub_field_id",
     *      in="query",
     *      @OA\Schema(
     *           type="string"
     *      ),
     *   ),
     *   @OA\Parameter(
     *      name="user_input_field",
     *      in="query",
     *      @OA\Schema(
     *           type="string"
     *      ),
     *   ),
     *   @OA\Parameter(
     *      name="bio",
     *      in="query",
     *      @OA\Schema(
     *           type="string"
     *      ),
     *   ),
     *   @OA\Response(
     *      response=200,
     *      description="It's Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function user_info_update(Request $request)
    {
        $user = auth()->user();

        $this->validate(request(), [
            'name' => 'required',
            'instagram' => 'nullable',
            'city_id' => 'nullable',
            'gender' => 'nullable',
            'bio' => 'nullable',
            'marriageyear' => 'nullable|min:4',
            'birthyear' => 'nullable|min:4'
        ]);

        $marriageyear = $request->input('marriageyear');
        $marriagemonth = $request->input('marriagemonth');
        $marriageday = $request->input('marriageday');
        $birthyear = $request->input('birthyear');
        $birthmonth = $request->input('birthmonth');
        $birthday = $request->input('birthday');
        $main_field = $request->input('main_field_id');
        $sub_field = $request->input('sub_field_id');
        $user_input_field = $request->input('user_input_field');
        $bio = $request->input('bio');
        if (strlen($marriageday) == 1) $marriageday = "0" . $marriageday;
        if (strlen($marriagemonth) == 1) $marriagemonth = "0" . $marriagemonth;
        if (strlen($birthmonth) == 1) $birthmonth = "0" . $birthmonth;
        if (strlen($birthday) == 1) $birthday = "0" . $birthday;

        if (!$marriageyear == 0 && !$marriagemonth == 0 && !$marriageday == 0 && strlen($marriageyear) == 4) {
            $marriage_date = $marriageyear . "-" . $marriagemonth . "-" . $marriageday;
            $s_year = Verta::parse($marriage_date)->year;
            $s_month = Verta::parse($marriage_date)->month;
            $s_day = Verta::parse($marriage_date)->day;
            $start_date = Verta::getGregorian($s_year, $s_month, $s_day);
            $date = strtotime($start_date[0] . '/' . $start_date[1] . '/' . $start_date[2]);
            $marriage_date_u = date('Y-m-d', $date);
        } else {
            $marriage_date_u = null;
        }

        if (!$birthday == 0 && !$birthmonth == 0 && !$birthyear == 0 && strlen($birthyear) == 4) {
            $birthday = $birthyear . "-" . $birthmonth . "-" . $birthday;
            $s_year = Verta::parse($birthday)->year;
            $s_month = Verta::parse($birthday)->month;
            $s_day = Verta::parse($birthday)->day;
            $start_date = Verta::getGregorian($s_year, $s_month, $s_day);
            $date = strtotime($start_date[0] . '/' . $start_date[1] . '/' . $start_date[2]);
            $birthday_u = date('Y-m-d', $date);
        } else {
            $birthday_u = null;
        }

        $instgram = str_replace('@', '', $request->input('instagram'));
        $city_id = $request->input('city_id');


        return response()->json([
            'result' => true,
            'message' => 'updated',
        ], 200);
    }

    /**
     * @OA\Post(
     ** path="/api/v1/user_fcm_token",
     *  tags={"User FCM Token"},

     *   @OA\Parameter(
     *      name="user_token",
     *      in="path",
     *      description="send user token in header",
     *      @OA\Schema(
     *           type="http"
     *      )
     *   ),
     *
     *     @OA\Parameter(
     *      name="fcm_token",
     *      in="query",
     *      description="send fcm token in body",
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function UserFCMToken(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $user->fcm_token = $request->input('fcm_token');
            $user->save();
            return response()->json([
                'user_id' => $user->id,
                'fcm_token' => $user->fcm_token
            ], 201);
        }
    }
}
