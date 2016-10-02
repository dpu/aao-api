<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->group( ['prefix' => 'v1/'], function () use ($app) {
    require 'v1.php';
});

$app->get('cache', function (){
    $k[] = \Illuminate\Support\Facades\Cache::get('ca7bcd21a229ae3f676729747f5dace5');
    $k[] = \Illuminate\Support\Facades\Cache::get('userId3');

    return $k;
});

