<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ConstantsController;
use App\User;
use Closure;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $user = User::where('token', $request->get('token'))->first();

        if (!$request->token || !$user) {
            return response()->json(['response_code' => ConstantsController::FAILURE, 'message' => "Token not present or false", 'data' => $request->all()], 200);
        }


        return $next($request);
    }
}
