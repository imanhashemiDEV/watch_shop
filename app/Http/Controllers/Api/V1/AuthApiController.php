<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Models\SmsCode;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\RegisterException;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\SendCheckCodeRequest;
use App\Http\Requests\SendSmsRequest;
use Illuminate\Support\Facades\Validator;

class AuthApiController extends Controller
{

    /**
     * @OA\Post(
     ** path="/api/v1/send_sms",
     *  tags={"Send SMS"},
     *  description="use to send sms to user",
     *   @OA\Parameter(
     *      name="mobile",
     *      required=true,
     *      in="query",
     *     description="send mobile in body",
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function sendSmS(SendSmsRequest $request)
    {
        $mobile = $request->input('mobile');

        $codeInfo = SmsCode::query()->where('mobile', $mobile)
            ->where('created_at', '>', Carbon::now()->subMinutes(2))
            ->first();

        if ($codeInfo == null) {

            $code = rand(1111, 9999);

            SmsCode::query()->create([
                'mobile' => $mobile,
                'code' => $code
            ]);

            return Response()->json([
                'result' => true,
                'message' => "ارسال پیامک انجام شد.",
                'data' => [
                    'mobile' => $mobile,
                    'code' => $code
                ]
            ], 201);
        } else {
            return Response()->json(
                [
                    'result' => false,
                    'message' => 'برای درخواست مجدد 2 دقیقه صبر کنید',
                    'data' => [
                        'mobile' => $mobile,
                    ]
                ],
                403
            );
        }
    }


    /**
     * @OA\Post(
     ** path="/api/v1/check_sms_code",
     *  tags={"Check SMS Code"},
     *  description="use to check sms code that recieved by user",
     *   @OA\Parameter(
     *      name="mobile",
     *      required=true,
     *      in="query",
     *     description="send mobile in body",
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   *   @OA\Parameter(
     *      name="code",
     *      required=true,
     *      in="query",
     *     description="send code in body",
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function checkSmsCode(SendCheckCodeRequest $request)
    {
        $code = $request->input('code');
        $mobile = $request->input('mobile');

        $code = SmsCode::query()->where('mobile', $mobile)
            ->where('code', $code)->first();

        if ($code != null) {

            $user = User::query()->where('mobile', $request->mobile)->first();

            if ($user) {
                return response()->json([
                    'result' => true,
                    'message' => "ثبت نام قبلاانجام شده است",
                    'data' => [
                        'id' => $user->id,
                        'token' => $user->createToken('NewToken')->plainTextToken,
                    ],
                ], 201);
            } else {

                $user = User::query()->create([
                    'mobile' => $request->mobile,
                    'password' => Hash::make(rand(111111, 999999))
                ]);

                return response()->json([
                    'result' => true,
                    'message' => "ثبت نام انجام شد",
                    'data' => [
                        'id' => $user->id,
                        'token' => $user->createToken('NewToken')->plainTextToken,
                    ],
                ], 201);
            }
        } else {
            return Response()->json([
                'result' => false,
                'message' => 'کد وارد شده اشتباه است',
                'data' => [
                    'mobile' => $mobile,
                ]
            ], 406);
        }
    }


    /**
     * @OA\Post(
     ** path="/api/v1/register",
     *  tags={"Register User"},
     *  description="use to signin user with recieved code",
     *   @OA\Parameter(
     *      name="image",
     *      in="query",
     *     description="send image in body",
     *      @OA\Schema(
     *           type="file"
     *      )
     *   ),
     *
     * *   @OA\Parameter(
     *      name="mobile",
     *      in="query",
     *      required=true,
     *     description="send mobile in body",
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *
     *     @OA\Parameter(
     *      name="name",
     *      in="query",
     *      required=true,
     *     description="send name in body",
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *
     * *     @OA\Parameter(
     *      name="address",
     *      required=true,
     *      in="query",
     *     description="send address in body",
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *
     * *     @OA\Parameter(
     *      name="postal_code",
     *      required=true,
     *      in="query",
     *     description="send postal_code in body",
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *
     * *     @OA\Parameter(
     *      name="lat",
     *      required=true,
     *      in="query",
     *     description="send latitude in body",
     *      @OA\Schema(
     *           type="double"
     *      )
     *   ),
     *
     * *     @OA\Parameter(
     *      name="lng",
     *      required=true,
     *      in="query",
     *     description="send longtitude in body",
     *      @OA\Schema(
     *           type="double"
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

    public function register(RegisterRequest $request)
    {

        $user = User::query()->where('mobile', $request->mobile)->first();

        $image = User::saveImage($request->image);

        if ($user) {
            $user->update([
                'name' => $request->name,
                'profile_photo_path' => $image
            ]);
            $user->addresses()->create([
                'address' => $request->address,
                'postal_code' => $request->postal_code,
                'lat' => $request->lat,
                'lng' => $request->lng,
            ]);

            return response()->json([
                'result' => true,
                'message' => "اطلاعات کاربر ثبت شد",
                'data' => [
                    'user' => new UserResource($user)
                ],
            ], 201);
        } else {

            return response()->json([
                'result' => true,
                'message' => "کاربری با این مشخصات یافت نشد",
                'data' => [],
            ], 201);
        }

        // $user = auth()->loginUsingId($user->id);

        // if (!auth()->attempt($data)) {
        // }

    }
}
