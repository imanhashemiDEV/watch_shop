<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\SmsCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LoginApiController extends Controller
{
    /**
     * @OA\Post(
     ** path="/api/v1/register",
     *  tags={"Register User"},
     *  description="use to signin user with recieved code",
     *   @OA\Parameter(
     *      name="mobile",
     *      in="query",
     *     description="send mobile in body",
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *
     *     @OA\Parameter(
     *      name="code",
     *      in="query",
     *     description="send code in body",
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
    public function register(Request $request)
    {

        $mobile = $request->input('mobile');
        $code = $request->input('code');

        if (empty($mobile) && empty($email)) {
            return $this->NotLoginResult("mobile number is empty");
        } else {
            if (SmsCode::query()->where('mobile', $mobile)->where('code', $code)->first()) {
                $user = User::query()->where('mobile', $mobile)->first();
                if (!$user) {
                    $user = new User();
                    $user->mobile = $mobile;
                    $user->password = bcrypt(rand(111111, 999999));
                    $user->status = 1;
                    $user->save();

                   // $user = auth()->loginUsingId($user->id);
                }
                return $this->LoginResult($user, "Mobile");
            } else {
                return $this->NotLoginResult("Incorrect verify code");
            }
        }


        $data = $this->validate($request,[
            'mobile'=>'required',

        ]);


        if(!auth()->attempt($data)){

        }

        return new UserResource(auth()->user());
    }

    public function NotLoginResult(string $message)
    {
        return response()->json([
            'result' => true,
            'message' => $message,
            'data' => [],
        ], 200);
    }

    public function LoginResult($user, string $login)
    {
        return response()->json([
            'result' => true,
            'message' => "login with $login",
            'data' => [
                'id' => $user->id,
                'token' => $user->createToken('NewToken')->plainTextToken,
            ],
        ], 200);
    }

    /**
     * @OA\Post (
     ** path="/api/v1/send_sms",
     *   tags={"Send SMS"},
     *   description="use to send sms to user",
     *  @OA\Parameter(
     *      name="mobile",
     *      in="path",
     *      required=true,
     *      description="send mobile in body",
     *      @OA\Schema(
     *           type="integer"
     *      )
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
    public function sendSmS(Request $request)
    {
        $mobile = $request->input('mobile');

        $codeInfo = SmsCode::query()->where('mobile', $mobile)
            ->where('created_at', '>', Carbon::now()->subMinutes(2))
            ->first();

        if ($codeInfo == null) {
            $code = rand(1111,9999);

            $sms = "send sms";

            if ($sms) {
                $userInfo = new SmsCode();
                $userInfo->mobile = $mobile;
                $userInfo->code = $code;
                $userInfo->save();
                return Response()->json([
                    'result' => true,
                        'message' => "ارسال پیامک انجام شد.",
                    'data' => true
                ], 200);
            } else {
                return Response()->json([
                    'result' => true,
                        'message' => 'خطا در ارسال پیامک لطفا مجددا انجام دهید.',
                    'data' => false
                ], 200);
            }
        } else {
            return Response()->json([
                'result' => true,
                'message' => 'Too Requests, wait please.',
                'data' => false],
                200);
        }

    }

    /**
     * @OA\Post (
     ** path="/api/v1/check_sms_code",
     *   tags={"Check SMS Code"},
     *   description="use to check sms code that recieved by user",
     *  @OA\Parameter(
     *      name="code",
     *      in="path",
     *     required=true,
     *     description="send code in body",
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *      @OA\Parameter(
     *      name="mobile",
     *      in="path",
     *     required=true,
     *     description="send mobile in body",
     *      @OA\Schema(
     *           type="string"
     *      )
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
    public function sendCode(Request $request)
    {
        $code = $request->input('code');
        $mobile = $request->input('mobile');

        $codeInfo = SmsCode::query()->where('mobile', $mobile)
            ->where('code', $code)->first();

        if ($codeInfo != null) {
            return Response()->json([
                'result' => true,
                'message' => 'It"s Ok',
                'data' => true
            ], 200);
        } else {
            return Response()->json([
                'result' => true,
                'message' => 'It"s Ok',
                'data' => false
            ], 200);
        }
    }
}
