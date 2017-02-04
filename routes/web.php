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
$app->get('/', function () {
    return view('login');
});
$app->get('/dashboard', function () {
    return view('hello');
});
$app->get('/plc/1', function () {
    return view('plc');
});
$app->get('/login', function () {
    return view('login');
});
$app->get('/login/yammer', function () {
    return view('yammer');
});
$app->post('/login/yammer', function () {
    return redirect('/dashboard');
});
