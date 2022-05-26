<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\UserException;
use App\Http\Services\Keys;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Hekmatinasser\Verta\Facades\Verta;

class UserApiController extends Controller
{

    /**
     * @OA\Post(
     * path="/api/v1/profile",
     *   tags={"User info"},
     *   security={{"sanctum":{}}},
     *   @OA\Response(
     *      response=200,
     *      description="It's Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function profile(Request $request)
    {
        $user = auth()->user();

        return response()->json([
            'result' => true,
            'message' => 'صفحه پروفایل کاربر',
            'data' => [
                Keys::user_info =>new UserResource($user),
                Keys::user_processing_count=>UserRepository::processingUserOrderCount($user),
                Keys::user_received_count=>UserRepository::receivedUserOrderCount($user),
                Keys::user_cancell_count=>UserRepository::cancelledUserOrderCount($user),
            ],
        ], 200);
    }

    /**
     * @OA\Post(
     * path="/api/v1/user_addresses",
     *   tags={"User info"},
     *   security={{"sanctum":{}}},
     *   @OA\Response(
     *      response=200,
     *      description="It's Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function userAddresses()
    {

        $user = auth()->user();

        return response()->json([
            'result' => true,
            'message' => 'آدرس های کاربر',
            'data' => $user->addresses,
        ], 200);
    }

    /**
     * @OA\Post(
     * path="/api/v1/user_received_orders",
     *   tags={"User info"},
     *   security={{"sanctum":{}}},
     *   @OA\Response(
     *      response=200,
     *      description="It's Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function userReceivedOrders()
    {

        $user = auth()->user();

        return response()->json([
            'result' => true,
            'message' => ' سفارش های دریافت شده کاربر',
            'data' => UserRepository::receivedUserOrder($user),
        ], 200);
    }


    /**
     * @OA\Post(
     * path="/api/v1/user_cancelled_orders",
     *   tags={"User info"},
     *   security={{"sanctum":{}}},
     *   @OA\Response(
     *      response=200,
     *      description="It's Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function userCancelledOrders()
    {

        $user = auth()->user();

        return response()->json([
            'result' => true,
            'message' => 'سفارش های کنسل شده کاربر',
            'data' => UserRepository::cancelledUserOrder($user),
        ], 200);
    }


    /**
     * @OA\Post(
     * path="/api/v1/user_processing_orders",
     *   tags={"User info"},
     *   security={{"sanctum":{}}},
     *   @OA\Response(
     *      response=200,
     *      description="It's Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function userProcessingOrders()
    {

        $user = auth()->user();

        return response()->json([
            'result' => true,
            'message' => 'سفارش های در حال پردازش کاربر',
            'data' => UserRepository::processingUserOrder($user),
        ], 200);
    }
}
