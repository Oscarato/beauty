<?php

use Illuminate\Http\Request;
use App\Http\Middleware\CheckToken;
use App\Services;
use App\Orders;
use App\User;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;

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
})->middleware('cors');

Route::middleware(CheckToken::class)->get('/orders', function (Request $request) {
    $orders = new Orders;
    $ordersData = $orders->getOrders();
    
    return json_encode($ordersData);
})->middleware('cors');

Route::post('/login', function (Request $request) {
    
    $users = new User;
    

    if(Auth::attempt(['email' => $request['email'], 'password' => $request['password']])){

        $user = $users->where('email', $request['email'])
               ->get();
               
        $signer = new Sha256();

        $token = (new Builder())->setIssuer('http://www.be.land') // Configures the issuer (iss claim)
                                ->setAudience('http://www.be.land') // Configures the audience (aud claim)
                                ->setId('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
                                ->setIssuedAt(time()) // Configures the time that the token was issue (iat claim)
                                ->setNotBefore(time() + 60) // Configures the time that the token can be used (nbf claim)
                                ->setExpiration(time() + 3600) // Configures the expiration time of the token (nbf claim)
                                ->set('uid', $user[0]->id) // Configures a new claim, called "uid"
                                ->sign($signer, 'testing') // creates a signature using "testing" as key
                                ->getToken(); // Retrieves the generated token
                                
        return $token;

    }else{
        echo 'paila';
        exit;
    }
    
    return json_encode($ordersData);
})->middleware('cors');