<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;

class TokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle( $request, Closure $next )
    {
        $userId    = $request->input( 'userId', null );
        $sign      = $request->input( 'sign', null );
        $timestamp = $request->input( 'timestamp', null );
        $key       = $request->header( 'key', null );

        $token      = null;
        $tokenImage = 'userId' . $userId;


        if ( is_null( $sign ) || is_null( $key ) || is_null( $userId ) || is_null( $timestamp ) ) {
            return response()->json( ['message' => 'Error, Missing parameters'], 403 );
        }


        if ((time()-$timestamp) >= 30){
            return response()->json( ['message' => 'Error, Expired Timestamp'], 403 );
        }

        $modelKey = (new \App\Models\Key)->where( ['key' => $key] )->first();

        if ( is_null( $modelKey ) ) {
            return response()->json( ['message' => 'Error, Wrong key'], 403 );
        }

        if ( !Cache::has( $tokenImage ) ) {
            return response()->json( ['message' => 'Error, Token does not exist'], 403 );
        }

        $token    = Cache::get( $tokenImage );
        $signCopy = md5( $key . $token . $timestamp );

        if ( $sign !== $signCopy ) {
            return response()->json( ['message' => 'Error, Wrong Sign'], 403 );
        }

        return $next( $request );
    }
}
