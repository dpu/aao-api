<?php

$app->get( 'time', 'App\Http\Controllers\TimeController@get' );

$app->get( 'token', 'App\Http\Controllers\TokenController@getToken' );

$app->delete( 'token', 'App\Http\Controllers\TokenController@deleteToken' );

$app->put( 'token', 'App\Http\Controllers\TokenController@putToken' );


$app->group( ['prefix' => 'v1/user', 'middleware' => 'token'], function () use ( $app ) {
    $app->get( 'info', 'App\Http\Controllers\Student\InfoController@get' );
    $app->get( 'courseScore', 'App\Http\Controllers\Student\ScoreController@getCourseScore' );
    $app->get( 'levelScore', 'App\Http\Controllers\Student\ScoreController@getLevelScore' );
    $app->get( 'timetable', 'App\Http\Controllers\Student\TimetableController@get' );
    $app->get( 'currentweek', 'App\Http\Controllers\Student\CurrentWeekController@get' );
    $app->get( 'examsinfo', 'App\Http\Controllers\Student\ExamInfoController@get' );
    $app->post( 'password', 'App\Http\Controllers\Student\PasswordController@reset' );
    $app->put( 'password', 'App\Http\Controllers\Student\PasswordController@update' );
} );

