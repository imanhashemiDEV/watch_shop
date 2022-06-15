<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\RegisterException;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\SendCheckCodeRequest;
use App\Http\Requests\SendSmsRequest;
use App\Http\Resources\UserResource;
use App\Models\SmsCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthApiController extends Controller
{
    /**
     * @OA\Post(
     ** path="/api/v1/send_sms",
     *  tags={"Auth Api"},
     *  description="use to send sms to user",
     * @OA\RequestBody(
     *    required=true,
     * *         @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *           @OA\Property(
     *                  property="mobile",
     *                  type="string",
     *               ),
     *     )
     *   )
     * ),
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

        $checkSmS = SmsCode::checkTwoMinutes($mobile);

        if ($checkSmS == null) {
            $code = rand(1111, 9999);

            SmsCode::createSmsCode($mobile, $code);

            return Response()->json([
                'result' => true,
                'message' => 'ارسال پیامک انجام شد.',
                'data' => [
                    'mobile' => $mobile,
                    'code' => $code,
                ],
            ], 201);
        } else {
            return Response()->json(
                [
                    'result' => false,
                    'message' => 'برای درخواست مجدد 2 دقیقه صبر کنید',
                    'data' => [
                        'mobile' => $mobile,
                    ],
                ],
                403
            );
        }
    }

    /**
     * @OA\Post(
     ** path="/api/v1/check_sms_code",
     *  tags={"Auth Api"},
     *  description="use to check sms code that recieved by user",
     * @OA\RequestBody(
     *    required=true,
     * *         @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *           @OA\Property(
     *                  property="mobile",
     *                  type="string",
     *               ),
     *           @OA\Property(
     *                  property="code",
     *                  type="string",
     *               ),
     *     )
     *   )
     * ),
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

        $check = SmsCode::checkSend($mobile, $code);

        if ($check != null) {
            $user = User::query()->where('mobile', $request->mobile)->first();

            if ($user) {
                return response()->json([
                    'result' => true,
                    'message' => 'ثبت نام قبلاانجام شده است',
                    'data' => [
                        'id' => $user->id,
                        'token' => $user->createToken('NewToken')->plainTextToken,
                    ],
                ], 201);
            } else {
                $user = User::query()->create([
                    'mobile' => $request->mobile,
                    'password' => Hash::make(rand(111111, 999999)),
                ]);

                return response()->json([
                    'result' => true,
                    'message' => 'ثبت نام انجام شد',
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
                ],
            ], 406);
        }
    }

    /**
     * @OA\Post(
     ** path="/api/v1/register",
     *  tags={"Auth Api"},
     *  security={{"sanctum":{}}},
     *  description="use to signin user with recieved code",
     * @OA\RequestBody(
     *    required=true,
     *         @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *               @OA\Property(
     *                  property="image",
     *                  type="array",
     *                  @OA\Items(
     *                       type="string",
     *                       format="binary",
     *                  ),
     *               ),
     *           @OA\Property(
     *                  property="phone",
     *                  type="string",
     *               ),
     *          @OA\Property(
     *                  property="name",
     *                  type="string",
     *               ),
     *          @OA\Property(
     *                  property="address",
     *                  type="string",
     *               ),
     *          @OA\Property(
     *                  property="postal_code",
     *                  type="string",
     *               ),
     *          @OA\Property(
     *                  property="lat",
     *                  type="double",
     *               ),
     *          @OA\Property(
     *                  property="lng",
     *                  type="double",
     *               ),
     *           ),
     *       )
     * ),
     *   @OA\Response(
     *      response=200,
     *      description="Data saved",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function register(RegisterRequest $request)
    {
        $user = auth()->user();

        $image = User::saveImage($request->image);

        if ($user) {
            User::updateRegisteredUser($user, $request, $image);

            return response()->json([
                'result' => true,
                'message' => 'اطلاعات کاربر ثبت شد',
                'data' => [
                    'user' => new UserResource($user),
                ],
            ], 201);
        } else {
            return response()->json([
                'result' => true,
                'message' => 'کاربری با این مشخصات یافت نشد',
                'data' => [],
            ], 201);
        }
    }
}
