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
            'message' => 'its Ok',
            'data' => new UserResource($user),
        ], 200);
    }
}
