<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

use App\Http\Middlewares\RequestInputValueCastingMiddleware;
use App\Http\Middlewares\ServiceParameterSettingMiddleware;
use App\Http\Middlewares\ServiceRunMiddleware;
use Illuminate\Support\Str;

$prefix = str_replace('/', DIRECTORY_SEPARATOR, $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR);
$prefix = str_replace($prefix, '', __FILE__);
$prefix = str_replace('routes'.DIRECTORY_SEPARATOR.'web.php', '', $prefix);
$prefix = rtrim($prefix, DIRECTORY_SEPARATOR);
$prefix = str_replace(DIRECTORY_SEPARATOR, '/', $prefix);
$prefix = $_SERVER['DOCUMENT_ROOT'] && Str::startsWith(__FILE__, str_replace('/', DIRECTORY_SEPARATOR, $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR)) ? $prefix : '';

$router->group([
    'prefix' => $prefix,
    'middleware' => [
        ServiceRunMiddleware::class,
        ServiceParameterSettingMiddleware::class,
        RequestInputValueCastingMiddleware::class,
    ],
], function () use ($router) {
    // $router->get('examples', 'ExampleController@index');
    $router->get('users/{id}', 'UserController@show');
    $router->get('/', function () {
        dd('hello world');
    });
});
