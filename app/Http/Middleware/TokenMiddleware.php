<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;

class TokenMiddleware
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
        $userId    = $request->input( 'userId', null );
        $sign      = $request->input( 'sign', null );
        $timestamp = $request->input( 'timestamp', null );

        $token      = null;
        $tokenImage = 'userId' . $userId;


//        if ((time()-$timestamp) >= 30){
//            return response()->json( ['message' => 'Error, Expired Timestamp'], 404 );
//        }

        if ( !Cache::has( $tokenImage ) ) {
            return response()->json( ['message' => 'Error, Token does not exist'], 404 );
        }

        $token    = Cache::get( $tokenImage );
        $signCopy = md5( $token . $timestamp );

        if ($sign !== $signCopy){
            return response()->json( ['message' => 'Error, Wrong Sign'], 403 );
        }

        return $next($request);
    }
}
