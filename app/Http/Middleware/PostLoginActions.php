<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jobs\SendSuccessfulLoginEmail;

class PostLoginActions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (Auth::check()) {
            $loginTime = now();
            $browserInfo = $request->header('User-Agent');
            $user = Auth::user();

            try {
                SendSuccessfulLoginEmail::dispatch($user, $loginTime, $browserInfo);
            } catch (\Exception $e) {
                return back()->with(['error' => 'Failed to send login notification email.']);
            }
        }

        return $response;
    }
}
