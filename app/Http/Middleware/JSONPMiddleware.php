<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;


class JSONPMiddleware
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
        $response = $next($request);

        //不是jsonp请求,不作处理,放行
        if (!$request->isMethod('GET') || !$request->has('callback') || !$response instanceof JsonResponse) {
            return $next($request);
        }

        //处理后返回
        return $response->setCallback($request->input('callback'));
    }
}
