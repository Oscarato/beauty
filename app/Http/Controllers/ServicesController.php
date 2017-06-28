<?php

namespace App\Http\Controllers;

use App\Services;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
         $this->request = $request;
    }

    /**
     * Permite ver el formulario para un pedido.
     *
     * @return \view template
     */
    public function services()
    {   
        return view('service', ['user' => 1]);
    }

    /**
     * Permite registrar un pedido.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_service()
    {   
        session()->regenerate();
        $service = new services;
        if($service->create($this->request)){
            session(['status' => 'success']);
            return redirect("services")->with('message','La orden fue agregada correctamente');;
        }else{
            session(['status' => 'error']);
        }
    }
}
