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

use Illuminate\Http\Request;
use Illuminate\Http\Response;

$router->get('/', function () {
    return redirect()->route('root');
});

$prefix = env('API_PREFIX') ?? "";
$router->group(['prefix' => $prefix], function () use ($router) {

    $router->get('/', ['as' => 'root', function () use ($router) {
        return $router->app->version();
    }]);

});
$router->get('/{route:.*}/', function (Request $request) {
    return  getError(404, $request);
});
$router->post('/{route:.*}/', function (Request $request) {
    return  getError(405, $request);
});
$router->put('/{route:.*}/', function (Request $request) {
    return  getError(405, $request);
});
$router->delete('/{route:.*}/', function (Request $request) {
    return  getError(405, $request);
});
$router->patch('/{route:.*}/', function (Request $request) {
    return  getError(405, $request);
});
$router->options('/{route:.*}/', function (Request $request) {
    return  getError(405, $request);
});

function getError($statusCode , Request $request) {
    $url = $request->fullUrl();
    $method = $request->getRealMethod();
    $errorTitle = array (404 => "Not Found" , 405 => "Method Not Allowed") ;
    $message = array (404 => "Resource '$url' does not exist" , 405 =>  "'$method' method not allowed. Allowed methods: 'GET', 'HEAD'");
    $header = array(404 => array(), 405 => array('Allow' => 'GET, HEAD')); // For 'Content-Type' Header use ->header() not array parameter!!
    $error = array(
        "errors" => array(
            "status" => $statusCode,
            "error" => $errorTitle[$statusCode],
            "message" => $message[$statusCode],
            "timestamp" => date('c')
        )
    );
    return (new Response($error, $statusCode, $header[$statusCode]));
}