<?php

use Illuminate\Http\Request;
use App\Http\Middleware\CheckToken;
use App\Services;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(CheckToken::class)->get('/services', function (Request $request) {
    $services = new Services;
    $servicesData = $services->getServices();
    
    return json_encode($servicesData);
});