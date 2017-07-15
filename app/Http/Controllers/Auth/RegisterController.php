<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Sendinblue\Mailin;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        
        # Instantiate the client\
        $mailin = new Mailin("https://api.sendinblue.com/v2.0","7t3U8p4HDKOWQXEm");
        $mailin->get_account();

        //enviamos el correo electronico
        $data = array( "to" => array("oscarato1993@gmail.com" => 'Oscar Jimenez'),
            "from" => array("oscar.jimenez_ingenieria@be.land", "Soporte Be"),
            "subject" => 'Bienvenido A Be',
            "html" => '<!DOCTYPE html>
                <html>
                <head>
                    <title>Bienvenido a Be</title>
                    <meta charset="utf-8">
                </head>
                <body>
                    <div><b>Bienvenido a Be</b></div><br>
                    <div>Ahora estas registrado como asociado en la plataforma</div><br>
                    <div>Solo ingresa y podrás generar tus propios ingresos.</div>
                    <br>
                    <div><b>Be</b></div>
                </body>
            </html>',
        );

        $mailin->send_email($data);
        
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            
            'lastname' => $data['lastname'],
            'document' => $data['document'],
            'phone' => $data['phone'],
            'phone_mobile' => $data['phone_mobile'],
            'city' => $data['city'],
            'another' => isset($data['another']) ? $data['another']:null,
            'address' => $data['address'],

            'password' => bcrypt($data['password']),
        ]);
    }
}
