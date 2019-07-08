<?php
/**
 *
 * API routing
 *
 *
 * @package TritonSystemInfoAPI
 * @author Nikos Koutelidis nikoutel@gmail.com
 * @copyright 2019 Nikos Koutelidis
 * @license http://www.mozilla.org/MPL/2.0/ Mozilla Public License Version 2.0
 * @link https://github.com/nikoutel/TritonSystemInfoAPI
 *
 *
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

use Illuminate\Http\Request;
use Illuminate\Http\Response;

$router->get('/', function () {
    return redirect()->route('root');
});

$prefix = env('API_PREFIX') ?? "";
$router->group(['prefix' => $prefix], function () use ($router) {

    $router->get('/', ['as' => 'root', 'uses' => 'SystemController@root']);

    $router->group(['prefix' => 'metrics'], function () use ($router) {

        $router->group(['prefix' => 'cpu'], function () use ($router) {

            $router->get('/', 'SystemController@cpuRoot');

            $router->get('info', 'SystemController@cpuInfo');

            $router->get('/load', 'SystemController@cpuLoad');
        });

        $router->get('/', 'SystemController@metricsRoot');
    });

    $router->get('info', 'SystemController@info');

});

$router->get('/{route:.*}/', function (Request $request) {
    return getError(404, $request);
});
$router->post('/{route:.*}/', function (Request $request) {
    return getError(405, $request);
});
$router->put('/{route:.*}/', function (Request $request) {
    return getError(405, $request);
});
$router->delete('/{route:.*}/', function (Request $request) {
    return getError(405, $request);
});
$router->patch('/{route:.*}/', function (Request $request) {
    return getError(405, $request);
});
$router->options('/{route:.*}/', function (Request $request) {
    return getError(405, $request);
});

/**
 * Generates the error response according to $statusCode.
 *
 * @param $statusCode
 * @param Request $request
 * @return Response
 */
function getError($statusCode, Request $request) {
    $url = $request->fullUrl();
    $method = $request->getRealMethod();
    $errorTitle = array(404 => "Not Found", 405 => "Method Not Allowed");
    $message = array(404 => "Resource '$url' does not exist", 405 => "'$method' method not allowed. Allowed methods: 'GET', 'HEAD'");
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