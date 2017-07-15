<?php

namespace App\Http\Middleware;

use Closure;
use Request;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        $all_headers = Request::header('Authorization');

        if($all_headers){
            $token = isset(explode('Beauty', $all_headers)[1]) ? explode('Beauty', $all_headers)[1]:null;

            $data = new ValidationData(); // It will use the current time to validate (iat, nbf and exp)
            $data->setIssuer('http://www.be.land');
            $data->setAudience('http://www.be.land');
            $data->setId('bd273e238dc03056fff93c0e1e8de576');

            if($token){

                $token = (new Parser())->parse((string) $token); // Parses from a string
                $token->getHeaders(); // Retrieves the token header
                $token->getClaims(); // Retrieves the token claims

                if($token->validate($data)){
                    
                    $request->userid = $token->getClaim('uid');
                    $request->document = $token->getClaim('document');
                    $request->profile = $token->getClaim('profile');
                    return $next($request);

                }else{

                    return response()->json([
                        'message' => 'El token es erroneo',
                        'response' => false
                    ]);

                }
            }else{
                
                return response()->json([
                    'message' => 'El token esta mal formado',
                    'response' => false
                ]);
            }
        }else{
            return redirect('home');
        }
    }
}
