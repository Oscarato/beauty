<?php

namespace App\Http\Controllers;

use App\Orders;
use App\Services;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller
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
    public function order()
    {   
        $services = new Services;
        $servicesData = $services->getServices();

        $service = array();
        if(isset($_GET['service'])){
            $service = $services->getServicesById($_GET['service']);
        }
        return view('order', ['services' => $servicesData, 'serviceData' => $service]);
    }

    /**
     * Permite registrar un pedido.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_order()
    {   
        session()->regenerate();
        $order = new Orders;
        
        $user = User::where('document', $this->request['document'])->count();
        
        if($user > 0){
            if($order->create($this->request)){
                session(['status' => 'success']);
                return redirect("orders")->with('message','La orden fue agregada correctamente');
            }else{
                session(['status' => 'error']);
                return redirect("orders")->with('message','No se pudo registrar el servicio, por favor contacta al administrador');;
            }
        }else{
            session(['status' => 'error']);
            return redirect("orders")->with('message','El usuario no esta registrado en la plataforma');
        }
    }

}