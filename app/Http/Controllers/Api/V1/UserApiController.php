<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\UserException;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Hekmatinasser\Verta\Facades\Verta;

class UserApiController extends Controller
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

        return response()->json([
            'result' => true,
            'message' => 'its Ok',
            'data' => new UserResource($user),
        ], 200);
    }


}
