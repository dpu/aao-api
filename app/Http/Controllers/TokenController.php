<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Xu42\Qznjw2014\Qznjw2014;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Illuminate\Http\Response;

class TokenController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getToken( Request $request )
    {
        $username = $request->input( 'username', null );
        $password = $request->input( 'password', null );

        // 参数若为空
        if ( is_null( $username ) || is_null( $password ) ) {
            return response()->json( ['message' => 'Not Found, Missing parameters'], 404 );
        }

        $eduSystem = new Qznjw2014( $username, $password );
        $isValid   = $eduSystem->isValid();

        // 学号或密码错误
        if ( !$isValid ) {
            return response()->json( ['message' => 'Not Found, Wrong parameters'], 404 );
        }

        // 获取数据库表中的 userid 即 id 字段
        $libraryStudent = new \App\Library\Student;
        $userId         = $libraryStudent->getIdOrSave( $username, $password );

        // 获取失败
        if ( is_null( $userId ) ) {
            return response()->json( ['message' => 'Not Found, Server busy'], 404 );
        }

        $token      = md5( $username . str_random( 16 ) . time() );
        $tokenImage = 'userId' . $userId;

        // 若该 id 已获取 token 则先删除token
        if ( Cache::has( $tokenImage ) ) {
            Cache::pull( Cache::get( $tokenImage ) );
            Cache::pull( $tokenImage );
        }

        Cache::put( $token, $userId, Carbon::now()->addDays( 1 ) );
        Cache::put( $tokenImage, $token, Carbon::now()->addDays( 1 ) );

        $body = ['userId' => $userId, 'username' => $username, 'token' => $token];

        $tokenTimestamp = time();

        return response( $body, 200 )->header( 'Token-Timestamp', $tokenTimestamp );
    }
}
