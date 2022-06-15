<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class RegisterException extends Exception
{
    public function render($request)
    {
        return $request->expectsJson() ? new JsonResponse([
            'message'=> 'user not found',
            'status'=> 403,
        ], 403) : view('error');
    }
}
