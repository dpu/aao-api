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

$app->get('/', function (){
    return redirect('https://xu42.github.io/dlpu-aao-api/');
});

$app->group( ['prefix' => 'v1/', 'middleware' => 'jsonp'], function () use ($app) {
    require 'v1.php';
});


// Github 自动部署
$app->post('deploy', 'DeployController@github');
