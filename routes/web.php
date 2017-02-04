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
    return view('loginwithyammer');
});
$app->get('/yammer', function () {
    return view('login');
});
$app->get('/dashboard', function () {
    return view('hello');
});
$app->get('/plc/{id}', function ($id) {
    $json = file_get_contents('https://idontcare.run.aws-usw02-pr.ice.predix.io/plchash');
    $obj = json_decode($json);
    $data = $obj->$id;
    $url = "http://pro.viewdns.info/reverseip/?host=".$id."&apikey=".env('VIEWDNSKEY')."&output=json";
    $domain = file_get_contents($url);
    return view('plc',compact('data','id','domain'));
});
$app->get('/login', function () {
    return view('login');
});
$app->get('/login/yammer', function () {
    return view('yammer');
});
$app->post('/login/yammer', function () {
    return view('loser');
});
$app->get('/api/data/{id}', function () {
    $json = file_get_contents('https://idontcare.run.aws-usw02-pr.ice.predix.io/plc');
    return $json;
});
