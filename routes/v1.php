<?php

$app->get( 'time', 'TimeController@get' );

$app->get( 'token', 'TokenController@getToken' );

$app->delete( 'token', 'TokenController@deleteToken' );

$app->put( 'token', 'TokenController@putToken' );


$app->group( ['prefix' => 'user', 'middleware' => 'token'], function () use ( $app ) {
    $app->get( 'info', 'Student\InfoController@get' );
    $app->get( 'courseScore', 'Student\ScoreController@getCourseScore' );
    $app->get( 'levelScore', 'Student\ScoreController@getLevelScore' );
    $app->get( 'timetable', 'Student\TimetableController@get' );
    $app->get( 'currentweek', 'Student\CurrentWeekController@get' );
    $app->get( 'examsinfo', 'Student\ExamInfoController@get' );
    $app->post( 'password', 'Student\PasswordController@reset' );
    $app->put( 'password', 'Student\PasswordController@update' );
} );

$app->group(['prefix' => 'user'], function () use ($app){
    $app->get('currentEvents', 'DlpuNews\DlpuNews@getCurrentEvents');
    $app->get('notice', 'DlpuNews\DlpuNews@getNotice');
    $app->get('teachingFiles', 'DlpuNews\DlpuNews@getTeachingFiles');
});
