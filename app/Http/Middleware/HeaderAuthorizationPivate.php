<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Models\UserToken;
use Closure;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Agent\Agent;

class HeaderAuthorizationPivate
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
        $token = $request->bearerToken();
        if (!$token || !$user_token = UserToken::where('token', $token)->first()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = User::find($user_token->users_id);
        $request->merge(['user' => $user, "token" => $token]);
        return $next($request);
    }
}
