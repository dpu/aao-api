<?php


$app->get( 'token', [
    'as'   => 'token',
    'uses' => 'App\Http\Controllers\TokenController@getToken'
] );


$app->group( ['prefix' => 'v1/user'], function () use ( $app ) {
    $app->get( 'info', 'App\Http\Controllers\Student\InfoController@index' );
} );

